<?php
    include_once '../config/dbconnect.php';

    $userId= $conn->real_escape_string($_POST['userId']);
    $productId = $conn->real_escape_string($_POST['productId']);
    $description=  $conn->real_escape_string($_POST['description']);
    $quantity = $conn->real_escape_string($_POST['quantity']);
    $status =  "0";
    $payStatus = "0";
    $channel = "mobile";
    $ref = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $referral = $conn->real_escape_string($_POST['ref']);
    $orderRef= 'QPS'.substr(str_shuffle($ref),6,11); 
    $nowr = date("Y-m-d h:i:s");

     //insert to db 
    $sql= "INSERT INTO orders(ord_ref,user_id,product_id,description,quantity,
            price_quote,order_date,pay_stat,referral_id,status,channel)
            VALUES ('$orderRef','$userId','$productId','$description','$quantity',
            '','$nowr','$payStatus','$referral','$status','mobile')";
           
    $result = $conn->query($sql);
    $row = array();
    if($result){
        $id= $conn->insert_id;
        
        $sql2= "SELECT * FROM  `orders`  WHERE order_id = $id AND user_id='$userId'";
        $result2 = $conn->query($sql2);
        if  ($result2){
           while($r = $result2->fetch_array(MYSQLI_ASSOC)) {
              $row = $r;
            }
            $success = array('success' => 1 );
            $order["order"] = $row;
            $response= array_merge($success,$order);
            echo json_encode($response);
         
        }
        else {
            $success = array('success' => 0 );
            $error = array('error'=> $conn->error);
            $response = array_merge($success,$error);
            echo json_encode($response);
        }
       
    }else{
       
            $success = array('success' => 0 );
            $error = array('error'=> $conn->error);
            $response = array_merge($success,$error);
            echo json_encode($response);
    }
    $conn->close();
?>
