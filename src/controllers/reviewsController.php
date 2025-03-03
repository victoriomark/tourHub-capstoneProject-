<?php

namespace controllers;
use models\reviews;

require_once '../models/reviews.php';
class reviewsController
{
public  function storeReviews():void
{
    $message = htmlspecialchars($_POST['message']);
    $name = htmlspecialchars($_POST['name']);
    $attraction = htmlspecialchars($_POST['attraction']);

    if (empty($message)){
        echo json_encode(['success' => false, 'message' => 'message is required']);
        return;
    }

    if (empty($attraction)){
        echo json_encode(['success' => false, 'message' => 'please select attraction']);
        return;
    }

    if (empty($name)){
        echo json_encode(['success' => false, 'message' => 'name is required']);
        return;
    }

    $storeReview = new reviews();
    $storeReview->store($message,$attraction,$name);
}

    public function showReviews(): void
    {
        $reviews = new reviews();
        $data = $reviews->show();
        $card = '';

        if ($data) {
            foreach ($data as $row) {
                $name = htmlspecialchars($row['name']);
                $message = htmlspecialchars($row['message']);
                $attraction = htmlspecialchars($row['attraction']);
                $card .= '
             <div class="swiper-slide">
                <div id="review_card" class="card bg-transparent border-0 text-center shadow" style="max-width: 300px; border-radius: 10px;">
                    <div class="card-header bg-white position-relative">
                        <div class="rounded-circle overflow-hidden mx-auto" >
                            <img  src="assets/img/user.jpg" alt="User" class="img-fluid col-lg-6">
                        </div>
                         <h6 class="fw-bold mt-3">' . $name . '</h5>
                    </div>
                    <div style="background-color: #0D5C75" class="card-body text-white rounded-bottom">
                        <p class="fst-italic">" ' . $message . ' "</p>
                         <p class="fst-italic">' . $attraction . '</p>
                    </div>
                </div>
            </div>';
            }
            echo $card;
        } else {
            echo "<img class='img-fluid col-lg-1 placeholder-wave' src='assets/img/no_data.svg' alt='No Data'>";
        }
    }


}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){
    $makeReview = new reviewsController();

    match ($_POST['action']){
        'storeReview' => $makeReview->storeReviews(),
        'showAll' => $makeReview->showReviews(),
         default => http_response_code(400)
    };
}