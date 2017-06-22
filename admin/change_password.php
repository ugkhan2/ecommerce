<?php 
	require_once '../core/init.php';
	include 'includes/head.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	$hashed = $userData['password'];
	$old_password=((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
	$old_password=trim($old_password);
	$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
	$password=trim($password);
	$confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
	$confirm=trim($confirm);
	$new_hashed=password_hash($password, PASSWORD_DEFAULT);
	$user_id=$userData['id'];
	$errors = array();
?>
<div id="login-form">
	<div>
		<?php 			
			if ($_POST) {
				
				// Form validation.
				if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])) {
					$errors[] ='You must fill out all fields!';
				}
				
				// 	password is more than 6 characters
				if (strlen($password)<6) {
					$errors[] = 'Password must be atleast 6 characters!';
				}

				// if new password matches confirms 
				if ($password != $confirm) {
					$errors[] = 'The new password and the confirm new password does not match!';
				}
				
				
				if (!password_verify($old_password, $hashed)) {
					$errors[] = 'Your old password does not match our records!';
				}

				// Check for errors
			 	if (!empty($errors)) {
			 		echo display_errors($errors);
			 	}else{
				//change password.
			 		$db->query("UPDATE panelusers SET password ='$new_hashed' WHERE id='$user_id'");
			 		$_SESSION['success_flash'] = 'Your password has been updated!';
			 		header('Location: index.php');
				}
			}
		 ?>
	</div>
	<h2 class="text-center">Change Password</h2><hr>
	<form action="change_password.php" method="POST">
		<div class="form-group">
			<label for="old_password">Old Password:</label>
			<input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
		</div>
		<div class="form-group">
			<label for="password">New Password:</label>
			<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
		</div>
		<div class="form-group">
			<label for="confirm">Confirm New Password:</label>
			<input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
		</div>
		<div class="form-group">
		<a href="index.php" class="btn btn-default">Cancel</a>
			<input type="submit"  class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"><a href="/e-commerce/index.php" alt="Home">Back to Site</a></p>
</div>
<?php include 'includes/footer.php'; ?>