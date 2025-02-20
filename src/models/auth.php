<?php
namespace models;
 use Exception;
require_once '../../config/Connection.php';
class auth extends \Connection
{


 public function adminLogin($username,$password):void
 {
     try {
         $conn = $this->Connect();
         $query = "SELECT * FROM admin WHERE username = ?";
         $stmt = $conn->prepare($query);

         if (!$stmt){
             echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
             return;
         }

         $stmt->bind_param('s',$username);
         $stmt->execute();
         $result = $stmt->get_result();

         if ($result->num_rows > 0){
             $adminUser = $result->fetch_assoc();

             if (password_verify($password,$adminUser['password'])){
                 echo json_encode(['success' => true, 'message' => 'Successfully Logged']);
                 session_start();
                 $_SESSION['admin'] = $adminUser['username'];
             }else{
                 echo json_encode(['success' => false, 'message' => 'username or password is incorrect']);
             }
         }else{
             echo json_encode(['success' => false, 'message' => 'account is not found']);
         }

     }catch (Exception $e){
         error_log("Error" .$e->getMessage());
     }
 }

}