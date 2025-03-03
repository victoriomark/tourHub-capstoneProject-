<?php

namespace controllers;
use models\municipality;

require_once '../models/municipality.php';
class municipalityController
{

    public static function showTitle_Id():void
    {
        $model = new municipality();
        $data = $model->showIdAndTitle();
        $select = '';
        if ($data){
            foreach ($data as $row){
                $select .='
                   <option value="" id="municipality_Id_msg" class="invalid-feedback" selected>Select Municipality</option>
                   <option value="'.$row['id'].'">'.$row['municipalityName'].'</option>
            ';
            }
        }else{
            $select .='
                   <option value="">No Municipality Found</option>
            ';
        }
        echo $select;
    }

    public static function showTitle():void
    {
        $model = new municipality();
        $data = $model->showIdAndTitle();
        $select = '';
        if ($data){
            foreach ($data as $row){
                $select .='
                   <option value="" id="municipality_Id_msg" class="invalid-feedback" selected>Select Municipality</option>
                   <option value="'.$row['municipalityName'].'">'.$row['municipalityName'].'</option>
            ';
            }
        }else{
            $select .='
                   <option value="">No Municipality Found</option>
            ';
        }
        echo $select;
    }

    public static function showMunicipalityName():void
    {
        $model = new municipality();
        $data = $model->showIdAndTitle();
        $select = '';
        if ($data){
            foreach ($data as $row){
                $select .='
                   <option value="" id="municipality_Id_msg" class="invalid-feedback" selected>Select Municipality</option>
                   <option value="'.$row['municipalityName'].'">'.$row['municipalityName'].'</option>
            ';
            }
        }else{
            $select .='
                   <option value="">No Municipality Found</option>
            ';
        }
        echo $select;
    }


    public static function showMunicipality():void
    {
        $model = new municipality();
        $data = $model->showIdAndTitle();
        $select = '';
        if ($data){
            foreach ($data as $row){
                $select .='
                   <option value="" id="municipality_Id_msg" class="invalid-feedback" selected>Select Municipality</option>
                   <option value="'.$row['municipalityName'].'">'.$row['municipalityName'].'</option>
            ';
            }
        }else{
            $select .='
                   <option value="">No Municipality Found</option>
            ';
        }
        echo $select;
    }


    public function store():void
    {
        $image = $_FILES['image'];
        $fileDir = '../../assets/municipalityUploaded/';

        $Fields = [
            'Municipality' => 'municipality name is required',
            'Description' => 'description is required'
        ];
        $data = [];
        $error = [];

        foreach ($Fields as $field => $message){
            if (!isset($_POST[$field]) || trim($_POST[$field]) === ''){
                $error[$field] = $message;
            }else{
                $data[$field] = htmlspecialchars($_POST[$field]);
            }
        }

        if (!empty($error)){ // check if the error array is ! empty
            $data['success'] = false;
            $data['errors'] = $error;
            echo json_encode($data);
            return;
        }

        // handle the uploading image
        if ($image &&  !empty($image['name'])){
            $fileInfo = pathinfo($image['name']);
            $fileExtension = strtolower($fileInfo['extension']);

            $fileName = uniqid('MunicipalityImage_'). '.' .$fileExtension;
            $uploadPath = $fileDir. $fileName;


            if (!move_uploaded_file($image['tmp_name'],$uploadPath)){
                $data['success'] = false;
                $data['message'] = 'Upload Failed';
                echo json_encode($data);
                return;
            }
            $data['image'] = $fileName;
        }else{
            echo  json_encode(['success' => false ,'message' => 'image is required']);
            return;
        }
        // call the method to store the data
        $model = new municipality();
        $model->store($data['Municipality'],$data['image'],$data['Description']);
    }


    public static function showAllCard():void
    {
        $list = new municipality();
        $data = $list->showAll();
        $card = '';

        if ($data){
            foreach ($data as $row){
                $card .= '
                   <!-- Card Start -->
                    <form  data-aos="flip-up"  action="showTouristSpotBaseOnMunicipality.php" method="post" class="card col-lg-3 col-sm-12 col-md-5">
                        <img  class="" src="../../assets/municipalityUploaded/'.$row['image'].'" alt="image">
                        <div class="card-body">
                            <input type="hidden" value="'.$row['id'].'" name="Id">
                            <input type="hidden" value="'.$row['municipalityName'].'" name="Title">
                          
                           
                            <h5 class="card-title text-light">'.$row['municipalityName'].'</h5>
                            <button type="submit" class="btn btn-danger">View Details</button>
                        </div>
                    </form>
                    <!-- Card End -->
                ';
            }
        }
        echo $card;
    }

