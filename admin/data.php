<?php
    require_once('../config.php');
    require_once('../functions.php');

    if(isset($_POST['biller_id'])){
        $biller_id=$_POST['biller_id'];

      $stm=$pdo->prepare("SELECT * FROM customer where customerID=?");
      $stm->execute(array($biller_id));
      $result=$stm->fetchAll(PDO::FETCH_ASSOC); ?>

<label>Biller Name</label>
<?php foreach($result as $row): ?>
<input name="billerName" type="text" class="form-control mb-4"
    value="<?php echo $row['firstName'].' '.$row['lastName'];?>">
<?php endforeach; ?>


<?php }


if(isset($_POST['id'])){
    $biller_id=$_POST['id'];

  $stm=$pdo->prepare("SELECT amount,lastDate FROM bills where customerID=?");
  $stm->execute(array($biller_id));
  $result=$stm->fetchAll(PDO::FETCH_ASSOC); ?>

<label>Biller Name</label>
<?php foreach($result as $row): ?>
<input name="billerName" type="text" class="form-control mb-4"
    value="<?php echo customerDetails($biller_id,'firstName').' '.customerDetails($biller_id,'lastName');?>">
<?php endforeach; ?>

<label>Amount</label>
<?php foreach($result as $row): ?>
<input name="amount" type="text" class="form-control mb-4" value="<?php echo $row['amount'];?>">
<?php endforeach; ?>

<label>Last Date</label>
<?php foreach($result as $row): ?>
<input name="lastDate" type="date" class="form-control" value="<?php echo $row['lastDate'];?>">
<?php endforeach; ?>

<?php }



?>