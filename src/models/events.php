<?php

namespace models;
use Exception;

require_once '../../config/Connection.php';
class events extends \Connection
{
    public function store(string $description,string $image,string $fiestaDate, string $location ,string $nameOfThePatron, string $FestivalDate, string $festivalName):void // store the tourist spot information
    {
        $conn = $this->Connect();
        $query = "INSERT INTO event(description, image, fiestaDate,location,nameOfThePatron,FestivalDate,festivalName)values (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssss',$description,$image,$fiestaDate,$location,$nameOfThePatron,$FestivalDate,$festivalName);

        if ($stmt->execute()){
            echo json_encode(['success' => true, 'message' => 'Successfully Created New Event']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error'.$stmt->error]);
        }
        $stmt->close();
        $this->Connect()->close();
    }

    public function showAll():array// show all the tourist Spot list
    {
        $conn = $this->Connect();
        $result = $conn->query("SELECT * FROM event");
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
        $query = "SELECT * FROM event WHERE id = ?";
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


    public function update(string $patron, string $fiestaDate, string $festivalDate, string $description, int $id):void
    {
        $conn = $this->Connect();

        $query = "UPDATE event SET nameOfThePatron = ? ,fiestaDate = ?, FestivalDate = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssi',$patron,$fiestaDate,$festivalDate,$description,$id);

        if ($stmt->execute()){
            echo json_encode(['success' =>  true, 'message' => 'Successfully Update']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error',$stmt->error]);
        }
    }


    public function Delete(int $id):void
    {
        $conn = $this->Connect();

        $query = "DELETE FROM event WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i',$id);

        if ($stmt->execute()){
            echo json_encode(['success' =>  true, 'message' => 'Successfully Deleted']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error',$stmt->error]);
        }
    }

    public function countedEvent():array
    {
        try {
            $conn = $this->Connect();
            $result = $conn->query("SELECT COUNT(*) AS countedEvent FROM event");

            if ($result){
                $data = $result->fetch_assoc();
                return ['success' => true, 'countedEvent' => $data['countedEvent']];
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