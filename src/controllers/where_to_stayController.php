<?phpnamespace controllers;use models\where_to_stay;require_once '../models/where_to_stay.php';class where_to_stayController{    public  function store():void    {        $PlaceName = htmlspecialchars($_POST['PlaceName']);        $phoneNumber = htmlspecialchars($_POST['phoneNumber']);        $municipality = htmlspecialchars($_POST['municipality']);        if (empty($municipality)){            echo json_encode(['success' => false, 'message' => 'municipality is required']);            return;        }        if (empty($PlaceName)){            echo json_encode(['success' => false, 'message' => 'PlaceName is required']);            return;        }        if (empty($phoneNumber)){            echo json_encode(['success' => false, 'message' => 'phone number is required']);            return;        }        $store = new where_to_stay();        $store->store($PlaceName,$phoneNumber,$municipality);    }    public  function show ():void    {        $list = new where_to_stay();        $data = $list->showAll();        $tr = '';        if ($data){            foreach ($data as $row){                $tr .= '            <tr>                <th>'.$row['id'].'</th>                <td>'.$row['place_name'].'</td>                <td>+'.$row['phoneNumber'].'</td>                <td>'.$row['municipality'].'</td>            </tr>                ';            }            echo $tr;        }    }    public  function showBaseMunicipality():void    {        $municipality = htmlspecialchars($_POST['municipality']);        $list = new where_to_stay();        $data = $list->showByMunicipality($municipality);        $tr = '';        if ($data){            foreach ($data as $row){                $tr .= '            <tr>                <th>'.$row['id'].'</th>                <td>'.$row['place_name'].'</td>                <td>+'.$row['phoneNumber'].'</td>                <td>'.$row['municipality'].'</td>            </tr>                ';            }            echo $tr;        }    }    public  function showMunicipality():void    {        $list = new where_to_stay();        $data = $list->showMunicipality();        $select = '';        if ($data){            foreach ($data as $row){                $select .= '                   <option value="'.$row['municipality'].'">'.$row['municipality'].'</option>                ';            }            echo $select;        }    }    public static function showAllToAdmin():void    {        $model = new where_to_stay();        $data = $model->showAll();        $tr = '';        if ($data){            foreach ($data as $row){                $tr .= '                <tr>                   <td>'.$row['id'].'</td>                   <td>'.$row['place_name'].'</td>                   <td>'.$row['phoneNumber'].'</td>                   <td>'.$row['municipality'].'</td>                    <td>                      <button data-bs-target="#staticBackdrop_'.$row['id'].'" data-bs-toggle="modal" value="'.$row['id'].'" class="btn btn-primary">Edit</button>                       <button id="btn_delete" value="'.$row['id'].'" class="btn btn-danger">Delete</button>                    </td>               </tr>                                          <!-- Modal -->            <div class="modal fade" id="staticBackdrop_'.$row['id'].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">              <div class="modal-dialog modal-dialog-centered">                <div class="modal-content">                  <div class="modal-header">                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update</h1>                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                  </div>                  <form> <!-- Form starts here -->                    <div class="modal-body">                      <div class="form-floating mb-3">                        <input type="text" value="'.$row['place_name'].'" name="place" class="form-control" id="floatingInput" placeholder="Place" required>                        <label for="floatingInput">Place</label>                      </div>                                             <div class="form-floating mb-3">                        <input type="text" value="'.$row['municipality'].'" name="place" class="form-control" id="Municipality" placeholder="Municipality" required>                        <label for="Municipality">Municipality</label>                      </div>                                             <div class="form-floating mb-3">                        <input type="text" value="'.$row['phoneNumber'].'" name="place" class="form-control" id="PhoneNumber" placeholder="PhoneNumber" required>                        <label for="PhoneNumber">Phone Number</label>                      </div>                                          </div>                    <div class="modal-footer">                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                      <button type="submit" class="btn btn-primary">Save Changes</button> <!-- Make sure to use type="submit" -->                    </div>                  </form> <!-- Form ends here -->                </div>              </div>            </div>              ';            }        }        echo  $tr;    }}if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){    match ($_POST['action']){        'store' => ( new where_to_stayController())->store(),        'show' => ( new where_to_stayController())->show(),        'filter' => ( new where_to_stayController())->showBaseMunicipality(),        'showToSelectMunicipality' => ( new where_to_stayController())->showMunicipality(),        default => http_response_code(400)    };}