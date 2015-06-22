<div class="col-sm-12">&nbsp;</div>
<a href="/"> << Back to Blog Posts</a>
<div class="col-sm-12">&nbsp;</div>
<legend>Add a Blog</legend>

<form role="form" accept-charset="utf-8" method="post">
  <div class="form-group">
    <label for="topic">Topic:</label>
    <input type="text" class="form-control" id="topic" name="topic" value="<?= $this->request->data('topic') ?>" required>
  </div>
  <div class="form-group">
    <label for="body">Body:</label>
    <textarea class="form-control" rows="10" id="body" name="body" required></textarea>
    <script>
    	CKEDITOR.replace('body');
    </script>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
