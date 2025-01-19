<?php

namespace models;
use Couchbase\ViewOptions;
use Exception;

require_once '../../config/Connection.php';
class reviews extends \Connection
{
  public  function store($message,$userId):void
  {
      try {
          $conn = $this->Connect();
          $query = "INSERT INTO tb_reviews(message, userId) VALUES (?,?)";
          $stmt = $conn->prepare($query);
          $stmt->bind_param('si',$message,$userId);

          if ($stmt->execute()){
              echo json_encode(['success' => true, 'message' => 'Successfully Submitting Your Review']);
          }else{
              echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
          }
      }catch (Exception $e){
          error_log("Error",$e->getMessage());
      }
  }

  public function show():array
  {
      try {
          $conn = $this->Connect();
          $result = $conn->query("
          select users.firstName , users.lastName, tb_reviews.message
            from users
            INNER JOIN tb_reviews ON  tb_reviews.userId =  users.id;
          ");

          if ($result->num_rows > 0){
              $data = [];
              while ($row = $result->fetch_assoc()){
                  $data[] = $row;
              }
              return $data;
          }

      }catch (Exception $e){
          error_log('Error'.$e->getMessage());
      }
      return [];
  }
}