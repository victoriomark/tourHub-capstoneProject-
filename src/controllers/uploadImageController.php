<?php

namespace controllers;

use models\uploadingImage;

include_once '../models/uploadingImage.php';
class uploadImageController
{
    public function store(): void
    {
        $image = $_FILES['image'] ?? null;
        $description = $_POST['Description'] ?? '';
        $touristSpotListId = $_POST['touristSpotListId'] ?? '';
        $EventListId = $_POST['EventListId'] ?? '';

        // Validate required inputs
        $errors = [];

        if (empty($touristSpotListId) && empty($EventListId)) {
            $errors[] = 'Please select tourist spot or event.';
        }

        if (empty($description)) {
            $errors[] = 'Description is required.';
        }

        if (empty($image) || empty($image['name'])) {
            $errors[] = 'Image is required.';
        }

        // Return errors if validation fails
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
            return;
        }

        // Handle image upload
        $fileDir = '../../assets/imageUploaded/';
        $fileInfo = pathinfo($image['name']);
        $fileExtension = strtolower($fileInfo['extension']);

        $fileName = uniqid('UploadedImage_') . '.' . $fileExtension;
        $uploadPath = $fileDir . $fileName;

        if (!move_uploaded_file($image['tmp_name'], $uploadPath)) {
            echo json_encode(['success' => false, 'message' => 'Image upload failed.']);
            return;
        }

        $imageName = $fileName;

        // Store the image and description for the selected tourist spot
        if (!empty($touristSpotListId)) {
            (new uploadingImage())->store($imageName, $description, $touristSpotListId);
        }
        // Store the image and description for the selected Events
        if (!empty($EventListId)) {
            (new uploadingImage())->store($imageName, $description, $EventListId);
        }
    }

    public static function showAll(): void
    {
        $images = new uploadingImage();
        $data = $images->showAll();
        $tableTr = '';

        if ($data) {
            foreach ($data as $row) {
                $tableTr .= '
                  <tr>
                       <th>'. $row['id'].'</th>
                       <td>
                        <img style="height: 50px; width: 50px; object-fit: cover;" class="img-fluid" src="../../assets/imageUploaded/' . $row['image'] . '" alt="image">
                       </td>
                       <td> 
                        <button id="btn_update" value="'. $row['id'].'" class="btn btn-primary">Edit</button>
                        <button id="btn_delete"  value="'. $row['id'].'" class="btn btn-danger">Delete</button>
                      </td>
                 </tr>
               ';
            }
            echo $tableTr;
        }
    }

    public static function images(): void
    {
        $image = new uploadingImage();
        $sum = $image->countedImages();
        echo "<h4>{$sum['countedImages']}</h4>";
    }

    public function showBaseID():void
    {

        $Id = $_POST['Id'];

        if (empty($Id)) {
            echo json_encode(['success' => false, 'message' => 'No Id Probated']);
        }


        $imageInfo = new uploadingImage();
        $data = $imageInfo->showBaseOnId($Id);
        $modal = '';

        if ($data) {
            foreach ($data as $row) {
                $modal .= '
                    <!-- Modal -->
                <form class="modal fade updateImagForm" id="updateImageModal_'.$row['id'].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Description</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                          <div class="form-floating">
                            <textarea name="updateDescription" class="form-control" placeholder="Leave a Description here" id="Description" style="height: 100px">
                              '.$row['description'].'
                            </textarea required>
                            <label for="Description">Description</label>
                            </div>
                             <input type="hidden" name="Id" value=" '.$row['id'].'">
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    </div>
                </div>
                </form>
              ';
            }
            echo $modal;
        }
    }

    public function delete():void{
        $Id = $_POST['Id'];
        

        if(empty($Id)){
            echo json_encode(['success' => false, 'message' => 'No Id Probated']);
            return;
        }

        $image = new uploadingImage();
        $image->delete($Id);
    }


    public function update(){
        $Id = $_POST['Id'];
        $description = $_POST['updateDescription'];
        if(empty($Id)){
            echo json_encode(['success' => false, 'message' => 'No Id Probated']);
            return;
        }

        $image = new uploadingImage();
        $image->update($description,$Id);
    }


      
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    match ($_POST['action']) {
        'store' => (new uploadImageController())->store(),
        'showBaseOnId' => (new uploadImageController())->showBaseID(),
        'Delete' => (new uploadImageController())->delete(),
        'update' => (new uploadImageController())->update(),
        default => http_response_code(400)
    };
}
