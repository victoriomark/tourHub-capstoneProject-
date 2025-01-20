<?php

namespace models;
use Connection;
use Exception;
require_once '../../config/Connection.php';
class where_to_stay extends Connection
{
    public function store(string $place, string $phoneNumber, string $municipality):void{
      
        try{
            $conn = $this->Connect();
    
            $query = "INSERT INTO tb_wheretostay(place_name,phoneNumber,municipality)VALUES(?,?,?)";
            $stmt = $conn->prepare($query);
    
             if(!$stmt){
                echo json_encode(['success' => false, 'message' => 'Failed to Prepare Statement']);
                return;
             }
    
             $stmt->bind_param('sss',$place,$phoneNumber,$municipality);
    
             if($stmt->execute()){
                echo json_encode(['success' => true, 'message' => 'Successfully Created']);
             }else{
                echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
             }
    
    
        }catch(Exception $e){
            error_log('Error',$e->getMessage());
        }
      }


      public function showAll():array
      {
          try {
              $conn = $this->Connect();
              $result = $conn->query("SELECT * FROM tb_wheretostay");
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
          return[];
      }

    public function showMunicipality():array
    {
        try {
            $conn = $this->Connect();
            $result = $conn->query("SELECT DISTINCT municipality FROM tb_wheretostay");
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
        return[];
    }

    public function showByMunicipality($municipality):array
    {
        try {
            $conn = $this->Connect();
            $query = "SELECT * FROM tb_wheretostay WHERE municipality = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s',$municipality);
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
        return[];
    }


}