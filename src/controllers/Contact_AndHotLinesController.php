<?phpnamespace controllers;use models\Contact_AndHotLines;require_once '../models/Contact_AndHotLines.php';require_once '../../Teamplates/JsonResponseHelper.php';class Contact_AndHotLinesController{  public function store():void  {      $PhoneNumber = htmlspecialchars($_POST['PhoneNumber']);      $municipality = htmlspecialchars($_POST['municipality']);      if (empty($PhoneNumber) || empty($municipality)){          \JsonResponseHelper::JsonResponseHelper(false,'Please fill all the Inputs');          return;      }      $model = new Contact_AndHotLines();      $model->store($municipality,$PhoneNumber);  }  public static function showAll():void  {      $list = new Contact_AndHotLines();      $data = $list->showAll();      $tr = '';      if ($data){          foreach ($data as $row){              $tr .= '                 <tr>                    <td>'.$row['id'].'</td>                    <td>'.$row['Mucipality'].'</td>                    <td>'.$row['PhoneNumber'].'</td>                    <td>                     <button data-bs-target="#UpdateContactModal_'.$row['id'].'" data-bs-toggle="modal" class="btn btn-primary">Edit</button>                     <button id="btn_delete" class="btn btn-danger" value="'.$row['id'].'">Delete</button>                    </td>               </tr>                <!-- Modal for updating data -->                <div class="modal fade" id="UpdateContactModal_'.$row['id'].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">                  <div class="modal-dialog modal-dialog-centered">                    <div class="modal-content">                      <div class="modal-header">                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Contact</h1>                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                         <form id="updateModalContact"> <!-- For Start -->                      </div>                      <div class="modal-body">                         <div class="form-floating mb-3">                              <input name="municipality" value="'.$row['Mucipality'].'" type="text" class="form-control" id="Municipality" placeholder="Municipality">                              <label for="Municipality">Municipality</label>                            </div>                                                        <div class="form-floating">                              <input name="PhoneNumber" value="'.$row['PhoneNumber'].'" type="tel" class="form-control" id="PhoneNumber" placeholder="PhoneNumber">                              <label for="PhoneNumber">Phone Number</label>                            </div>                            <input type="hidden" value="'.$row['id'].'" name="Id">                      </div>                      <div class="modal-footer">                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                        <button type="submit" class="btn btn-primary">Save Changes</button>                      </div>                        </form> <!-- Form End -->                    </div>                  </div>                </div>              ';          }          echo $tr;      }  }  public function DisplayToLi():void  {      $list = new Contact_AndHotLines();      $data = $list->showAll();      $li = '';      if ($data){          foreach ($data as $row){              $li .= '                <li>'.$row['Mucipality'].' => '.$row['PhoneNumber'].'</li>              ';          }      }else{          $li .= ' <li>No Contact Available</li>';      }      echo $li;  }    public function Update():void    {        $Id = htmlspecialchars($_POST['Id']);        $PhoneNumber = htmlspecialchars($_POST['PhoneNumber']);        $municipality = htmlspecialchars($_POST['municipality']);        if (empty($Id)){            \JsonResponseHelper::JsonResponseHelper(false, 'NO Id Probated');            return;        }        if (empty($PhoneNumber) && empty($municipality)){            \JsonResponseHelper::JsonResponseHelper(false ,'please fill all inputs');            return;        }        $model = new Contact_AndHotLines();        $model->update($municipality,$PhoneNumber,$Id);    }  public function Delete():void  {      $Id = htmlspecialchars($_POST['Id']);      if (empty($Id)){          \JsonResponseHelper::JsonResponseHelper(false, 'NO Id Probated');          return;      }      $model = new Contact_AndHotLines();      $model->Delete($Id);  }}if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){    match ($_POST['action']){      'store' => (new Contact_AndHotLinesController())->store(),        'Delete' => (new Contact_AndHotLinesController())->Delete(),        'Update' => (new Contact_AndHotLinesController())->Update(),        'Display' => (new Contact_AndHotLinesController())->DisplayToLi(),      default => http_response_code(400)    };}