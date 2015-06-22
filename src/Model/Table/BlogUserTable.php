<?php
namespace App\Model\Table;

use App\Model\Entity\BlogUser;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BlogUser Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BlogUsers
 */
class BlogUserTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('blog_user');
        $this->displayField('blog_user_id');
        $this->primaryKey('blog_user_id');
      
       $this->belongsTo('BlogUser', [
            'foreignKey' => 'blog_user_id',
            'joinType' => 'INNER'
        ]);
        
        // User can have many blog post
        $this->hasMany('BlogPost',[
        	'className' => 'BlogPost'	
        ]);
        
        // User can have many comments
        $this->hasMany('BlogPostComment',[
        		'className' => 'BlogPostComment'
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
            ->add('blog_user_date_created', 'valid', ['rule' => 'datetime'])
            ->requirePresence('blog_user_date_created', 'create')
            ->notEmpty('blog_user_date_created');
            
        $validator
            ->requirePresence('blog_user_last_modified', 'create')
            ->notEmpty('blog_user_last_modified');
            
        $validator
            ->requirePresence('blog_user_firstname', 'create')
            ->notEmpty('blog_user_firstname');
            
        $validator
            ->requirePresence('blog_user_lastname', 'create')
            ->notEmpty('blog_user_lastname');
            
        $validator
            ->requirePresence('blog_user_email', 'create')
            ->notEmpty('blog_user_email');
            
        $validator
            ->requirePresence('blog_user_password', 'create')
            ->notEmpty('blog_user_password');
            
        $validator
            ->requirePresence('blog_user_session_id', 'create')
            ->notEmpty('blog_user_session_id');

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
        $rules->add($rules->existsIn(['blog_user_id'], 'BlogUser'));
        return $rules;
    }
}
