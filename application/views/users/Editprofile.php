<!--echo validation errors-->
<?php echo validation_errors(); ?>
<!--Telling form where to send data to-->
<?php echo form_open('users/updateProfile'); ?>
<!--Edit Post form filled with data from model-->

<!--Register Form-->
	<?php foreach($post as $post) : ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
		<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Add Title"  value="<?php echo $post['name']; ?>">
            </div>
			<div class="form-group large">
                <label>Bio</label>
				<textarea input type="text" class="form-control" name="bio" cols="40" rows="5"> <?php echo $post['bio']; ?></textarea>
            </div>
            <div class="form-group">
                <label>PostCode</label>
                <input type="text" class="form-control" name="postcode" value="<?php echo $post['postcode']; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $post['email']; ?>">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo $post['username']; ?>">
            </div><br>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>
<?php echo form_close(); ?>

</form>
	<?php endforeach; ?>
