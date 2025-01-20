<?php

namespace models;

use Exception;

require_once '../../config/Connection.php';
class uploadingImage extends \Connection
{
    public function store(string $image,string $description, int $id):void // store the tourist spot information
    {
        $conn = $this->Connect();
        $query = "INSERT INTO images(image, description, event_or_touristId)values(?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi',$image,$description,$id);

        if ($stmt->execute()){
            echo json_encode(['success' => true, 'message' => 'Successfully Added New Image']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
        }
        $stmt->close();
        $this->Connect()->close();
    }

    public function showAll():array
    {
        $conn = $this->Connect();
        $result = $conn->query("SELECT * FROM images");
        $data = [];

        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    public function showBaseOnTouristId_orEventId($id):array
    {
        $conn = $this->Connect();
        $query = "SELECT * FROM images WHERE event_or_touristId = ?";
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
    public function countedImages():array
    {
        try {
            $conn = $this->Connect();
            $result = $conn->query("SELECT COUNT(*) AS countedImages FROM images");

            if ($result){
                $data = $result->fetch_assoc();
                return ['success' => true, 'countedImages' => $data['countedImages']];
            }else {
                // Handle query failure
                return ['success' => false, 'message' => 'Query failed'];
            }

        }catch (\Exception $e){
            error_log('Error'. $e->getMessage());
            return ['success' => false, 'message' => 'An error occurred'];
        }
    }


    public function showBaseOnId($id):array {
        try{
            $conn = $this->Connect();
            $query = "SELECT * FROM images WHERE id = ?";
            $stmt = $conn->prepare($query);

            if(!$stmt){
                echo json_encode(['success' => false, 'message' => 'Failed To Prepare statement']);
            }

            $stmt->bind_param('i',$id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            $data = [];
        
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }

        }catch(Exception $e){
            error_log('Database Error'. $e->getMessage());
            return [];
        }
       
    }

    public function delete($id):void{
       
        try{
            $conn = $this->Connect();
            $query = "DELETE FROM images WHERE id = ?";
            $stmt = $conn->prepare($query);
        
            if(!$stmt){
                echo json_encode(['success' => false, 'message' => 'Failed To Prepare Statement']);
                return;
            }

            $stmt->bind_param('i',$id);

            if($stmt->execute()){
                echo json_encode(['success' => true, 'message' => 'Successfully Deleted']);
            }else{
                echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
            }

            $stmt->close();
            $conn->close();
            
        }catch(Exception $e){
            error_log('Error'. $e->getMessage());
        }

    }

    public function update($description,$id):void{
        try{
            $conn = $this->Connect();

            $query = "UPDATE images SET description = ? WHERE id  = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('si',$description,$id);

            if(!$stmt){
                echo json_encode(['success' => false, 'message' => 'Failed to Prepare Statement']);
                return;
            }

            if($stmt->execute()){
                echo json_encode(['success' => true, 'message' => 'Successfully Updated']);
                return;
            }else{
                echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
            }

        }catch(Exception $e){
            error_log('Error: '. $e->getMessage());
        }
    }
}