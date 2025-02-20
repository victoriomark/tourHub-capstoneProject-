<?php

namespace models;
use Couchbase\ViewOptions;
use Exception;

require_once '../../config/Connection.php';
class reviews extends \Connection
{
  public  function store($message,$attraction,$name):void
  {
      try {
          $conn = $this->Connect();
          $query = "INSERT INTO tb_reviews(message, attraction,name) VALUES (?,?,?)";
          $stmt = $conn->prepare($query);
          $stmt->bind_param('sss',$message,$attraction,$name);

          if ($stmt->execute()){
              echo json_encode(['success' => true, 'message' => "Thank you $name for  Submitting Your Review!"]);
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
          $result = $conn->query(
              "
                SELECT * FROM tb_reviews
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