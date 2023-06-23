<?php include('header.php');
      require_once('functions.php');
    $customerID=$_SESSION['customer'][0]['customerID'];


    if(isset($_POST['profileUpdate'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['nickName'];
        $fatherName = $_POST['fatherName'];
        $address = $_POST['address'];
    }

    if(empty($firstName)){}
    elseif(empty($firstName)){
        $error="Empty First Name Does not Update!!";
    }elseif(empty($lastName)){
        $error="Empty Nick Name Does not Update!!";
    }elseif(empty($fatherName)){
        $error="Empty Father's Name Does not Update!!";
    }elseif(empty($address)){
        $error="Empty Addrss Does not Update!!";
    }
    
    
    else{
        
        try{
            $stm=$pdo->prepare("UPDATE customer SET firstName=?,lastName=?,fatherName=?,address=? WHERE customerID=?");
            $stm->execute(array($firstName,$lastName,$fatherName,$address,$customerID));
            $success="Profile Upadate Successfully!!";
        }catch(PDOException $e){

        }
       
    }
    

?>    
    <div class="row justify-content-center">
        <div class="col-md-6">
                <h1 style="background-color:#4e73df;color:#fff !important;font-weight: bold;display: flex;
                    justify-content: space-between;" class="h3 p-3 mb-4 text-gray-800">Welcome for Update Profile
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
                <form class="user" method="POST">
                    <div class="form-group">
                        <label class="" for="firstName">First Name:</label>
                       <input type="text" value="<?php echo customerDetails($customerID,'firstName');?>" name="firstName" class="form-control"
                           id="firstName" >
                    </div>
                    <div class="form-group">
                        <label class="" for="lastName">Nick Name:</label>
                       <input type="text" value="<?php echo customerDetails($customerID,'lastName');?>" name="nickName" class="form-control"
                           id="lastName" >
                    </div>
                    <div class="form-group">
                        <label class="" for="biller_number ">Biller AC Number:</label>
                       <input type="text" disabled value="<?php echo customerDetails($customerID,'biller_number');?>" name="biller_number" class="form-control"
                           id="biller_number " >
                    </div>
                    <div class="form-group">
                        <label class="" for="phnoneNumber">Phnone Number :</label>
                       <input type="text" disabled value="<?php echo customerDetails($customerID,'phnoneNumber');?>" name="phnoneNumber" class="form-control"
                           id="phnoneNumber" >
                    </div>
                    <div class="form-group">
                        <label class="" for="email">Email Address:</label>
                       <input type="email" disabled value="<?php echo customerDetails($customerID,'email');?>" name="email" class="form-control"
                           id="email" >
                    </div>
                    <div class="form-group">
                        <label class="" for="fatherName">Father's Name:</label>
                       <input type="text" value="<?php echo customerDetails($customerID,'fatherName');?>" name="fatherName" class="form-control"
                           id="fatherName" >
                    </div>
                   
                    <div class="form-group">
                        <label class="" for="address">Home Address:</label>
                       <input type="text" value="<?php echo customerDetails($customerID,'address');?>" name="address" class="form-control"
                           id="address" >
                    </div>
                    <div class="form-group">
                        <label class="" for="birthDate">Birth of Date:</label>
                       <input type="date" disabled value="<?php echo customerDetails($customerID,'birthDate');?>" name="birthDate" class="form-control "
                           id="birthDate" >
                    </div>
                    
                    <div class="form-group">
                       <input type="submit" name="profileUpdate" class="btn btn-info" value="Update Profile">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include('footer.php') ?>