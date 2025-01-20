<?php

namespace models;

use Connection;
use Exception;

require_once '../../config/Connection.php';
class where_to_eat extends Connection
{
  public function store(string $place, string $category, string $municipality):void{
      
    try{
        $conn = $this->Connect();

        $query = "INSERT INTO tb_wheretoeat(place,category,municipality)VALUES(?,?,?)";
        $stmt = $conn->prepare($query);

         if(!$stmt){
            echo json_encode(['success' => false, 'message' => 'Failed to Prepare Statement']);
            return;
         }

         $stmt->bind_param('sss',$place,$category,$municipality);

         if($stmt->execute()){
            echo json_encode(['success' => true, 'message' => 'Successfully Created']);
         }else{
            echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
         }


    }catch(Exception $e){
        error_log('Error',$e->getMessage());
    }
  }


  public function showBaseOnId($Id):array
  {
      try {
          $conn = $this->Connect();

          $query = "SELECT * FROM tb_wheretostay WHERE id = ?";
          $stmt = $conn->prepare($query);

          if(!$stmt){
              echo json_encode(['success' => false, 'message' => 'Failed to Prepare Statement']);
          }
          $stmt->bind_param('i',$Id);
          $stmt->execute();
          $result = $stmt->get_result();
          $data = [];
          while ($row = $result->fetch_assoc()){
              $data[] = $row;
          }
          return $data;

      }catch (Exception $e){
          error_log('Error'.$e->getMessage());
      }
      return [];
  }

  public function update()
  {

  }


  public function filterByCategoryAndMunicipality(string $category ,string $municipality):array
  {
      try {
          $conn = $this->Connect();
          $query = "SELECT place , municipality FROM tb_wheretoeat WHERE category = ? AND municipality = ?";
          $stmt = $conn->prepare($query);

          if (!$stmt){
              echo json_encode(['success' => false, 'message' => 'Failed To Prepared Statement']);
          }

          $stmt->bind_param('ss',$category,$municipality);
          $stmt->execute();
          $result = $stmt->get_result();
          $data = [];

          if ($result->num_rows > 0){
              while ($row = $result->fetch_assoc()){
                  $data[] = $row;
              }
              return $data;
          }
      }catch (Exception $e){
          error_log('Error'. $e->getMessage());
      }
      return [];
  }

  public function showCategoryAndMunicipality():array
  {
      $data = [];
      try {
          $conn = $this->Connect();
          $result = $conn->query("SELECT DISTINCT municipality, category  FROM tb_wheretoeat");

          if ($result->num_rows > 0){
             while ($row = $result->fetch_assoc()){
                 $data[] = $row;
             }
          }

      }catch (Exception $e){
          error_log('Database Error'. $e->getMessage());
      } finally {
          if (isset($conn)){
              $conn->close();
          }
      }
    return $data;
  }

  public function showAll():array
  {
      $data = [];
      try {
          $conn = $this->Connect();
          $result = $conn->query("SELECT DISTINCT * FROM tb_wheretoeat");

          if ($result->num_rows > 0){
              while ($row = $result->fetch_assoc()){
                  $data[] = $row;
              }
          }

      }catch (Exception $e){
          error_log('Database Error'. $e->getMessage());
      } finally {
          if (isset($conn)){
              $conn->close();
          }
      }
      return $data;
  }

  public function Delete($Id):void
  {
      try {
          $conn = $this->Connect();
          $query = "DELETE FROM tb_wheretoeat WHERE id = ?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param('i',$Id);

          if ($stmt->execute()){
              echo json_encode(['success' => true, 'message' => 'Successfully Deleted']);
          }else{
              echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
          }

      }catch (Exception $e){
          error_log('Database Error'.$e->getMessage());
      }
  }
}