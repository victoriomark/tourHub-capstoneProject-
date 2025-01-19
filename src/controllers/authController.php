<?php

namespace controllers;
use models\auth;

require '../models/auth.php';
class authController
{
    public function storeUser():void
    {
         $Fields = [
             'FirstName' => 'first name is required',
             'LastName' => 'last name is required',
             'Username' => 'username is required',
             'password' => 'password is required',
             'email' => 'email is required',
             'Address' => 'address is required',
             'phoneNumber' => 'phone number is required',
              'contactPerson' => 'contact person is required'
         ];

         $data = [];
         $error = [];

        foreach ($Fields as $field => $message){
            if (!isset($_POST[$field]) || trim($_POST[$field]) === ''){
                $error[$field] = $message;
            }else{
                $data[$field] = htmlspecialchars($_POST[$field]);
            }
        }

        if (!empty($error)){
            $data['success'] = false;
            $data['errors'] = $error;
            echo json_encode($data);
            return;
        }

        $storeUser = new auth();
        $passwordHashed = password_hash($data['password'],PASSWORD_BCRYPT);
        $storeUser->registerUser(
            $data['FirstName'],
            $data['LastName'],
            $data['Username'],
            $passwordHashed,
            $data['email'],
            $data['Address'],
            $data['phoneNumber'],
            $data['contactPerson']
        );
    }


    public function login():void
    {
        $Fields = [
            'Password' => 'password is required',
            'username' => 'username is required'
        ];
        $data = [];
        $error = [];


        foreach ($Fields as $field => $message){
            if (!isset($_POST[$field]) || trim($_POST[$field]) === ''){
                $error[$field] = $message;
            }else{
                $data[$field] = htmlspecialchars($_POST[$field]);
            }
        }

        if (!empty($error)){
            $data['success'] = false;
            $data['errors'] = $error;
            echo json_encode($data);
            return;
        }

        $loginUser = new auth();
        $loginUser->loginUser($data['username'],$data['Password']);
    }


    public static  function showUserList():void
    {
        $users = new auth();
        $data = $users->show();
        $Tbody = '';
        if ($data){
            foreach ($data as $user){
                $Tbody .= '
                   <tr>
                     <th>'.$user['id'].'</th>
                       <td>'.$user['firstName'].'</td>
                         <td>'.$user['lastName'].'</td>
                            <td>'.$user['username'].'</td>
                             <td>'.$user['email'].'</td>
                                <td>'.$user['address'].'</td>
                                  <td>'.$user['phoneNumber'].'</td>
                                  <td>'.$user['contactPerson'].'</td>
                           </tr>
                ';
            }
            echo $Tbody;
        }

    }

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
        'store' => $userController->storeUser(),
        'login' => $userController->login(),
        'loginAdmin' => $userController->adminLogin(),
        default => http_response_code(400)
    };
}

