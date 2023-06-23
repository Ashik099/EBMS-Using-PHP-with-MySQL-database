
<?php include('header.php');
      require_once('functions.php');
    $customerID=$_SESSION['customer'][0]['customerID'];


    if(isset($_POST['changePassword'])){
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
    }

    if(empty($currentPassword)){}
    elseif(empty($currentPassword)){
        $error="Current Password is Required!!";
    }elseif(empty($newPassword)){
        $error="New Password is Required!!";
    }else{
        $dbPassword=customerDetails($customerID,'password');
        $currentPassword=sha1($currentPassword);
        $newPassword=sha1($newPassword);
        
        if($currentPassword != $dbPassword){
            $error="Current Password is Worng!!";
        }elseif($currentPassword == $newPassword){
            $error="Password is Already set!!";
        }else{
            try{
                $stm=$pdo->prepare("UPDATE customer SET password=? WHERE customerID=?");
                $stm->execute(array($newPassword,$customerID));
                $success="Change Password Successfully!!";
            }catch(PDOException $e){
    
            }
        }
        
       
    }
    

?>    
    <div class="row justify-content-center">
        <div class="col-md-6">
                <h1 style="background-color:#4e73df;color:#fff !important;font-weight: bold;display: flex;
                    justify-content: space-between;" class="h3 p-3 mb-4 text-gray-800">Change Password
                </h1>
            <div class="update-profile">
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
                        <script>
                            setTimeout(function(){
                                window.location="logOut.php";
                            },3000)
                        </script>
                    <?php endif; ?>
                <form class="user" method="POST">
                    <div class="form-group">
                        <label class="" for="currentPassword">Current Password:</label>
                       <input type="password" name="currentPassword" class="form-control"
                           id="currentPassword" >
                    </div>
                    <div class="form-group">
                        <label class="" for="newPassword">New Password:</label>
                       <input type="password" name="newPassword" class="form-control"
                           id="newPassword" >
                    </div>
                    <div class="form-group">
                       <input type="submit" name="changePassword" class="btn btn-info" value="Change Password">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?>