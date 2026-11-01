<?php
include_once "navbar.php";
require_once "db.php";
$msg = "";
$error = false;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    try{ 
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM userdb WHERE email = ? AND password = ?";
        $conn = get_connection();
        $ps = $conn->prepare($sql);
        $ps->bind_param("ss", $email, $password);
        $ps->execute();
        $rs = $ps->get_result();
        if($rs -> num_rows == 1){
            $user = $rs->fetch_assoc();
            session_start();
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            header("location:dashboard.php");
        }   else {
            $msg = "Invalid Email or Password";
        }
    } catch (mysqli_sql_exception $se) {
        $msg = "DB Error: " . $se->getMessage() . " @Line: " . $se->getLine();
        $error = true;
    } catch (Exception $e) {
        $msg = "Error: " . $e->getMessage() . " @Line: " . $e->getLine();
        $error = true;
    }
}
?>
<main class="container py-3 min-vh-75">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Login Here</h3>
                </div>
                <div class="card-body">
                    <p class="text-danger"><?php echo $msg; ?></p>
                    <form action="login.php" method="post">
                        <input type="email" name="email" class="form-control mb-2" placeholder="Email">
                        <input type="password" name="password" class="form-control mb-2" placeholder="Password">
                        <input type="submit" class="btn btn-primary" value="Log In">
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
