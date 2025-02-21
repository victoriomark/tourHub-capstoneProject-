<?php

namespace controllers;
use models\Iterinary;
use Exception;
require_once '../models/Iterinary.php';
class IterinaryController
{
    public function store(): void
    {
        $municipality = $_POST['municipality_Id'] ?? '';

        $targetDir = '../../assets/IterinaryUploaded/';
        $fileName = basename($_FILES["pdf_file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        if ($fileType !== "pdf") {
            echo json_encode(['success' => false, 'message' => 'Only PDF files are allowed']);
            return;
        }

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $targetFilePath)) {
            $iterinary = new Iterinary();
            $result = $iterinary->store($municipality, $fileName); // Get result

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Successfully Created']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database insertion failed']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error uploading file']);
        }
    }

    public function fetchAll(): void
    {
        $model = new Iterinary();
        $data = $model->getAll();

        if ($data) {
            foreach ($data as $row) {
                echo '
                <tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['minicipality'] . '</td>
                    <td>
                        <button class="btn btn-primary view-pdf" data-file="../../assets/IterinaryUploaded/' . $row['pdf_file'] . '">
                            View
                        </button>
                        <button id="btn_delete" value="' . $row['id'] . '" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            ';
            }
        } else {
            echo '<tr><td colspan="3">No data found</td></tr>';
        }
    }

    public function showByMunicipality():void
    {
        $municipality = $_POST['municipality'];

        $model = new Iterinary();
        $data = $model->showByMunicipality($municipality);

       if ($data){
           foreach ($data as $pdf){
               echo '../../assets/IterinaryUploaded/' . $pdf['pdf_file']; // Adjust path based on storage location
           }
       }else{
           echo 'No Pdf Uploaded';
       }
    }

    public function delete(){
        $id = htmlspecialchars($_POST['id']);

        if(empty($id)){
            echo json_encode(['success' => false, 'message' => 'no id']);
            return;
        }

        $model = new Iterinary();
        $model->delete($id);
    }

  



}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){
    match ($_POST['action']){
        'store' => (new IterinaryController())->store(),
        'fetchAll' => (new IterinaryController())->fetchAll(),
        'delete' => (new IterinaryController())->delete(),
        'show_iterinary_' => (new IterinaryController())->showByMunicipality(),
        default => http_response_code(400)
    };
}