<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloggers</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="http://cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
    <script>
    	$.noConflict();
    </script>
    <?= $this->Html->css('blog.css') ?>
    <?= $this->Html->meta('rss','/blogPost/index.rss') ?>
</head>
<body>
	<div class="container">
		<header class="col-sm-12 jumbotron header-bg">
			<h1><a href="/" class="home-link">Bloggers.com</a></h1>
		</header>
		<?php if($authUser): ?>
			<div class="col-sm-10">Welcome <?= $authUser['blog_user_firstname'] ?>&nbsp;<?= $authUser['blog_user_lastname'] ?>!</div>
			<div class="col-sm-2">
				<a href="<?php echo '//'.$_SERVER['SERVER_NAME'].'/BlogUser/logout'?>">
	          		Log-out <span class="glyphicon glyphicon-log-out"></span>
	       		</a>
       		</div>
		<?php else: ?>
			<div class="col-sm-10">&nbsp;</div>
			<div class="col-sm-2">
			<a href="<?php echo '//'.$_SERVER['SERVER_NAME'].'/BlogUser/register'?>">Register</a>
			&nbsp;&nbsp;&nbsp;
			<a href="<?php echo '//'.$_SERVER['SERVER_NAME'].'/BlogUser/login'?>">
          		Log-in <span class="glyphicon glyphicon-log-in"></span>
       		</a>
			</div>
		<?php endif; ?>
		<?= $this->Flash->render() ?> 
		<?= $this->Flash->render('auth') ?>
		<div id="content">
            <?= $this->fetch('content') ?>
        </div>		
		<footer>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
  	<?php echo $this->Html->script('blog'); ?> 	
</body>
</html>
