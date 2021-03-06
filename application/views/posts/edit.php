<h2><?= $title; ?></h2>
<!--echo validation errors-->
<?php echo validation_errors(); ?>
<!--Telling form where to send data to-->
<?php echo form_open('posts/update'); ?>
<!--Edit Post form filled with data from model-->
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title" value="<?php echo $post['title']; ?>">
  </div>
  <div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body"><?php echo $post['body']; ?></textarea>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
  </div>
  <div class="form-group">
  <label>Category</label>
  <select name="category_id" class="form-control">
    <?php foreach($categories as $category): ?>
      <option value="<?php echo $category['id']; ?>" ><?php echo $category['cat_name']; ?></option>
    <?php endforeach; ?>
  </select>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>