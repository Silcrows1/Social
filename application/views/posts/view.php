<h2><?php echo $post['title']; ?></h2>
<small class="post-date">Posted on: <?php echo $post['created_at']; ?></small><br>
<div class="postcard row">
    <div class="col-md-3">
    <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>" alt="" class="viewimg">
    </div>
    <div class="post-body col-md-9">
    <?php echo $post['body']; ?>
</div>
</div>



<!--checks if user is logged in and if that user_id matches the posts.user_id, if true, display edit and delete options-->
<?php if($this->session->userdata('user_id')== $post['user_id']): ?>
    <hr>
    <a class ="btn btn-default pull-left" href="<?php echo site_url('/posts/edit/' .$post['slug']) ?>">Edit</a>
    <?php echo form_open('/posts/delete/' .$post['id']); ?>
    <input type="submit" value="delete" class="btn btn-danger">
<?php endif; ?>

</form>
<hr>
<!--If comments exsist for post -> append array else display "no comments to display"-->
<h3>Comments</h3>
<?php if($comments) : ?>
	<?php foreach($comments as $comment) : ?>
		<div class="well">
			<h5 class="comments"><?php echo $comment['body']; ?> [by <strong><?php echo $comment['name']; ?></strong>]</h5>
		</div>
	<?php endforeach; ?>
<?php else : ?>
	<p>No Comments To Display</p>
<?php endif; ?>

<hr>
<!-- Add comment title-->
<h3>Add Comment</h3>

<!-- Add comment form, send form contents along with post ID-->
<?php echo form_open('comments/create/'.$post['id']); ?>
    <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control">
    </div>
    <div class="form-group">
    <label>Body</label>
    <textarea name="body" class="form-control"></textarea>
    </div>
    <input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
    <button class="btn btn-primary" type="submit" >Sumbit</button>
</form>
