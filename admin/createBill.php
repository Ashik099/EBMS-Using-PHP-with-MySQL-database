<?php require_once('header.php');

try{
    $statement= $pdo->prepare("CREATE TABLE bills(
        billID int AUTO_INCREMENT PRIMARY KEY ,
        accountNumber int NOT NULL,
        billerName VARCHAR(100) NOT NULL,
        customerID int NOT NULL,
        amount int NOT NULL,
        billCreateData datetime DEFAULT CURRENT_TIMESTAMP,
        lastDate date NOT NULL,
        FOREIGN KEY (customerID) REFERENCES customer(customerID)
    )");
    $statement->execute();
}catch(PDOException $es){
    
}





      $stm=$pdo->prepare("SELECT * FROM customer");
      $stm->execute();
      $result=$stm->fetchAll(PDO::FETCH_ASSOC);


      

      

    if(isset($_POST['createBill'])){
        $billerName=$_POST['billerName'];
        $customerID=$_POST['billerID'];
        $accountNumber=customerDetails($customerID,'biller_number');
        $amount=$_POST['amount'];
        $lastDate=$_POST['lastDate'];

        $lastMonth = date('F', strtotime($lastDate));
        
        $billCreateData=billsDetails($customerID,'billCreateData');
        $billCreateMonth = date('F', strtotime($billCreateData));

        if(empty($billerName)){
            $error="Name is Required !!";
        }elseif(empty($accountNumber)){
            $error="Account Number is Required !!";
        }elseif(empty($amount)){
            $error="Bill Amount is Required !!";
        }elseif(empty($lastDate)){
            $error="Last Date is Required !!";
        }elseif($lastMonth==$billCreateMonth){
            $error="This Month Bill Already Create !!";
        }else{

            try{
                $stm=$pdo->prepare("INSERT INTO bills(accountNumber,billerName,customerID,amount,lastDate) VALUES (?,?,?,?,?)");
                $stm->execute(array($accountNumber,$billerName,$customerID,$amount,
                $lastDate));
                $success="Bill Create Successfully !!";
            }catch(PDOException $e){
    
            }
        }
    }
    

?>

<div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h4>Create Bill for Biller</h4>
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
            <div class="card-body">
                <div class="form-group">
                    <label>Select Biil Number</label>
                    <select class="form-control" name="billerID" id="biller_number">
                        <?php foreach($result as $row): ?>
                        <option value="<?php echo $row['customerID'];?>"><?php echo $row['biller_number'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group  sub_select">
                    <label>Biller Name</label>
                    <input type="text" name="billerName" class="form-control" value="">
                    <!-- <select name="" class="form-control" id="">
                        <option value="">Select Biller Number</option>
                    </select> -->
                </div>
                <div class="form-group">
                    <label>Bill Amount</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="font-size: 30px;">
                                &#2547;
                            </div>
                        </div>
                        <input type="text" name="amount" class="form-control currency">
                    </div>
                </div>

                <div class="form-group">
                    <label>Payment Last Date</label>
                    <input name="lastDate" type="date" class="form-control">
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" name="createBill" type="submit">Submit</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
        </form>
    </div>
</div>

<?php require_once('footer.php');