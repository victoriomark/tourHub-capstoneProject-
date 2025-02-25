<?php

namespace models;
require_once '../../config/Connection.php';
use  Exception;
class Iterinary extends \Connection
{
    public function store(string $municipality, string $pdf_file): bool
    {
        try {
            $query = "INSERT INTO iterinary(minicipality, pdf_file) VALUES (?, ?)";
            $conn = $this->Connect();
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                error_log('SQL Prepare Failed: ' . $conn->error);
                return false;
            }

            $stmt->bind_param('ss', $municipality, $pdf_file);

            if ($stmt->execute()) {
                return true;
            } else {
                error_log('SQL Execution Failed: ' . $stmt->error);
                return false;
            }

        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            $conn = $this->Connect();
            $query = "SELECT * FROM iterinary ORDER BY id DESC";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            return $data;
        } catch (Exception $e) {
            error_log('Error fetching itineraries: ' . $e->getMessage());
            return [];
        }
    }

    public function showByMunicipality($municipality):array
    {
        try {
            $conn = $this->Connect();
            $query = "SELECT pdf_file FROM iterinary WHERE minicipality = ?";
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                error_log('SQL Prepare Failed: ' . $conn->error);
            }
            $stmt->bind_param('s',$municipality);
            $stmt->execute();
            $result = $stmt->get_result();

            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;

        }catch (Exception $e){
            error_log('Error fetching itineraries: ' . $e->getMessage());
        }
        return [];
    }

    public function delete($id):void
    {
       try{
         $conn = $this->Connect();
         $query = "DELETE FROM iterinary WHERE id = ?";
         $stmt = $conn->prepare($query);

         if (!$stmt) {
             error_log('SQL Prepare Failed: ' . $conn->error);
         }
         $stmt->bind_param('i',$id);

         if($stmt->execute()){
            echo json_encode(['success' => true, 'message' => 'Successfully Deleted']);
         }

       }catch(Exception $e){
         error_log('Error' .$e->getMessage());
       }
    }



}