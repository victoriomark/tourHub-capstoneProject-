<?php

namespace controllers;
use models\auth;

require '../models/auth.php';
class authController
{
  
    public  function adminLogin():void
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if (empty($username)){
            echo json_encode(['success' => false, 'message' => 'username is required']);
            return;
        }
        if (empty($password)){
            echo json_encode(['success' => false, 'message' => 'password is required']);
            return;
        }

        $login = new auth();
        $login->adminLogin($username,$password);
    }

    public static function users():void
    {
        $user = new auth();
        $sum = $user->countedUsers();
        echo "<h4>{$sum['countedUser']}</h4>";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){
    $userController =  new authController();
    match ($_POST['action']){
        'loginAdmin' => $userController->adminLogin(),
        default => http_response_code(400)
    };
}

