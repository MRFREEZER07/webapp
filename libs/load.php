<?php

require_once($_SERVER['DOCUMENT_ROOT']."/demo/libs/includes/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/demo/libs/includes/Database.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/demo/libs/includes/Session.class.php");

Session::start();
function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/demo/_templates/$name.php"; //not consistant.
}
