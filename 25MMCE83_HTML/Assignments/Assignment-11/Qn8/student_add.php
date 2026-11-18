
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

    require_once "db.php";

    $sic = $_POST['sic'];
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $cgpa = $_POST['cgpa'];

    $conn = get_connection();
    $response = array();

    // Server-side SIC format validation
    if(!preg_match("/^[0-9]{2}[A-Z]{4}[0-9]{2}$/", $sic)){
        $response['status'] = "error";
        $response['message'] = "Invalid SIC Format";
    }
    else if($name == "" || $branch == "" ||
            !is_numeric($cgpa) || $cgpa < 0 || $cgpa > 10){

        $response['status'] = "error";
        $response['message'] = "Enter valid student details";
    }
    else{

        // Check whether SIC already exists
        $sql = "SELECT * FROM student_details WHERE sic=?";

        $ps = $conn->prepare($sql);
        $ps->bind_param("s", $sic);
        $ps->execute();

        $res = $ps->get_result();

        if($res->num_rows > 0){
            $response['status'] = "error";
            $response['message'] = "SIC Number Already Exists";
        }
        else{
            // Insert student details
            $sql = "INSERT INTO student_details
                    (sic, name, branch, cgpa)
                    VALUES (?, ?, ?, ?)";

            $ps = $conn->prepare($sql);
            $ps->bind_param("sssd", $sic, $name, $branch, $cgpa);

            try{
                $result = $ps->execute();

                if($result){
                    $response['status'] = "success";
                    $response['message'] = "Student Registered Successfully";
                }
                else{
                    $response['status'] = "error";
                    $response['message'] = "Registration Failed";
                }
            }
            catch(mysqli_sql_exception $e){
                $response['status'] = "error";

                if($e->getCode() == 1062){
                    $response['message'] = "SIC Number Already Exists";
                }
                else{
                    $response['message'] = "Registration Failed";
                }
            }
        }
    }

    echo json_encode($response);
}
?>
