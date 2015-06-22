<?php use Cake\I18n\Time; ?>

<div class="col-sm-12">&nbsp;</div>
<a href="/"> << Back to Blog Posts</a>
<div class="col-sm-12">&nbsp;</div>
<legend><h4>Posted by <?= $blogPost->blog_user->full_name ?> on <?php echo Time::parse($blogPost->blog_post_last_modified)->nice(); ?></h4></legend>

<?php if($authUser && $blogPost->blog_user_id == $authUser['blog_user_id']): ?>
	<a href="<?php echo '//'.$_SERVER['SERVER_NAME'].'/BlogPost/edit/'.$blogPost->blog_post_id ?>">
		<span class="glyphicon glyphicon-edit"></span> Edit 
	</a>
	&nbsp;
	<a href="<?php echo '//'.$_SERVER['SERVER_NAME'].'/BlogPost/delete/'.$blogPost->blog_post_id ?>">
		<span class="glyphicon glyphicon-trash"></span> Delete 
	</a>
<?php endif; ?>

<h2><?= $blogPost->blog_post_topic ?></h2>
<div>
	<?php echo $blogPost->blog_post_body; ?>
</div>

<div class="col-sm-12">&nbsp;</div>
<div class="col-sm-12">&nbsp;</div>
<h4>Comments (<?= count($blogPost->blog_post_comment) ?>)</h4>
<table class="table">
	<tr>
		<td>
			<form role="form" accept-charset="utf-8" method="post"  action="/BlogPostComment/add">
				<input type="hidden" name="blog_post_id" value=<?= $blogPost->blog_post_id ?>>
				<textarea rows="3" class="form-control" name="comment" required></textarea>
				<?php if(!$this->request->session()->read('blog_user_id') && !$authUser): ?>
					<div class="form-group">
    					<label for="firstname"><span class="required">*</span>Firstname:</label>
    					<input type="text" class="form-control" id="firstname" name="firstname" required>
  					</div>
  					<div class="form-group">
    					<label for="lastname"><span class="required">*</span>Lastname:</label>
    					<input type="text" class="form-control" id="lastname" name="lastname" required>
  					</div>
				<?php endif; ?>
				<br/>
				<button type="submit" class="btn btn-info btn-sm">Add a comment</button>
			</form>
		</td>
	</tr>
	<?php foreach($blogPost->blog_post_comment as $comment): ?>
		<tr>
			<td>
				<h5><strong><?= $comment->blog_user->full_name ?></strong></h5> 
				<p><?= nl2br($comment->blog_post_comment_text) ?></p>
				<h6><?php echo Time::parse($comment->blog_post_comment_date_created)->nice(); ?></h6>
			</td>
		</tr>
	<?php endforeach; ?>
</table>