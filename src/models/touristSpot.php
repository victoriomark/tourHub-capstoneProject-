<?php

namespace models;

use Exception; 
require_once '../../config/Connection.php';
class touristSpot extends \Connection
{
  public function store(string $title, string $description,string $location,string $image,int $municipality_Id):void // store the tourist spot information
  {
      $conn = $this->Connect();
      $query = "INSERT INTO touristspot(title, description, location, image,munipality_Id)values (?,?,?,?,?)";
      $stmt = $conn->prepare($query);
      $stmt->bind_param('ssssi',$title,$description,$location ,$image,$municipality_Id);

      if ($stmt->execute()){
          echo json_encode(['success' => true, 'message' => 'Successfully Created New TouristSpot']);
      }else{
          echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
      }
      $stmt->close();
      $this->Connect()->close();
  }

  // show the title and Id of each tourist Spot
    public function showIdAndTitle():array
    {
        $conn = $this->Connect();
        $result = $conn->query("SELECT title , id FROM touristspot");
        $data = [];

        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    public function showAll():array// show all the tourist Spot list
    {
        $conn = $this->Connect();
        $result = $conn->query("SELECT * FROM touristspot");
        $data = [];

        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }
    public function showBaseOnId($id):array
    {
        $conn = $this->Connect();
        $query = "SELECT * FROM touristspot WHERE munipality_Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];

        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }


    public function showByTouristId($id):array
    {
        $conn = $this->Connect();
        $query = "SELECT * FROM touristspot WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];

        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    public function Update(string $Title, string $description,string $location, int $id):void
    {
        $conn = $this->Connect();
        $query = "UPDATE touristspot SET title = ?, description = ? , location = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssi',$Title,$description,$location,$id);

        if ($stmt->execute()){
            echo json_encode(['success' => true, 'message' => 'Successfully Updated'.$Title]);
        }else{
            echo json_encode(['success' => false, 'message' =>'Error'.$stmt->error]);
        }
    }

    public function delete(int $id):void
    {
        $conn = $this->Connect();
        $query = "DELETE FROM touristspot  WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i',$id);

        if ($stmt->execute()){
            echo json_encode(['success' => true, 'message' => 'Successfully Deleted']);
        }else{
            echo json_encode(['success' => false, 'message' =>'Error'.$stmt->error]);
        }
    }

    public function countedTouristSpot():array
    {
        try {
            $conn = $this->Connect();
            $result = $conn->query("SELECT COUNT(*) AS countedTouristSpot FROM touristspot");

            if ($result){
                $data = $result->fetch_assoc();
                return ['success' => true, 'countedTouristSpot' => $data['countedTouristSpot']];
            }else {
                // Handle query failure
                return ['success' => false, 'message' => 'Query failed'];
            }

        }catch (Exception $e){
            error_log('Error'. $e->getMessage());
            return ['success' => false, 'message' => 'An error occurred'];
        }
    }

}