<!DOCTYPE html>
<html lang="en">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="Social forum">
    <meta name="theme-color" content="#5b5b5b"/>
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/css/style.css/192x192.png">
        <title>Socials</title>
    <link rel="manifest" href="<?php echo base_url(); ?>assets/manifest.json">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/3/slate/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <!-- Latest compiled and minified JavaScript -->
<script>  
  //register Service worker
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register("<?php echo base_url(); ?>assets/sw.js")
  .then((reg) => {
    // registration worked
    console.log('Registration succeeded. Scope is ' + reg.scope);
  }).catch((error) => {
    // registration failed
    console.log('Registration failed with ' + error);
  });
}
 
</script>        
    </head>
    <body>
      <!--Navbar -->
	<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url(); ?>posts">Socials</a>
        </div>
        <div id="navbar">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url(); ?>posts">Forum</a></li>
            <li><a href="<?php echo base_url(); ?>categories">Categories</a></li>            

            <!--If there is no session userdata doesnt contain logged_in, show login and register links -->
            <?php if(!$this->session->userdata('logged_in')) : ?>
            <li><a href="<?php echo base_url(); ?>users/login">Login</a></li>
            <li><a href="<?php echo base_url(); ?>users/register">Register</a></li>
          <?php endif; ?>
          <!--If session userdata contains logged_in, show create category, post and log out -->
            <?php if($this->session->userdata('logged_in')) : ?>
            <li><a href="<?php echo base_url(); ?>categories/create">Create Category</a></li>
            <li><a href="<?php echo base_url(); ?>posts/create">Create Post</a></li>
			<li><a href="<?php echo base_url(); ?>Users/<?php echo $_SESSION['user_id']?>">View Profile</a></li> 
            <li><a href="<?php echo base_url(); ?>users/logout">Log Out</a></li>
            <?php endif; ?>
          </ul>       
        </div>
      </div>
    </nav>
 <div class="container">
   <!--Form for posting search data to posts/search routed as searches -->
   
 <form action="<?php echo base_url(); ?>searches" method = "post" class="searchbar">
          <label for="keyword">Search
          <input type="text" name = "keyword" label="Search" />
          <input type="submit" value = "Search" />
          </label>
          </form>


    




