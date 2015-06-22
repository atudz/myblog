<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * BlogPostComment Controller
 *
 * @property \App\Model\Table\BlogPostCommentTable $BlogPostComment
 */
class BlogPostCommentController extends AppController
{

	/**
	 * 
	 * @see \Cake\Controller\Controller::beforeFilter()
	 */
	public function beforeFilter(\Cake\Event\Event $event)
	{
		// exclude this action to url Auth
		$this->Auth->allow(['add']);
	}
	

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        if ($this->request->is('post')) {
        	
        	$blogPostComment = $this->BlogPostComment->newEntity();
        	
        	$blogPostComment->blog_post_comment_date_created = date('Y-m-d H:i:s');
        	// preserve special characters 
        	$blogPostComment->blog_post_comment_text = htmlentities($this->request->data('comment'), ENT_QUOTES);
        	$blogPostComment->blog_post_id = $this->request->data('blog_post_id');
        	
        	$blogPostComment->blog_user_id = $this->_getUserId();
        	// @TODO: implement this functionality in the future;
        	$blogPostComment->blog_post_comment_reply_id = 0;
        	
            if ($this->BlogPostComment->save($blogPostComment)) {
                return $this->redirect([
                			'controller' => 'BlogPost',
                			'action' => 'view',
                			$this->request->data('blog_post_id')
                		
                ]);
            } else {
                $this->Flash->error(__('The blog post comment could not be saved. Please, try again.'));
            }
        }
        
    }
	
    /**
     * Helper method responsible for creating temporary users
     * 
     */
    public function _getUserId()
    {
    	if($user = $this->Auth->user())
    	{
    		return $user['blog_user_id'];	
    	}

    	if($userId = $this->request->session()->read('blog_user_id'))
    	{
    		return $userId;
    	}
    	
    	$blogUser = TableRegistry::get('BlogUser');
    	
    	// create temporary users who can add comments without logging in
    	$user = $blogUser->newEntity();
    	$user->blog_user_date_created = date('Y-m-d H:i:s');
    	$user->blog_user_firstname = $this->request->data('firstname');
    	$user->blog_user_lastname = $this->request->data('lastname');
    	$user->blog_user_email = '';
    	$user->blog_user_session_id = $this->request->session()->id();
    	
    	if($blogUser->save($user))
    	{
    		$this->request->session()->write('blog_user_id', $user->blog_user_id);
    		return $user->blog_user_id;
    	}
    	
    	return 0;
    }
}
