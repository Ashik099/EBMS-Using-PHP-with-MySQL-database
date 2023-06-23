<?php require_once('config.php');
require_once('functions.php');
session_start();

    if(isset($_POST['customerLogin'])){
        $loginNumber=$_POST['loginNumber'];
        $loginPassword=$_POST['loginPassword'];
        
        

        if(empty($loginNumber)){
            $error="Number is Required !!";
        }elseif(empty($loginPassword)){
            $error="Number is Required !!";
        }else{
            $pending="Pending";
            $complete="Completed";

            $stm=$pdo->prepare("SELECT customerID,phnoneNumber,password,stats FROM customer WHERE phnoneNumber=?");
            $stm->execute(array($loginNumber));
            $userCount=$stm->rowCount();
            $userData=$stm->fetchAll(PDO::FETCH_ASSOC);
            
            
            if($userCount == 1){
                $loginPassword=sha1($loginPassword);
                $userPass=$userData[0]['password'];


                if($loginPassword==$userPass){
                    $userStats=$userData[0]['stats'];
                    if($userStats == $complete){
                        $_SESSION['customer']=$userData;
                        header('location:index.php');
                    }
                    else{
                        $error="Your Registion Stats is Pending"."<br>"."Please Contact your Admin !!";
                    }
                    
                }else{
                    $error="Number or Password Dose not Match !!";
                }

            }else{
                $error="Number or Password Dose not Match !!";
            }
        }

    }

    if(isset($_SESSION['customer'])){
        header("location:index.php");
    }



?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Biller - Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to Login</h1>
                                    </div>
                                    <!-- ERROR MASSAGE -->
                                    <?php if(isset($error)): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $error;?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- SUCCESS MASSAGE -->
                                    <?php if(isset($success)): ?>
                                        <div class="alert alert-success">
                                            <?php echo $success;?>
                                        </div>
                                    <?php endif; ?>

                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="loginNumber" class="form-control form-control-user"
                                                id="loginNumber" placeholder="Type your Phone Number*">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="loginPassword" class="form-control form-control-user"
                                                id="loginPassword" placeholder="Type your Password*">
                                        </div>

                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <input type="submit" name="customerLogin" value="Login" class="btn btn-primary btn-user btn-block">
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>