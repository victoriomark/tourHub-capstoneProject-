<?phpnamespace controllers;use models\reviews;require_once '../models/reviews.php';class reviewsController{public  function storeReviews():void{    $message = htmlspecialchars($_POST['message']);    $userId = htmlspecialchars($_POST['userId']);    if (empty($message)){        echo json_encode(['success' => false, 'message' => 'message is required']);        return;    }    if (empty($userId)){        echo json_encode(['success' => false, 'message' => 'no user Id probated']);        return;    }    $storeReview = new reviews();    $storeReview->store($message,$userId);}public  function showReviews():void{    $reviews = new reviews();    $data = $reviews->show();    $card = '';    if ($data){       foreach ($data as $row){           $fullname = $row['firstName']. ' ' . $row['lastName'];           $card .= '       <div class="swiper-slide">         <div id="card" class="card border-0 p-2">         <h5 class="card-title">'.$fullname.'</h5>           <div class="card-body">              <p class="text-muted">                    '.$row['message'].'                  </p>               </div>             </div>         </div>      ';       }       echo $card;    }}}if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){    $makeReview = new reviewsController();    match ($_POST['action']){        'storeReview' => $makeReview->storeReviews(),        'showAll' => $makeReview->showReviews(),         default => http_response_code(400)    };}