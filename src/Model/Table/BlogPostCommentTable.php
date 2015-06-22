<?php
namespace App\Model\Table;

use App\Model\Entity\BlogPostComment;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BlogPostComment Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BlogPostComments
 * @property \Cake\ORM\Association\BelongsTo $BlogPosts
 * @property \Cake\ORM\Association\BelongsTo $BlogUsers
 * @property \Cake\ORM\Association\BelongsTo $BlogPostCommentReplies
 */
class BlogPostCommentTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('blog_post_comment');
        $this->displayField('blog_post_comment_id');
        $this->primaryKey('blog_post_comment_id');
        $this->belongsTo('BlogPostComment', [
            'foreignKey' => 'blog_post_comment_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('BlogPost', [
            'foreignKey' => 'blog_post_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('BlogUser', [
            'foreignKey' => 'blog_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('BlogPostComment', [
            'foreignKey' => 'blog_post_comment_reply_id',
            'joinType' => 'LEFT'
        ]);
        
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
            ->add('blog_post_comment_date_created', 'valid', ['rule' => 'datetime'])
            ->requirePresence('blog_post_comment_date_created', 'create')
            ->notEmpty('blog_post_comment_date_created');
            
        $validator
            ->requirePresence('blog_post_comment_last_modified', 'create')
            ->notEmpty('blog_post_comment_last_modified');
            
        $validator
            ->requirePresence('blog_post_comment_text', 'create')
            ->notEmpty('blog_post_comment_text');

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
        $rules->add($rules->existsIn(['blog_post_comment_id'], 'BlogPostComment'));
        $rules->add($rules->existsIn(['blog_post_id'], 'BlogPost'));
        $rules->add($rules->existsIn(['blog_user_id'], 'BlogUser'));
        $rules->add($rules->existsIn(['blog_post_comment_reply_id'], 'BlogPostComment'));
        return $rules;
    }
}
