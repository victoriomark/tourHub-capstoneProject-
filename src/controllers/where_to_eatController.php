<?phpnamespace controllers;use models\where_to_eat;require_once '../models/where_to_eat.php';class where_to_eatController{  public  function store():void  {      $PlaceName = htmlspecialchars($_POST['PlaceName']);      $category = htmlspecialchars($_POST['category']);      $municipality = htmlspecialchars($_POST['municipality']);      if (empty($municipality)){          echo json_encode(['success' => false, 'message' => 'municipality is required']);          return;      }      if (empty($PlaceName)){          echo json_encode(['success' => false, 'message' => 'PlaceName is required']);          return;      }     if (empty($category)){          echo json_encode(['success' => false, 'message' => 'category is required']);          return;      }     $store = new where_to_eat();     $store->store($PlaceName,$category,$municipality);  }  public function FilterByCategoryAndMunicipality():void  {      $category = htmlspecialchars($_POST['category']);      $municipality = htmlspecialchars($_POST['municipality']);      $model = new where_to_eat();      $data = $model->filterByCategoryAndMunicipality($category,$municipality);      $tr = '';      if ($data){          foreach ($data as $row){              $tr .= '                <tr>                   <td>'.$row['place'].'</td>                   <td>'.$row['municipality'].'</td>               </tr>              ';          }          echo $tr;      }  }   public function showAll():void  {      $model = new where_to_eat();      $data = $model->showAll();      $tr = '';      if ($data){          foreach ($data as $row){              $tr .= '                <tr>                   <td>'.$row['place'].'</td>                   <td>'.$row['municipality'].'</td>               </tr>              ';          }      }else{           $tr .= '<tr><td>No Data Available</td> </tr>';      }      echo  $tr;  }    public static function showAllToAdmin():void    {        $model = new where_to_eat();        $data = $model->showAll();        $tr = '';        if ($data){            foreach ($data as $row){                $tr .= '                <tr>                   <td>'.$row['id'].'</td>                   <td>'.$row['place'].'</td>                   <td>'.$row['category'].'</td>                   <td>'.$row['municipality'].'</td>                    <td>                      <button id="btn_delete" value="'.$row['id'].'" class="btn btn-danger">Delete</button>                    </td>               </tr>              ';            }        }        echo  $tr;    }    public function showCategoryAndMunicipality(): void    {        $result = new where_to_eat(); // Assuming this is a model class        $data = $result->showCategoryAndMunicipality();        if ($data) {            // Create the initial structure for the selects            $municipalityOptions = '<option value="" selected>Select Municipality</option>';            $categoryOptions = '<option value="" selected>Select Category</option>';            // Populate options from the data            foreach ($data as $row) {                $municipalityOptions .= '<option value="' . htmlspecialchars($row['municipality']) . '">' . htmlspecialchars($row['municipality']) . '</option>';                $categoryOptions .= '<option value="' . htmlspecialchars($row['category']) . '">' . htmlspecialchars($row['category']) . '</option>';            }            // Output the select elements with populated options            echo '            <select name="municipality" id="filterSelect" class="form-select" aria-label="Municipality select">                ' . $municipalityOptions . '            </select>            <select name="category" id="category" class="form-select" aria-label="Category select">                ' . $categoryOptions . '            </select>        ';        } else {            // Handle the case where no data is returned            echo '<p>No data available for municipality or category.</p>';        }        echo "<button class='btn btn-primary' type='submit''>Filter</button>";    }    public function Delete():void    {        $Id = htmlspecialchars($_POST['Id']);        if (empty($Id)){            echo json_encode(['success' => false, 'message' => 'Error']);            return;        }        $model = new where_to_eat();        $model->Delete($Id);    }    public  function showByMunicipality():void    {        $municipality = $_POST['municipality'];        $model = new  where_to_eat();        $data = $model->showBaseOnMunicipality($municipality);        $tr = '';        if ($data){            foreach ($data as $row){                $tr.= '                   <tr>                      <td>'.$row['place'].'</td>                       <td>'.$row['category'].'</td>                       <td>'.$row['municipality'].'</td>                  </tr>                ';            }            echo $tr;        }    }}if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){    match ($_POST['action']){        'store' => (new  where_to_eatController())->store(),        'Filter' => (new  where_to_eatController())->FilterByCategoryAndMunicipality(),        'showCategoryAndMunicipality' => (new  where_to_eatController())->showCategoryAndMunicipality(),        'showAll' => (new  where_to_eatController())->showAll(),        'Delete' => (new  where_to_eatController())->Delete(),        'showByMunicipality_' => (new  where_to_eatController())->showByMunicipality(),        default => http_response_code(400)    };}