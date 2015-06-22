<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlogPost Entity.
 */
class BlogPost extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'blog_post_date_created' => true,
        'blog_post_last_modified' => true,
        'blog_post_body' => true,
        'blog_user_id' => true,
        'blog_post_topic' => true,
        'blog_post' => true,
        'blog_user' => true,
    ];
}
