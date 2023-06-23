
<?php include('header.php');
      require_once('functions.php');
    $customerID=$_SESSION['customer'][0]['customerID'];


    if(isset($_POST['uploadPhoto'])){
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
    }

    if(empty($currentPassword)){}
    elseif(empty($currentPassword)){
        $error="Current Password is Required!!";
    }elseif(empty($newPassword)){
        $error="New Password is Required!!";
    }else{
        
        
        if($currentPassword != $dbPassword){
            $error="Current Password is Worng!!";
        }elseif($currentPassword == $newPassword){
            $error="Password is Already set!!";
        }else{
            try{
                // $stm=$pdo->prepare("UPDATE customer SET password=? WHERE customerID=?");
                // $stm->execute(array($newPassword,$customerID));
                $success="Photo Upload Successfully!!";
            }catch(PDOException $e){
    
            }
        }
        
       
    }
    

?>    
    <div class="row justify-content-center">
        <div class="col-md-6">
                <h1 style="background-color:#4e73df;color:#fff !important;font-weight: bold;display: flex;
                    justify-content: space-between;" class="h3 p-3 mb-4 text-gray-800">Upload Profile Photo
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
                    <?php endif; ?>
                <form class="user" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="" for="photo">Upload Profile Photo:</label>
                       <input type="file" name="photo" class="form-control"
                           id="photo" >
                    </div>
                    <div class="form-group">
                       <input type="submit" name="uploadPhoto" class="btn btn-info" value="Upload Photo">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?>