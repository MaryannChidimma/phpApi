<?php
     include_once '../config/dbconnect.php';

    $userId = $conn->real_escape_string($_POST['userId']);
    $orderRef = $conn->real_escape_string($_POST['orderRef']);
    $orderId= $conn->real_escape_string($_POST['orderId']);
    $productId = $conn->real_escape_string($_POST['productId']);
    $poDetails =  "";
    $poDate =   "";
    $requsetStatus =  "0";
    $channel = "mobile";
    $amountPaid = $conn->real_escape_string($_POST['amount']);
    $totalAmount = $conn->real_escape_string($_POST['totalAmount']);
    $payDate = date("Y-m-d h:i:s");

    if(isset($_POST['poDetails'])){
        $poDetails=  $conn->real_escape_string($_POST['poDetails']);
    $poDate = $conn->real_escape_string($_POST['poDate']);
    }

    $sql ="INSERT INTO `request`( `order_id`, `user_id`, `product_id`, `po_details`,
             `po_date`, `amount_paid`, `total_amount`, `pay_date`, `channel`, `request_status`)
              VALUES ($orderId,$userId,$productId,$poDetails,$poDate,$amountPaid,$totalAmount,$payDate,
              $channel,$requsetStatus);UPDATE orders SET pay_stat =1 WHERE user_id = $userId AND ord_ref='$orderRef'";
    $result = $conn->query($sql);
    if($result){
        $error = array('error'=>"");
        $success = array('success' => 1 );
        $message = array('message' =>"Payment sucessful.A confirmation mail will be sent to you." );
        $response = array_merge($success,$message,$error);
        echo json_encode($response);
    }else{
         $success = array('success' => 0 );
        $error = array('error'=>$conn->error);
        $message = array('message' =>"" );
        $response = array_merge($success,$message,$error);
        echo json_encode($response);
    }
     $conn->close();
?>