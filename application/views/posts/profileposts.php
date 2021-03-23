
<!--For each post in array, append post to -->
<div class="history">
	<?php 
	if (empty($post)) 
	{
		echo '<div class ="not-found">';
		echo '<h2 class="notfound">No posts at the castle</h2>';
		echo '<img src="' . site_url() . 'assets/images/missing.gif" alt="No posts found" class="notfoundgif"';
		echo '</div>';
  
	}?>
	<?php foreach($post as $post) : ?>
		<div class="postcard row">
			<div class="col-md-3">
				<img class="post-thumb" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>" alt="postImage">
			</div>
			<div class="col-md-9">
			<small class="post-date">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['cat_name']; ?></strong> by user <a href="<?php echo site_url('/Users/' .$post['user_id']) ?>" class="user"><?php echo $post['username'] ?></a></small><br>
			<?php echo word_limiter($post['body'], 60); ?>
			<br><br>
			<p><a class="btn btn-default" href="<?php echo site_url('/posts/' .$post['slug']) ?>">Read more</a></p>        
			</div>
		</div>    
	<?php endforeach; ?>
	
</div>
