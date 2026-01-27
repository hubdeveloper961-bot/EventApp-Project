<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__."/../engine/db.engine.php";
require_once __DIR__."/../services/account.service.php";

$db = DBEngine::open();
$action = $_GET['action'] ?? '';

if($action == 'register'){
    // Hakikisha vigezo vyote vipo
    $name = $_GET['name'] ?? '';
    $email = $_GET['email'] ?? '';
    $password = $_GET['password'] ?? '';
    $role = $_GET['role'] ?? 'member';

    echo AccountService::register($db, $name, $email, $password, $role);
}

elseif($action == 'login'){
    $email = $_GET['email'] ?? '';
    $password = $_GET['password'] ?? '';

    echo AccountService::login($db, $email, $password);
}

elseif($action == 'logout'){
    AccountService::logout();
}
