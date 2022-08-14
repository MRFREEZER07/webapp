<?php

include 'libs/load.php';

$user = "karthik";
$pass = "karthik";
$result = null;

if (isset($_GET['logout'])) {
    session_destroy();
    //Session::destroy($this->id);
    die("Session destroyed, <a href='logintest.php'>Login Again</a>");
}

/*
1. Check if session_token in PHP session is available
2. If yes, construct UserSession and see if its successful.
3. Check if the session is valid one
4. If valid, print "Session validated"
5. Else, print "Invlaid Session" and ask user to login.
*/if (Session::get('is_loggedin')) {
    $username = Session::get('session_username');
    $userobj = new User($user);
    print("Welcome Back ".$userobj->getLastname());
} else {
    printf("No session found, trying to login now. <br>");
    $result = User::login($user, $pass);

    if ($result) {
        $userobj = new User($user);
        $userobj ->setFirstname("karthik");
        echo "Login Success ", $userobj->getLastname();
        Session::set('is_loggedin', true);
        Session::set('session_username', $result);
    } else {
        echo "Login failed, $user <br>";
    }
}

echo <<<EOL
<br><br><a href="logintest.php?logout">Logout</a>
EOL;
