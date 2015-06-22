<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlogPostComment Entity.
 */
class BlogPostComment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'blog_post_comment_date_created' => true,
        'blog_post_comment_last_modified' => true,
        'blog_post_comment_text' => true,
        'blog_post_id' => true,
        'blog_user_id' => true,
        'blog_post_comment_reply_id' => true,
        'blog_post_comment' => true,
        'blog_post' => true,
        'blog_user' => true,
    ];
}
