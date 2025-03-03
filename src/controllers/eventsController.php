<?php

namespace controllers;
use models\events;

include_once '../models/events.php';
class eventsController
{
    public function store():void
    {
        $image = $_FILES['image'];
        $fileDir = '../../assets/EventUploadedImage/';

        $Fields = [
            'Description' => 'description is required',
            'Location' => 'location is required',
             'FestivalDate' => 'festival date is required',
             'nameOfPatron' => 'name of the patron is requred',
             'FiestaDate' => 'fiesta date is requred',
              'FestivalName' => 'festival name is required'
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

            $fileName = uniqid('EventImage_'). '.' .$fileExtension;
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

        // call the method to store data
        (new events())->store(
            $data['Description'],
            $data['image'],
            $data['FiestaDate'],
            $data['Location'],
            $data['nameOfPatron'],
            $data['FestivalDate'],
            $data['FestivalName']
        );
    }


    public static function showAll():void
    {
        $eventList = new events();
        $data = $eventList->showAll();
        $tableTr = '';

        if ($data){
            foreach ($data as $row){
                $tableTr .= '
                  <tr>
                   <th>'.$row['id'].'</th>
                   <td>
                    <img style="height: 50px; width: 50px; object-fit: cover;" class="img-fluid" src="../../assets/EventUploadedImage/'.$row['image'].'" alt="image">
                   </td>
                   <td>'.$row['nameOfThePatron'].'</td>
                   <td>'.$row['FestivalDate'].'</td>
                    <td>'.$row['fiestaDate'].'</td>
                     <td>'.$row['location'].'</td>
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

    public function ShowBaseOnId():void
    {
        $id = $_POST['Id'];

        if (empty($id)){
            echo json_encode(['success' => false, 'message' => 'No Id Probated']);
            return;
        }

        $list = new events();
        $data = $list->showBaseOnId($id);
        $modal = '';

        if ($data){
            foreach ($data as $row){
                $modal .= '
                 <!-- Modal -->
                <form class="modal updateModalEvent fade" id="modal_update_'.$id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Event Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                       <div class="form-floating mb-3">
                          <input name="nameOfPatron" value="'.$row['nameOfThePatron'].'" type="text" class="form-control" id="nameOfPatron" placeholder="nameOfPatron" required>
                          <label for="nameOfPatron">patron</label>
                        </div>
                        
                          <div class="form-floating mb-3">
                          <input name="fiestaDate" value="'.$row['fiestaDate'].'" type="text" class="form-control" id="fiestaDate" placeholder="fiestaDate" required>
                          <label for="fiestaDate">FiestaDate</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                          <input name="FestivalDate" value="'.$row['FestivalDate'].'" type="text" class="form-control" id="FestivalDate" placeholder="FestivalDate" required>
                          <label for="FestivalDate">FestivalDate</label>
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

    public function update()
    {
        $Id = $_POST['Id'];
        $FestivalDate = htmlspecialchars($_POST['FestivalDate']);
        $description = htmlspecialchars($_POST['Description']);
        $fiestaDate = htmlspecialchars($_POST['fiestaDate']);
        $nameOfPatron = htmlspecialchars($_POST['nameOfPatron']);

        if (empty($Id)){
            echo json_encode(['success' => false, 'message' => 'No Id Probated']);
            return;
        }

        $event = new events();
        $event->update($nameOfPatron,$fiestaDate,$FestivalDate,$description,$Id);
    }

    public function delete()
    {
        $Id = $_POST['Id'];
        if (empty($Id)){
            echo json_encode(['success' => false, 'message' => 'No Id Probated']);
            return;
        }

        $event = new events();
        $event->Delete($Id);
    }


    public static function showAllCard():void
    {
        $list = new events();
        $data = $list->showAll();
        $card = '';

        if ($data){
            foreach ($data as $row){
                $card .= '
                   <!-- Card Start -->
                    <div style="height: 20vh; width: 200px" action="showTouristSpotBaseOnMunicipality.php" method="post" class="card p-0 col-lg-3 col-md-5">
                        <img class="card-img" src="../../assets/EventUploadedImage/'.$row['image'].'" alt="image">
                        <div class="card-body">
                            <h5 class="card-title text-light">'.$row['location'].'</h5>
                            <button data-bs-target="#DetailsModal_'.$row['id'].'" data-bs-toggle="modal" type="button" class="btn btn-danger">View Details</button>
                        </div>
                    </div>
                    <!-- Card End -->
                    
                      <!-- modal for viewing details -->
                    <div class="modal fade" id="DetailsModal_'.$row['id'].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">'.$row['location'].'</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                             <div class="d-flex flex-column justify-content-center align-items-center P-3">
                             <h1>NAME OF THE PATRON</h1>
                              <span>'.$row['nameOfThePatron'].'</span>
                              <img style="min-height: 50vh; object-fit: cover" class="card-img-top card-img" src="../../assets/EventUploadedImage/'.$row['image'].'" alt="image">
                           </div>
                          <div class="mt-4">
                          <div class="d-flex flex-column justify-content-center align-items-center">
                            <h1>FIESTA</h1>
                            <span>'.$row['fiestaDate'].'</span>
                            </div>
                            
                            <div class="d-flex flex-column justify-content-center align-items-center">
                             <h1>DATE OF FESTIVAL</h1>
                             <span>'.$row['FestivalDate'].'</span>
                            </div>
                             <div class="d-flex flex-column justify-content-center align-items-center">
                             <h1>BRIEF DESCRIPTION</h1>
                             <span class="text-center">'.$row['description'].'</span>
                            </div>
                         </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                ';
            }
        }
        echo $card;
    }

    public static function countedEvents():void
    {
        $event = new events();
        $sum = $event->countedEvent();
        echo "<h4>{$sum['countedEvent']}</h4>";
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){
    $event = new eventsController();
    match ($_POST['action']){
        'store' => $event->store(),
        'showById' => $event->ShowBaseOnId(),
        'update' => $event->update(),
        'delete' => $event->delete(),
        default => http_response_code(400)
    };
}