
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $email = $_POST['email'];

    require_once "db.php";

    $sql = "SELECT * FROM userdb WHERE email=?";

    $conn = get_connection();

    $ps = $conn->prepare($sql);
    $ps->bind_param("s", $email);
    $ps->execute();

    $res = $ps->get_result();

    $response = array();

    if($res->num_rows > 0){
        $response['status'] = "taken";
    }
    else{
        $response['status'] = "available";
    }

    echo json_encode($response);
}
?>
