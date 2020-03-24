<?php
    include_once '../config/dbconnect.php';

    $userId= $conn->real_escape_string($_POST['userId']);
    $orderId= $conn->real_escape_string($_POST['0rder_Id']);
    $sql2= "DELETE * FROM  `orders`  WHERE user_id='$userId' AND order_id ='$orderId'";
    $result2 = $conn->query($sql2);
    if  ($result2){
        $success = array('success' => 1 );
        $order["order"] = null;
        $response= array_merge($success,$order);
        echo json_encode($response);
         
    }
    else {
            $success = array('success' => 0 );
            $error = array('error'=> $conn->error);
            $response = array_merge($success,$error);
            echo json_encode($response);
    }
    $conn->close();

?>