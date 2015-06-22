<div class="col-sm-12 col">&nbsp;</div>
<legend>Login</legend>
<form role="form" class="form-horizontal" accept-charset="utf-8" method="post">
  <div class="form-group">
    <label for="email" class="control-label col-sm-1">Email:</label>
    <div class="col-sm-8">
    	<input type="text" class="form-control" id="email" name="blog_user_email" value="<?= $this->request->data('blog_user_email') ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="control-label col-sm-1">Password:</label>
    <div class="col-sm-8">
    	<input type="password" class="form-control" id="password" name="blog_user_password" required>
    </div>
  </div>
  <div class="col-sm-offset-1 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
   </div>
</form>