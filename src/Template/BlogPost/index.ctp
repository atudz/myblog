<?php use Cake\I18n\Time; ?>
<div class="col-sm-12">&nbsp;</div>

<?php if($authUser): ?>
	<button type="button" class="btn btn-default" id="add_blog">Post a blog</button>
	<br/><br/>
<?php endif;?>

<div class="col-sm-7 control-label indent-left">
	<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort By
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li><?= $this->Paginator->sort('blog_post_last_modified', 'Date Posted', ['direction' => 'asc']) ?></li>						
		<li><?= $this->Paginator->sort('blog_post_topic', 'Topic', ['direction' => 'asc']) ?></li>
	</ul>
</div>

<form role="form" class="form-group" accept-charset="utf-8" method="post">
	<div class="col-sm-4">
		<input class="form-control" id="focusedInput" name="search" type="text" placeholder="Input part of the topic or body.">
	</div>
	<button type="submit" class="btn btn-default">
		<span class="glyphicon glyphicon-search"></span> Search
	</button>
</form>

<?php if(count($blogPosts)): ?>
	<div class="panel-group">
		<?php foreach($blogPosts as $post): ?>
			<div class="panel panel-default">
				<div class="panel-heading"> 
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
							<span class="glyphicon glyphicon-th-list"></span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="blogPost/view/<?= $post->blog_post_id ?>">View</a></li>	
							<?php if($authUser && $post->blog_user_id == $authUser['blog_user_id']): ?>					
								<li><a href="blogPost/edit/<?= $post->blog_post_id ?>">Edit</a></li>
								<li><a href="blogPost/delete/<?= $post->blog_post_id ?>">Delete</a></li>
								<li><a href="#">Tag</a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<div class="panel-body">
					<strong><?= $post->blog_post_topic ?></strong>
					<blockquote>
						<p><?= nl2br( $this->Text->truncate($post->blog_post_body, 300, [
        															'ending' => '...',
															        'exact'  => true,
															        'html'   => true,
    									]))  ?></p>
						<footer>Posted by <?= $post->blog_user->full_name ?> on <?php echo Time::parse($post->blog_post_last_modified)->nice(); ?></footer>
					</blockquote>
				</div>
				<div class="panel-footer"><?= count($post->blog_post_comment) ?> Comments</div>
			</div>
		<?php endforeach; ?>
	</div>
	
	<div class="paginator">
		<ul class="pagination">
	    	<?= $this->Paginator->prev('< ' . __('previous')) ?>
	        <?= $this->Paginator->numbers() ?>
	        <?= $this->Paginator->next(__('next') . ' >') ?>
	    </ul>
	    <p><?= $this->Paginator->counter() ?></p>
	</div>
<?php else: ?>
	<p>No results found.</p>
<?php endif; ?>
