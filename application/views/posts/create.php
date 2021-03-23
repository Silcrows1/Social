<h2><?= $title; ?></h2>
<!--echo validation errors-->
<?php echo validation_errors(); ?>
<!--Telling form where to send data to-->
<?php echo form_open_multipart('posts/create'); ?>
<!--Create Post form-->
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title">
  </div>
  <div class="ckedit form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body">    
    </textarea>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
  </div>
  <div class="form-group">
  <label>Category</label>
  <select name="category_id" class="form-control">
    <?php foreach($categories as $category): ?>
      <option value="<?php echo $category['id']; ?>"><?php echo $category['cat_name'];?></option>
    <?php endforeach; ?>
  </select>
  </div>
  <div class="form-group">
  <label>Upload Image</label>
  <input type="file" name="userfile" size="20">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>