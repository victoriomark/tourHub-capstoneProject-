<?php

namespace models;
use Exception;

require_once '../../config/Connection.php';
class municipality extends \Connection
{
    public function store(string $municipalityName, string $image, string $description):void
    {
        $conn = $this->Connect();
        $query = "INSERT INTO municipality(municipalityName, image, description)values (?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss',$municipalityName,$image ,$description);

        if ($stmt->execute()){
            echo json_encode(['success' => true, 'message' => 'Successfully Created New Municipality']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
        }
        $stmt->close();
        $this->Connect()->close();
    }


    public function showIdAndTitle():array
    {
        $conn = $this->Connect();
        $result = $conn->query("SELECT municipalityName , id FROM municipality");
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
        $result = $conn->query("SELECT * FROM municipality");
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
        $query = "SELECT * FROM municipality WHERE id = ?";
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


    public function update(string $municipality, string $description, int $id):void
    {
        $conn = $this->Connect();

        $query = "UPDATE municipality SET municipalityName = ? , description = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi',$municipality,$description,$id);

        if ($stmt->execute()){
            echo json_encode(['success' =>  true, 'message' => 'Successfully Update'.$municipality]);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error',$stmt->error]);
        }
    }


    public function Delete(int $id):void
    {
        $conn = $this->Connect();

        $query = "DELETE FROM municipality WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i',$id);

        if($stmt->execute()){
            echo json_encode(['success' =>  true, 'message' => 'Successfully Deleted'. ' '.$id]);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error',$stmt->error]);
        }

        $stmt->close();
        $conn->close();
    }

    public function topTreePlaces():array
    {
        try {
            $conn = $this->Connect();
            $result = $conn->query("SELECT description, municipalityName,image,id FROM municipality LIMIT 3");
            $data = [];

            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
            }
            return $data;

        }catch (Exception $e){
           error_log('Database Error' .$e->getMessage());
            return [];
        }
    }

}