<h2>Results</h2>
<!--for each result retrieved from database, append to page-->
<?php foreach($post as $post) : ?>
    <h3 class="posttitle"><?php echo $post['title']; ?></h3>
    <div class="postcard row">
        <div class="col-md-3">
            <img class="post-thumb" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
        </div>
        <div class="col-md-9">
        <small class="post-date">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['cat_name']; ?></strong></small><br>
        <?php echo word_limiter($post['body'], 60); ?>
        <br><br>
        <p><a class="btn btn-default" href="<?php echo site_url('/posts/' .$post['slug']) ?>">Read more</a></p>
        
        </div>
    </div>
    
    
    <?php endforeach; ?>