<!--echo validation errors-->
<?php echo validation_errors(); ?>
<!--Telling form where to send data to-->
<?php echo form_open('users/changePassword'); ?>
<!--Edit Post form filled with data from model-->
<!--Telling form where to send data to-->

<!--Register Form-->
	<?php foreach($post as $post) : ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
		<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
            </div><br>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>
<?php echo form_close(); ?>

</form>
	<?php endforeach; ?>
