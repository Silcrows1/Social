<h2><?= $title; ?></h2>
<ul class="list-group">
    <!--For each category in the array, create a new list item with array entry-->
    <?php foreach($categories as $category) : ?>
        <li class="list-group-item"><a href="<?php echo site_url('/categories/post/'.$category['id']); ?>"><?php echo $category['cat_name']; ?></a></li>
    <?php endforeach; ?>
</ul>