    public function ShowBaseOnId():void
    {
        $id = $_POST['Id'];

        if (empty($id)){
            echo json_encode(['success' => false, 'message' => 'No Id Probated']);
            return;
        }

        $list = new municipality();
        $data = $list->showBaseOnId($id);
        $modal = '';

        if ($data){
            foreach ($data as $row){
              $modal .= '
                 <!-- Modal -->
                <form class="modal updateModalMunicipality fade" id="modal_update_'.$id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                       <div class="form-floating mb-3">
                          <input name="municipality" value="'.$row['municipalityName'].'" type="text" class="form-control" id="municipality" placeholder="municipality" required>
                          <label for="municipality">municipality</label>
                        </div>
                        <input name="Id" type="hidden" value="'.$row['id'].'" >
                        <div class="form-floating">
                          <textarea name="Description" class="form-control" placeholder="Description" id="Description" style="height: 100px" required>
                         '.$row['description'].'
                         </textarea>
                          <label for="Description">Description</label>
                        </div>
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
        }
        echo $modal;
    }


    public static function showAll():void
    {
        $municipalityList = new municipality();
        $data = $municipalityList->showAll();
        $tableTr = '';

        if ($data){
            foreach ($data as $row){
                $tableTr .= '
                  <tr>
                   <th>'.$row['id'].'</th>
                   <td>
                    <img style="height: 50px; width: 50px; object-fit: cover;" class="img-fluid" src="../../assets/municipalityUploaded/'.$row['image'].'" alt="image">
                   </td>
                   <td>'.$row['municipalityName'].'</td>
                   <td>
                    <button id="btn_edit" value="'.$row['id'].'" class="btn btn-primary">Edit</button>
                    <button  id="btn_delete" value="'.$row['id'].'" class="btn btn-danger">Delete</button>
                 </td>
                 </tr>
               ';
            }
            echo $tableTr;
        }
    }


    public static function showAllToAdmin():void
    {
        $municipalityList = new municipality();
        $data = $municipalityList->showAll();
        $tableTr = '';

        if ($data){
            foreach ($data as $row){
                $tableTr .= '
                  <tr>
                   <th>'.$row['id'].'</th>
                   <td>
                    <img style="height: 50px; width: 50px; object-fit: cover;" class="img-fluid" src="../../assets/municipalityUploaded/'.$row['image'].'" alt="image">
                   </td>
                   <td>'.$row['municipalityName'].'</td>
                 </tr>
               ';
            }
            echo $tableTr;
        }
    }


    public function update():void
    {
        $id = $_POST['Id'];

        if (empty($id)){
            echo json_encode(['success' => false, 'message' => 'No Id Probated']);
            return;
        }
        $Description = htmlspecialchars($_POST['Description']);
        $municipalityName = htmlspecialchars($_POST['municipality']);

        $municipality = new municipality();
        $municipality->update($municipalityName,$Description,$id);
    }

    public function delete():void
    {
        $id = $_POST['Id'];

        if (empty($id)){
            echo json_encode(['success' => false, 'message' => 'No Id Probated']);
            return;
        }

        $municipality = new municipality();
        $municipality->Delete($id);
    }

    public  function showTopTree():void
    {
        $card = '';
        $list = new municipality();
        $data = $list->topTreePlaces();

        if ($data){
            foreach ($data as $row){
                $card .= '
                <!-- card start-->
            <div class="card p-0 col-lg-3 col-md-5">
                <img style="object-fit: cover; height: 30vh" class="img-fluid" src="assets/municipalityUploaded/'.$row['image'].'" alt="image">
                <div class="card-body">
                    <h5>'.$row['municipalityName'].'</h5>
                </div>
                <div class="card-footer"> 
                  <button data-bs-target="#descriptionModal_'.$row['id'].'" data-bs-toggle="modal" style="background-color: #0D5C75" class="btn text-light">Read More</button> 
                </div>
            </div>
           <!-- card end-->
           
        <!-- Modal for detailse-->
            <div class="modal fade" id="descriptionModal_'.$row['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1  style="color: #0D5C75" class="modal-title fs-5" id="exampleModalLabel">Description</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p class="text-muted">'.$row['description'].'</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            ';
            }
            echo $card;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $municipality = new municipalityController();
    match ($_POST['action']) {
        'store' => $municipality->store(),
        'showById' => $municipality->ShowBaseOnId(),
        'update' => $municipality->update(),
        'delete' => $municipality->delete(),
        'topPlaces' => $municipality->showTopTree(),
    };
}