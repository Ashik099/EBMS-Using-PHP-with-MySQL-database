<?php require_once('header.php');
      $stm=$pdo->prepare("SELECT * FROM customer");
      $stm->execute();
      $result=$stm->fetchAll(PDO::FETCH_ASSOC);


    if(isset($_POST['modifyBill'])){
        $billerName=$_POST['billerName'];
        $customerID=$_POST['billerID'];
        $accountNumber=customerDetails($customerID,'biller_number');
        $amount=$_POST['amount'];
        $lastDate=$_POST['lastDate'];

        if(empty($billerName)){
            $error="Name is Required !!";
        }elseif(empty($accountNumber)){
            $error="Account Number is Required !!";
        }elseif(empty($amount)){
            $error="Bill Amount is Required !!";
        }elseif(empty($lastDate)){
            $error="Last Date is Required !!";
        }else{

            try{
                $stm=$pdo->prepare("UPDATE bills SET billerName=?,amount=?,lastDate=? WHERE customerID=?");
                $stm->execute(array($billerName,$amount,$lastDate,$customerID));
                $success="Modify $billerName's Bill Successfully !!";
            }catch(PDOException $e){
    
            }
        }
    }
    

?>

<div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-8">
        <form class="card" method="POST">
            <div class="card-header">
                <h4>Modifiy Bill Details</h4>
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
                    <select class="form-control" name="billerID" id="billAccountNo">
                        <?php foreach($result as $row): ?>
                        <option value="<?php echo $row['customerID'];?>"><?php echo $row['biller_number'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group  idName">
                    <label>Biller Name</label>
                    <input type="text" name="billerName" class="form-control" value="">
                    <label>Amount</label>

                    <input name="amount" type="text" class="form-control mb-4" value="">

                    <label>Last Date</label>
                    <input name="lastDate" type="date" class="form-control" value="">
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" name="modifyBill" type="submit">Modify</button>
            </div>
        </form>
    </div>
</div>

<?php require_once('footer.php');