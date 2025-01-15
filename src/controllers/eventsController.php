<?phpnamespace controllers;use models\events;include_once '../models/events.php';class eventsController{    public function store():void    {        $image = $_FILES['image'];        $fileDir = '../../assets/EventUploadedImage/';        $Fields = [            'Title' => 'event title is required',            'Description' => 'description is required',            'Location' => 'location is required',             'Date' => 'date is required'        ];        $data = [];        $error = [];        foreach ($Fields as $field => $message){            if (!isset($_POST[$field]) || trim($_POST[$field]) === ''){                $error[$field] = $message;            }else{                $data[$field] = htmlspecialchars($_POST[$field]);            }        }        if (!empty($error)){ // check if the error array is ! empty            $data['success'] = false;            $data['errors'] = $error;            echo json_encode($data);            return;        }        // handle the uploading image        if ($image &&  !empty($image['name'])){            $fileInfo = pathinfo($image['name']);            $fileExtension = strtolower($fileInfo['extension']);            $fileName = uniqid('EventImage_'). '.' .$fileExtension;            $uploadPath = $fileDir. $fileName;            if (!move_uploaded_file($image['tmp_name'],$uploadPath)){                $data['success'] = false;                $data['message'] = 'Upload Failed';                echo json_encode($data);                return;            }            $data['image'] = $fileName;        }else{            echo  json_encode(['success' => false ,'message' => 'image is required']);            return;        }        // call the method to store data        (new events())->store($data['Title'],$data['Description'],$data['image'],$data['Date'],$data['Location']);    }    public static function showAll():void    {        $eventList = new events();        $data = $eventList->showAll();        $tableTr = '';        if ($data){            foreach ($data as $row){                $tableTr .= '                  <tr>                   <th>'.$row['id'].'</th>                   <td>                    <img style="height: 50px; width: 50px; object-fit: cover;" class="img-fluid" src="../../assets/EventUploadedImage/'.$row['image'].'" alt="image">                   </td>                   <td>'.$row['evnetName'].'</td>                   <td>'.$row['location'].'</td>                    <td>'.$row['date'].'</td>                   <td>                    <button id="btn_edit" value="'.$row['id'].'" class="btn btn-primary">Edit</button>                    <button  id="btn_delete" value="'.$row['id'].'" class="btn btn-danger">Delete</button>                 </td>                 </tr>               ';            }            echo $tableTr;        }    }    public function ShowBaseOnId():void    {        $id = $_POST['Id'];        if (empty($id)){            echo json_encode(['success' => false, 'message' => 'No Id Probated']);            return;        }        $list = new events();        $data = $list->showBaseOnId($id);        $modal = '';        if ($data){            foreach ($data as $row){                $modal .= '                 <!-- Modal -->                <form class="modal updateModalEvent fade" id="modal_update_'.$id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">                  <div class="modal-dialog modal-dialog-centered">                    <div class="modal-content">                      <div class="modal-header">                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Event Details</h1>                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                      </div>                      <div class="modal-body">                       <div class="form-floating mb-3">                          <input name="eventName" value="'.$row['evnetName'].'" type="text" class="form-control" id="eventName" placeholder="eventName" required>                          <label for="EventName">EventName</label>                        </div>                        <input name="Id" type="hidden" value="'.$row['id'].'" >                        <div class="form-floating">                          <textarea name="Description" class="form-control" placeholder="Description" id="Description" style="height: 100px" required>                         '.$row['description'].'                         </textarea>                          <label for="Description">Description</label>                        </div>                      </div>                      <div class="modal-footer">                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                        <button type="submit" class="btn btn-primary">Save Changes</button>                      </div>                    </div>                  </div>                </form>              ';            }        }        echo $modal;    }    public function update()    {        $Id = $_POST['Id'];        $EventName = htmlspecialchars($_POST['eventName']);        $description = htmlspecialchars($_POST['Description']);        if (empty($Id)){            echo json_encode(['success' => false, 'message' => 'No Id Probated']);            return;        }        $event = new events();        $event->update($EventName,$description,$Id);    }    public function delete()    {        $Id = $_POST['Id'];        if (empty($Id)){            echo json_encode(['success' => false, 'message' => 'No Id Probated']);            return;        }        $event = new events();        $event->Delete($Id);    }}if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){    $event = new eventsController();    match ($_POST['action']){        'store' => $event->store(),        'showById' => $event->ShowBaseOnId(),        'update' => $event->update(),        'delete' => $event->delete(),        default => http_response_code(400)    };}