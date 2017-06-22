<?php 
	require_once '../core/init.php';
	include 'includes/head.php';	
	$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
	$email=trim($email);
	$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
	//$password=trim($password);
	$errors = array();
?>
<style type="text/css" media="screen">
	body{
		background-image: url("/e-commerce/img/headerlogo/background.png");
		background-size: 100vw 100vh;
		background-attachment: fixed;
	}
</style>
<div id="login-form">
	<div>
		<?php 			
			if ($_POST) {
				
				// Form validation.
				if (empty($_POST['email']) || empty($_POST['password'])) {
					$errors[] ='You must provide email and password!';
				}
				// Validate email 
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$errors[] = 'You must enter a valid Email!';
				}

				// 	password is more than 6 characters
				if (strlen($password)<6) {
					$errors[] = 'Password must be atleast 6 characters!';
				}

				// Check if email exists in the database
				$query = $db->query("SELECT * FROM panelusers WHERE email='$email'");
				$user = mysqli_fetch_assoc($query);
				$userCount=mysqli_num_rows($query);
				
				if ($userCount<1) {
					$errors[] = 'That email doesn\'t exist in out database!';
				}
				
				if (!password_verify($password, $user['password'])) {
					$errors[] = 'The password does not match. Please try again!';
				}

				// Check for errors
			 	if (!empty($errors)) {
			 		echo display_errors($errors);
			 	}else{
				// log user in
			 		$user_id = $user['id'];
			 		login($user_id);					
				}
			}
		 ?>
	</div>
	<h2 class="text-center">Login</h2><hr>
	<form action="login.php" method="POST">
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
		</div>
		<div class="form-group">
			<input type="submit"  class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"><a href="/e-commerce/index.php" alt="Home">Back to Site</a></p>
</div>
<?php include 'includes/footer.php'; ?>