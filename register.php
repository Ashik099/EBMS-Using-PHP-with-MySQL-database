<?php 
require_once('config.php');
require_once('functions.php');

try{
    $statement= $pdo->prepare("CREATE TABLE customer(customerID int NOT null AUTO_INCREMENT
     PRIMARY KEY,firstName VARCHAR(255) NOT NULL,lastName VARCHAR(255) NOT NULL,biller_number 
     int NOT NULL UNIQUE,phnoneNumber INT NOT NULL UNIQUE,email VARCHAR(255) NOT NULL UNIQUE,
     fatherName VARCHAR(255),address VARCHAR(255) NOT NULL,birthDate DATE NOT NULL,
     password VARCHAR(255) NOT NULL,retypePassword VARCHAR(255) NOT NULL, 
     registerDate datetime DEFAULT CURRENT_TIMESTAMP,stats VARCHAR(255) DEFAULT 'Pending')");
    $statement->execute();
}catch(PDOException $es){
    
}
  
        // $stm=("CREATE TABLE customer(customerID int NOT null AUTO_INCREMENT PRIMARY KEY,firstName VARCHAR(255) NOT NULL,lastName VARCHAR(255) NOT NULL,biller_number int NOT NULL UNIQUE,phnoneNumber INT NOT NULL UNIQUE,email VARCHAR(255) NOT NULL UNIQUE,fatherName VARCHAR(255),address VARCHAR(255) NOT NULL,birthDate DATE NOT NULL,password VARCHAR(255) NOT NULL,retypePassword VARCHAR(255) NOT NULL, registerDate datetime DEFAULT CURRENT_TIMESTAMP,stats VARCHAR(255))");
        // $conn->exec($stm);
    

    if(isset($_POST['register'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $biller_number = $_POST['biller_number'];
        $phnoneNumber = $_POST['phnoneNumber'];
        $email = $_POST['email'];
        $fatherName = $_POST['fatherName'];
        $address = $_POST['address'];
        $birthDate = $_POST['birthDate'];
        $password = $_POST['password'];
        $retypePassword = $_POST['retypePassword'];

        $emailCount=uniqueCount('email',$email);
        $phnoneNumberCount=uniqueCount('phnoneNumber',$phnoneNumber);
        $biller_numberCount=uniqueCount('biller_number',$biller_number);
    }else{
        
    }

    


    if(empty($firstName)){}
    elseif(empty($firstName)){
        $error="First Name is Required !!";
    }elseif(empty($lastName)){
        $error="Nickname is Required !!";
    }elseif(empty($biller_number)){
        $error="Biller Number is Required !!";
    }
    elseif($biller_numberCount==true){
        $error="Biller Number already Exits !!";
    }elseif(empty($phnoneNumber)){
        $error="Phnone Number is Required !!";
    }elseif($phnoneNumberCount==TRUE){
        $error="Phone Number already Exits !!";
    }elseif(empty($email)){
        $error="Email is Required !!";
    }elseif($emailCount==TRUE){
        $error="Email already Exits !!";
    }elseif(empty($fatherName)){
        $error="First Name is Required !!";
    }elseif(empty($address)){
        $error="First Name is Required !!";
    }elseif(empty($birthDate)){
        $error="Birth of Date is Required !!";
    }elseif(empty($password)){
        $error="First Name is Required !!";
    }elseif(empty($retypePassword)){
        $error="First Name is Required !!";
    }elseif($password!=$retypePassword){
        $error="Password dose not Match !!";
    }else{
        $password=sha1($password);
        $retypePassword=sha1($retypePassword);
        try{
            $stm=$pdo->prepare("INSERT INTO customer(firstName, lastName, biller_number, phnoneNumber, 
            email, fatherName, address, birthDate, password, retypePassword) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stm->execute(array($firstName,$lastName,$biller_number,$phnoneNumber,
            $email,$fatherName,$address,$birthDate,$password,$retypePassword));
            $success="Registation Successfully Done !!";
        }catch(PDOException $e){

        }
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

    <title>Customer-Register</title>

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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
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

                            <form class="user" action="#" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="firstName" class="form-control form-control-user" id="firstName"
                                            placeholder="Enter First Name*">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="lastName" class="form-control form-control-user" id="lastName"
                                            placeholder="Enter Nickname">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" name="biller_number" class="form-control form-control-user" id="biller_number"
                                        placeholder="Enter Biller SMS number*">
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" name="phnoneNumber" class="form-control form-control-user" id="phnoneNumber"
                                        placeholder="Enter Phnone Number*">
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="email"
                                        placeholder="Enter Email Address*">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="fatherName" class="form-control form-control-user" id="fatherName"
                                        placeholder="Enter Father's Name*">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="address" class="form-control form-control-user" id="address"
                                        placeholder="Enter Home Address*">
                                </div>

                                <div class="form-group">
                                    <input type="date" name="birthDate" class="form-control form-control-user" id="birthDate"
                                        placeholder="Enter Birth of Date*">
                                </div>

                                
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Enter Password*">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="retypePassword" class="form-control form-control-user"
                                            id="retypePassword" placeholder="Retype Password*">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="register" class="btn btn-primary btn-user btn-block" value="Register Account">
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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