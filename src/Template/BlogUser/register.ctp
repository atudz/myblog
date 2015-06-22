<div class="col-sm-12">&nbsp;</div>
<legend>Registration</legend>
<form role="form" class="form-horizontal" accept-charset="utf-8" method="post">
  <div class="form-group">
    <label for="firstname" class="control-label col-sm-1"><span class="required">*</span>FirstName:</label>
    <div class="col-sm-8">
    	<input type="text" class="form-control" id="firstname" name="firstname" value="<?= $this->request->data('firstname') ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="control-label col-sm-1"><span class="required">*</span>LastName:</label>
    <div class="col-sm-8">
    	<input type="text" class="form-control" id="lastname" name="lastname" value="<?= $this->request->data('lastname') ?>" required>
    </div>
  </div>	
  <div class="form-group">
    <label for="email" class="control-label col-sm-1"><span class="required">*</span>Email:</label>
    <div class="col-sm-8">
    	<input type="email" class="form-control" id="email" name="email" value="<?= $this->request->data('email') ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="control-label col-sm-1"><span class="required">*</span>Password:</label>
    <div class="col-sm-8">
    	<input type="password" class="form-control" id="password" name="password" required>
    </div>
  </div>
  <div class="col-sm-offset-1 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
   </div>
</form>