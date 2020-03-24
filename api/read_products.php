<?php
include_once '../config/dbconnect.php';
//"SELECT * FROM products as p,product_details as pd WHERE p.product_id = pd.product_id ";

$sql ="SELECT * fROM products";

    $result = $conn->query($sql);
    $row = array();
    if ($result){
        if($result->num_rows > 0){
           while($r = $result->fetch_array(MYSQL_ASSOC)) {
              $row[] = $r;
            }
            $success = array('success' => 1 );
            $product["products"] = $row;
            $response= array_merge($success,$product);
            echo json_encode($response);
         
        }else{
            $success = array('success' => 0 );
            $product["products"] = $row;
            $response= array_merge($success,$product);
            echo json_encode($response);
        }
    }else{
        $success = array('success' => 3 );
        $response= array_merge($success);
        echo json_encode($response);    
    }
    $conn->close();
?>