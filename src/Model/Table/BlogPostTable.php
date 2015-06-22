<?php
namespace App\Model\Table;

use App\Model\Entity\BlogPost;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BlogPost Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BlogPosts
 * @property \Cake\ORM\Association\BelongsTo $BlogUsers
 */
class BlogPostTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('blog_post');
        $this->displayField('blog_post_id');
        $this->primaryKey('blog_post_id');
        $this->belongsTo('BlogPost', [
            'foreignKey' => 'blog_post_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('BlogUser', [
            'foreignKey' => 'blog_user_id',
            'joinType' => 'INNER'
        ]);
        
        // Blog post has many comments
        $this->hasMany('BlogPostComment',[
        	'className' => 'BlogPostComment',
        	'dependent' => true,
    		'cascadeCallbacks' => true,	
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('blog_post_date_created', 'valid', ['rule' => 'datetime'])
            ->requirePresence('blog_post_date_created', 'create')
            ->notEmpty('blog_post_date_created');
            
        $validator
            ->requirePresence('blog_post_last_modified', 'create')
            ->notEmpty('blog_post_last_modified');
            
        $validator
            ->requirePresence('blog_post_body', 'create')
            ->notEmpty('blog_post_body');
            
        $validator
            ->requirePresence('blog_post_topic', 'create')
            ->notEmpty('blog_post_topic');
            
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['blog_post_id'], 'BlogPost'));
        $rules->add($rules->existsIn(['blog_user_id'], 'BlogUser'));
        return $rules;
    }
}
