<?php

$signup = false;
if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email_address'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email_address'];
    $error = User::signup($username, $password, $email);

    $signup = true;
}
?>

<?php
    if ($signup) {
        if (!$error) {
            ?>
<main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Signup Success</h1>
		<p class="lead">Now you can login from <a href="/app/login.php">here</a>.</p>

	</div>
</main>
<?php
        } else {
            ?>
<main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Signup Fail</h1>
		<p class="lead">Something went wrong, <?=$error?>
		</p>
	</div>
</main>
<?php
        }
    } else {
        ?>
<main>
	<div class="loginBox"> <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px">
		<h3>Sign in here</h3>
		<form action="signup.php" method="post">
			<div class="inputBox">
				<input id="uname" type="text" name="username" placeholder="Username">
				<div class="inputBox">
					<input id="email" type="email" name="email_address" placeholder="Email">
					<input id="pass" type="password" name="password" placeholder="Password">
				</div>
				<input type="submit" name="" value="SignUp">
			</div>
		</form>
</main>
<?php
    }
