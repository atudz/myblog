<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlogUser Entity.
 */
class BlogUser extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'blog_user_date_created' => true,
        'blog_user_last_modified' => true,
        'blog_user_firstname' => true,
        'blog_user_lastname' => true,
        'blog_user_email' => true,
        'blog_user_password' => true,
        'blog_user_session_id' => true,
        'blog_user' => true,
    ];
    
    public function _getFullName()
    {
    	return $this->_properties['blog_user_firstname'] . ' ' . $this->_properties['blog_user_lastname'];
    }
}
