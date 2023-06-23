<?php require_once('../config.php');
      require_once('functions.php');
      session_start();

try{
  $statement= $pdo->prepare("CREATE TABLE admins(adminID int NOT null AUTO_INCREMENT
   PRIMARY KEY,name VARCHAR(255) NOT NULL,userName VARCHAR(255) NOT NULL UNIQUE,
   adminMobile INT NOT NULL UNIQUE,adminEmail VARCHAR(255) NOT NULL UNIQUE, 
   address VARCHAR(255) NOT NULL, designation varchar(255), birthday DATE NOT NULL,
   password VARCHAR(255) NOT NULL)");

  // INSERT INTO `admins` (`adminID`, `name`, `userName`, `adminMobile`, `adminEmail`, `address`, `designation`, `birthday`, `password`) VALUES (NULL, 'Ashaduzzaman Ashik', 'admin', '01796075198', 'admin@gmail.com', 'Phulbari,Dinajpur', 'Web Expart', '2000-08-15', SHA1('admin123'));

  $statement->execute();
}catch(PDOException $es){
  
}


  if(isset($_POST['adminLogin'])){
    $userName=$_POST['ad_userName'];
    $password=$_POST['password'];

        if(empty($userName)){
          $error="Username is Required !!";
      }elseif(empty($password)){
          $error="Password is Required !!";
      }else{
          $stm=$pdo->prepare("SELECT adminID,userName,adminEmail,password FROM admins WHERE userName=?");
          $stm->execute(array($userName));
          $userCount=$stm->rowCount();
          $adminData=$stm->fetchAll(PDO::FETCH_ASSOC);
          
          
          if($userCount == 1){
              $loginPassword=sha1($password);
              $adminPass=$adminData[0]['password'];
              $adminUsername=$adminData[0]['userName'];
              $adminEmail=$adminData[0]['adminEmail'];


              if($loginPassword==$adminPass && ($userName == $adminUsername or $userName==$adminEmail)){
                    $_SESSION['admins']=$adminData;
                    header('location:index.php');    
              }else{
                  $error="Username or Password Dose not Match !!";
              }

          }else{
              $error="Username or Password Dose not Match !!";
          }
      }

  }

  if(isset($_SESSION['admins'])){
    header("location:index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin-Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Admin Login</h4>
              </div>
              <div class="card-body">
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
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="ad_userName">UserName/Email</label>
                    <input id="ad_userName" type="text" class="form-control" name="ad_userName" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="forgotPassword.php" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="adminLogin" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>
</html>