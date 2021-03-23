<!--Retrieve title from model -->
<h2><?=$title ?></h2>
<!--For each post in array, append post to -->
<?php foreach($post as $post) : ?>
    <h3 class="posttitle"><?php echo $post['title']; ?></h3>
    <div class="postcard row">
        <div class="col-md-3">
            <img class="post-thumb" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>" alt="postImage">
        </div>
        <div class="col-md-9">
        <small class="post-date">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['cat_name']; ?></strong> by user <a href="<?php echo site_url('/Users/' .$post['user_id']) ?>"class="user" ><?php echo $post['username'] ?></a></small><br>
        <?php echo word_limiter($post['body'], 60); ?>
        <br><br>
        <p><a class="btn btn-default" href="<?php echo site_url('/posts/' .$post['slug']) ?>">Read more</a></p>
        
        </div>
    </div>
    
    <?php endforeach; ?>
