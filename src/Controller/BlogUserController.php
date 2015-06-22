<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Auth\Cake\Auth;

/**
 * BlogUser Controller
 *
 * @property \App\Model\Table\BlogUserTable $BlogUser
 */
class BlogUserController extends AppController
{

	/**
	 * 
	 * @see \Cake\Controller\Controller::beforeFilter()
	 */
	public function beforeFilter(\Cake\Event\Event $event)
	{
		// exclude these actions to url Auth
		$this->Auth->allow(['register','logout','login']);
	}
	
	/**
	 * method that's responsible for registration
	 * 
	 */
    public function register()
    {
    	if($this->request->is('post'))
    	{
    		$emailExist = $this->BlogUser->find()
    							->where(['blog_user_email'=>$this->request->data('email')])
    							->count();
    		
    		if($emailExist)
    		{
    			$this->Flash->error(__('Email already exist.'));
    		}
    		else 
    		{
	    		$blogUser = $this->BlogUser->newEntity();
	    		
	    		$blogUser->blog_user_date_created = date('Y-m-d H:i:s');
	    		// let the mysql fill up the last modified value
	    		$blogUser->blog_user_firstname = $this->request->data('firstname');
	    		$blogUser->blog_user_lastname = $this->request->data('lastname');
	    		
	    		// Make sure to hash password
	    		$hasher = new DefaultPasswordHasher();
	    		$blogUser->blog_user_password = $hasher->hash($this->request->data('password'));
	    		
	    		$blogUser->blog_user_email = $this->request->data('email');
	    		$blogUser->blog_user_session_id = '';
	    		
	    		if ($this->BlogUser->save($blogUser)) {
	    			// clean-up temporary users
	    			$this->request->session()->delete('blog_user_id');
	    			
	    			$this->Auth->setUser($blogUser->toArray());
	    			
	    			return $this->redirect(['controller' => 'BlogPost','action' => 'index']);
	    		} else {
	    			$this->Flash->error(__('The blog user could not be saved. Please, try again.'));
	    		}
    		}
    	}
    }
    
    /**
     * Method responsible for logout action
     * 
     */
    public function logout()
    {
    	$this->Auth->logout();
    	return $this->redirect(['controller' => 'BlogPost','action' => 'index']);
    }
    
    /**
     * Method responsible for log-in action
     * 
     */
    public function login()
    {
    	if($this->request->is('post'))
    	{	
    		if($user = $this->Auth->identify())
    		{
    			$this->Auth->setUser($user);
    			// clean-up temporary user's
    			$this->request->session()->delete('blog_user_id');
    			return $this->redirect(['controller' => 'BlogPost','action' => 'index']);
    		}
    		$this->Flash->error(__('Login failed!'));
    	}
    }
    
    /**
     * 
     * @see Cake\Controller\Component::isAuthorized()
     */
    public function isAuthorized($user)
    {
    	return false;
    }
}
