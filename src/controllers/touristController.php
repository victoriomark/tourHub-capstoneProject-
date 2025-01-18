<?phpnamespace controllers;use models\touristSpot;use models\uploadingImage;require_once '../models/touristSpot.php';require_once '../models/uploadingImage.php';class touristController{    public function store():void    {        $image = $_FILES['image'];        $fileDir = '../../assets/uploadedTouristImage/';        $Fields = [          'Title' => 'event title is required',            'Description' => 'description is required',            'Location' => 'location is required',            'municipality_Id' => 'please Select Municipality'        ];        $data = [];        $error = [];        foreach ($Fields as $field => $message){            if (!isset($_POST[$field]) || trim($_POST[$field]) === ''){                $error[$field] = $message;            }else{                $data[$field] = htmlspecialchars($_POST[$field]);            }        }        if (!empty($error)){ // check if the error array is ! empty            $data['success'] = false;            $data['errors'] = $error;            echo json_encode($data);            return;        }        // handle the uploading image        if ($image &&  !empty($image['name'])){            $fileInfo = pathinfo($image['name']);            $fileExtension = strtolower($fileInfo['extension']);            $fileName = uniqid('touristImage_'). '.' .$fileExtension;            $uploadPath = $fileDir. $fileName;            if (!move_uploaded_file($image['tmp_name'],$uploadPath)){                $data['success'] = false;                $data['message'] = 'Upload Failed';                echo json_encode($data);                return;            }            $data['image'] = $fileName;        }else{           echo  json_encode(['success' => false ,'message' => 'image is required']);            return;        }        // call the method to store data       (new touristSpot())->store($data['Title'],$data['Description'],$data['Location'],$data['image'],$data['municipality_Id']);    }    public static function showTitle_Id():void    {        $model = new touristSpot();        $data = $model->showIdAndTitle();        $select = '';        if ($data){          foreach ($data as $row){              $select .='                   <option value="'.$row['id'].'">'.$row['title'].'</option>            ';          }        }else{            $select .='                   <option value="">No Tourist Spot Available</option>            ';        }        echo $select;    }    public static function showAll():void    {       $touristList = new touristSpot();       $data = $touristList->showAll();       $tableTr = '';       if ($data){           foreach ($data as $row){               $tableTr .= '                  <tr>                   <th>'.$row['id'].'</th>                   <td>                    <img style="height: 50px; width: 50px; object-fit: cover;" class="img-fluid" src="../../../assets/uploadedTouristImage/'.$row['image'].'" alt="image">                   </td>                   <td>'.$row['title'].'</td>                   <td>'.$row['location'].'</td>                   <td>                    <button id="btn_edit" value="'.$row['id'].'" class="btn btn-primary">Edit</button>                    <button  id="btn_delete" value="'.$row['id'].'" class="btn btn-danger">Delete</button>                 </td>                 </tr>               ';           }           echo $tableTr;       }    }    public static function showTouristListBaseOnMunicipalityId($id):void    {        $touristList = new touristSpot();        $data = $touristList->showBaseOnId($id);        $card = '';        foreach ($data as $row){            $card .= '                    <!-- Card Start -->                    <form class="card p-0 col-lg-3 col-md-5">                        <img style="height: 40vh; object-fit: cover" class="card-img-top card-img" src="../../assets/uploadedTouristImage/'.$row['image'].'" alt="image">                        <div class="card-body">                            <h5 class="card-title text-light">'.$row['title'].'</h5>                             <div>                               <button type="button" data-bs-target="#InfoModal" data-bs-toggle="modal" class="btn btn-danger">View Details</button>                                <button id="btn_view_gallary" value="'.$row['id'].'" type="button" class="btn btn-danger">Gallery</button>                             </div>                        </div>                    </form>                                               <!-- Modal for Viewing Details -->                        <div class="modal fade" id="InfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">                          <div class="modal-dialog modal-lg modal-dialog-centered">                            <div class="modal-content">                              <div class="modal-header">                                <h1 class="modal-title fs-5" id="exampleModalLabel">'.$row['title'].'</h1>                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                              </div>                              <div class="modal-body">                                <p class="text-muted">'.$row['description'].'</p>                              </div>                              <div class="modal-footer">                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                              </div>                            </div>                          </div>                        </div>                    <!-- Card End -->                ';        }        echo $card;    }    public function showGalleryListBaseOnTouristIdOrEventId(): void    {        // Check if TouristId is provided        if (empty($_POST['TouristId'])) {            http_response_code(400);            echo json_encode(['error' => 'Tourist ID is required.']);            exit;        }        // Sanitize input        $TouristId = filter_var($_POST['TouristId'], FILTER_SANITIZE_NUMBER_INT);        // Call the model to get data        $images = new uploadingImage();        $data = $images->showBaseOnTouristId_orEventId($TouristId);        $modal = '    <!-- Modal containing data -->    <div class="modal fade" id="ShowGalleryModal_' . $TouristId . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">        <div class="modal-dialog modal-xl modal-dialog-centered">            <div class="modal-content">                <div class="modal-header">                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Gallery</h1>                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                </div>                <div class="modal-body row gap-3 position-relative">         ';        if ($data) {            foreach ($data as $row) {                $modal .= '                <div class="card p-0 col-lg-5 col-md-10">                    <img class="img-fluid" src="../../../assets/imageUploaded/' . $row['image'] . '" alt="image">                    <div style="overflow: scroll;" class="card-body p-3">                        <p class="text-light">' . $row['description'] . '</p>                    </div>                </div>            ';            }        }else{            $modal .= '<h5>No Data Available</h5>';        }        $modal .= '                </div>                <div class="modal-footer">                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                </div>            </div>        </div>    </div>    ';        echo $modal;    }    public function showById():void    {        $Id = $_POST['Id'];        $modal = '';        if (empty($Id)){            echo json_encode(['success' => false, 'message' => 'No Id']);            return;        }        $list = new touristSpot();        $data = $list->showByTouristId($Id);        if ($data){            foreach ($data as $row){                $modal .= '                 <form class="modal fade updateTouristModal" id="UpdateModal_'.$row['id'].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">                <div class="modal-dialog modal-dialog-centered">                    <div class="modal-content">                        <div class="modal-header bg-primary">                            <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Update Attraction Details</h1>                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                        </div>                        <div class="modal-body">                            <div class="form-floating mb-3">                                <input type="text" value="'.$row['title'].'" class="form-control" id="Title" placeholder="Title" name="Title" required>                                <label for="Title">Title</label>                            </div>                                        <div class="form-floating mb-3">                                <textarea class="form-control" placeholder="Description" name="Description" id="Description" style="height: 100px" required>                                 '.$row['description'].'                                </textarea>                                <label for="Description">Description</label>                            </div>                                        <div class="form-floating mb-3">                                <input  value="'.$row['location'].'" type="text" class="form-control" id="Location" placeholder="Location" name="Location" required>                                <label for="Location">Location</label>                            </div>                          <input name="Id" type="hidden" value="'.$row['id'].'">                        </div>                        <div class="modal-footer">                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            <button type="submit" class="btn btn-primary">Save Changes</button>                        </div>                    </div>                </div>            </form>                ';            }            echo $modal;        }    }    public function update():void    {        $Id = $_POST['Id'];        $Description = htmlspecialchars($_POST['Description']);        $Title = htmlspecialchars($_POST['Title']);        $Location = htmlspecialchars($_POST['Location']);        if (empty($Id)){            echo json_encode(['success' => false, 'message' => 'No Id']);            return;        }        $Tourist = new touristSpot();        $Tourist->Update($Title,$Description,$Location,$Id);    }    public function delete():void    {        $Id = $_POST['Id'];        if (empty($Id)){            echo json_encode(['success' => false, 'message' => 'No Id']);            return;        }        $Tourist = new touristSpot();        $Tourist->delete($Id);    }    public static function touristSpot():void    {        $user = new touristSpot();        $sum = $user->countedTouristSpot();        echo "<h4>{$sum['countedTouristSpot']}</h4>";    }}if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){    match ($_POST['action']){        'store' => (new touristController())->store(),        'getGallery' => (new touristController())->showGalleryListBaseOnTouristIdOrEventId(),        'showById' => (new touristController())->showById(),        'update' => (new touristController())->update(),        'delete' => (new touristController())->delete(),        default => http_response_code(400)    };}