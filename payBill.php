<?php include('header.php'); 
    $customerID=$_SESSION['customer'][0]['customerID'];


    try{
        $statement= $pdo->prepare("CREATE TABLE payments(
            payID int AUTO_INCREMENT PRIMARY KEY ,
            accountNumber int NOT NULL,
            billID int NOT NULL,
            payMathod varchar(50) NOT NULL,
            payAmount int NOT NULL,
            lateFee int DEFAULT NULL,
            trxID VARCHAR(100) NOT NULL,
            payDate datetime DEFAULT CURRENT_TIMESTAMP,
            paystats VARCHAR(100) DEFAULT 'Pending',
            FOREIGN KEY (billID) REFERENCES bills(billID)
        )");
        $statement->execute();
    }catch(PDOException $es){
        
    }


    if(isset($_POST['payBill'])){
        $accountNumber=$_POST['accountNumber'];
        $amount=$_POST['amount'];
        $payMathod=$_POST['payMathod'];
        $trxID=$_POST['trxID'];
        $billID=billsDetails($customerID,'billID');
        
        if(empty($accountNumber)){
            $error="Account Number is Required !!";
        }elseif(empty($amount)){
            $error="Amount is Required !!";
        }elseif(empty($payMathod)){
            $error="Payment Mathod is Required !!";
        }elseif(empty($trxID)){
            $error="TRX ID is Required !!";
        }else{

            try{
                $stm=$pdo->prepare("INSERT INTO payments(accountNumber,billID,payMathod,payAmount,trxID) VALUES (?,?,?,?,?)");
                $stm->execute(array($accountNumber,$billID,$payMathod,$amount,
                $trxID));
                $success="Payment Successfully !!";
            }catch(PDOException $e){
    
            }
        }

    }


?>




<div class="row justify-content-center mb-4">
    <div class="col-12 col-md-6 col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h4>Welcome to Pay Bill</h4>
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
                    <label>Bill Account Number</label>
                    <input type="text" name="accountNumber" class="form-control"
                        value="<?php echo customerDetails($customerID,'biller_number'); ?>">
                </div>
                <div class="form-group  sub_select">
                    <label>Biller Name</label>
                    <input type="text" name="billerName" class="form-control"
                        value="<?php echo customerDetails($customerID,'lastName'); ?>">
                </div>
                <div class="form-group">
                    <label>Due Amount</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="font-size: 15px;">
                                &#2547;
                            </div>
                        </div>
                        <input type="text" name="amount" class="form-control currency">
                    </div>
                </div>
                <div class="form-group">
                    <label>Select Payment Mathod</label>
                    <select class="form-control" name="payMathod" id="payMathod">
                        <option value="0">Select Payment Mathod</option>
                        <option value="Bkash">Bkash</option>
                        <option value="Rocket">Rocket</option>
                        <option value="Nagad">Nagad</option>
                    </select>
                </div>
                <!-- <div class="p-20 mb-2">
                    <h6 class="font-medium m-b-10">Select Payment Mathod</h6>
                    <div class="selectgroup selectgroup-pills sidebar-color">
                        <label class="selectgroup-item">
                            <input type="radio" name="bkash" value="Bkash" class="selectgroup-input select-sidebar">
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Light Sidebar">Bkash</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="rocket" value="Rocket" class="selectgroup-input select-sidebar">
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Light Sidebar">Rocket</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="nagad" value="Nagad" class="selectgroup-input select-sidebar"
                                checked>
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Dark Sidebar">Nagad</span>
                        </label>
                    </div>
                </div> -->
                <div class="form-group">
                    <label>Transaction ID(TRX)</label>
                    <input name="trxID" type="text" class="form-control">
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" name="payBill" type="submit">Pay Bill</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
        </form>
    </div>
</div>


<?php include('footer.php'); ?>