<?php
$result =false;
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

   // $result = User::login($username, $password);
    $result = validate_credentials($username, $password);


}

if ($result) {
    ?>
<main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Login Success</h1>
		<p class="lead">This example is a quick exercise to do basic login with html forms.</p>
	</div>
</main>
<?php
} else {
    ?>

    

<main class="form-signin">
	<div class="loginBox"> <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px">
		<h3>Sign in here</h3>
		<form action="login.php" method="post">
			<div class="inputBox">
				<input id="uname" type="text" name="username" placeholder="Username Or Email">
				<input id="pass" type="password" name="password" placeholder="Password">
			</div>
			<input type="submit" name="" value="Login">
		</form>
		<a href="#">Forget Password<br> </a>
	</div>
</main> 

<?php
}
