
<?php foreach($post as $post) : ?>
	<!--check if profile is the users who is currently logged in, if so, display edit and change password buttons -->
	<?php if($this->session->userdata('username')== $post['username']): ?>
		<a class ="btn btn-default pull-left edit" href="<?php echo site_url('/users/Editprofile/'.$post['id']) ?>">Edit Profile</a>
		<a class ="btn btn-default pull-left edit" href="<?php echo site_url('/users/Editpassword/'.$post['id']) ?>">Change Password</a>
	<?php endif; ?><br><br>
		<div class ="row profile">
			<div class="col md-6"> 
			<h1>User: <?php echo $post['username']; ?> </h1>
				
			<h3>Bio: 
			<!--check if bio is empty, let user no No bio found if empty, else display bio -->
			<?php 
				if (empty($post['bio'])) 
				{
					echo "No bio found";
				}
				else{
					echo $post['bio'];
				}
			?>  
			</h3>

			</h3><br><br>
			</div>
			<div class="col md-6"> 
			<h1>Post history: </h1>

			</div>
		</div>
<?php endforeach; ?>
