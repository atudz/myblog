<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\BlogPost;
use Cake\ORM\TableRegistry;
use Cake\Routing\Filter\ControllerFactoryFilter;

/**
 * BlogPost Controller
 *
 * @property \App\Model\Table\BlogPostTable $BlogPost
 */
class BlogPostController extends AppController
{

	/**
	 * 
	 * @see \App\Controller\AppController::initialize()
	 */
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}
	
	/**
	 * 
	 * @see \Cake\Controller\Controller::beforeFilter()
	 */
	public function beforeFilter(\Cake\Event\Event $event)
	{
		// Exclude these actions to url Auth 
		$this->Auth->allow(['index','view']);
	}
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
    	$this->paginate = [
    			'limit' => 10,
    			'order' => ['BlogPost.blog_post_last_modified' => 'desc'],
    			'contain' => ['BlogUser','BlogPostComment']
    		];
    	
    	
	    if($this->request->data('search'))
	    {
	    	// Boolean searching condition
	    	$this->paginate['conditions'] = "MATCH (BlogPost.blog_post_topic,BlogPost.blog_post_body) AGAINST('+".$this->request->data('search')."' in BOOLEAN MODE)";
	    }
	
    	$this->set('blogPosts', $this->paginate($this->BlogPost));
    }

    /**
     * View method
     *
     * @param string|null $id Blog Post id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $blogPost = $this->BlogPost->get($id, [
            'contain' => ['BlogUser','BlogPostComment','BlogPostComment.BlogUser']
        ]);
        
        $this->set('blogPost', $blogPost);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         if ($this->request->is('post')) {
         	
         	if($this->request->data('body'))
         	{
	         	$blogPost = $this->BlogPost->newEntity();
	         	
	         	$blogPost->blog_post_date_created = date('Y-m-d H:i:s');
	         	$blogPost->blog_post_topic = $this->request->data('topic');
                //@TODO: add some securty check like htmlpurifier for the body in the future
	         	$blogPost->blog_post_body = $this->request->data('body');
	         	
	         	$userId = 0;
	         	if($user = $this->Auth->user())
	         	{
	         		$userId = $user['blog_user_id'];
	         	}
	         	$blogPost->blog_user_id = $userId;
	         	
	         	if ($this->BlogPost->save($blogPost)) {
	         		$this->Flash->success(__('The blog post has been saved.'));
	         		return $this->redirect(['action' => 'index']);
	         	} else {
	         		$this->Flash->error(__('The blog post could not be saved. Please, try again.'));
	         	}
         	}
         	else
         	{
         		$this->Flash->error(__('The body should not be empty.'));
         	}
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Blog Post id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
  		//flags data if form is submited
    	$posted = false;
    	
        if ($this->request->is('post')) {
        	if($this->request->data('body'))
        	{
	        	$blogPost = $this->BlogPost->get($id,[]);
	        	$blogPost->blog_post_topic = $this->request->data('topic');
                //@TODO: add some securty check like htmlpurifier for the body in the future
	        	$blogPost->blog_post_body = $this->request->data('body');
	            if ($this->BlogPost->save($blogPost)) {
	                $this->Flash->success(__('The blog post has been saved.'));
	                return $this->redirect(['action' => 'index']);
	            } else {
	                $this->Flash->error(__('The blog post could not be saved. Please, try again.'));
	            }
        	}
        	else 
        	{
        		$posted = true;	
        		$this->Flash->error(__('The body should not be empty.'));
        	}
        }

        $blogPost = $this->BlogPost->get($id);
                
        $this->set('posted', $posted);
        $this->set('blogPost', $blogPost);
    }

    /**
     * Delete method
     *
     * @param string|null $id Blog Post id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $blogPost = $this->BlogPost->get($id);
        
        if ($this->BlogPost->delete($blogPost)) {
            $this->Flash->success(__('The blog post has been deleted.'));
        } else {
            $this->Flash->error(__('The blog post could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user)
    {
    	$action = $this->request->params['action'];
    
    	// These following actions are always allowed.
    	if (in_array($action, ['index', 'view', 'add'])) {
    		return true;
    	}
    	// All other actions require an id.
    	if (empty($this->request->params['pass'][0])) {
    		return false;
    	}
    
    	// 
    	$id = $this->request->params['pass'][0];
    	$bookmark = $this->BlogPost->get($id);
    	if ($bookmark->blog_user_id == $user['blog_user_id']) {
    		return true;
    	}
    	
    	return parent::isAuthorized($user);
    }
}
