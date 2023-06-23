


<?php

require_once('functions.php');
session_start();
    $customerID=$_SESSION['customer'][0]['customerID'];
    $billID=billsDetails($customerID,'billID');
    
$conn = mysqli_connect("localhost","root","","ebms") or die("Connection Failed");

$sql = "SELECT * FROM payments WHERE payMathod = '{$_POST['searchInput']}' OR trxID='{$_POST['searchInput']}' and billID='$billID'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

$output = "";

if(mysqli_num_rows($result) > 0):
  $srial=1;
  ?>
<thead>
    <tr class="">
        <th class="text-center"> #</th>
        <th style="min-width: 100px;">Accout Number</th>
        <th style="min-width: 105px;">Payment Method</th>
        <th style="min-width: 105px;">Payment Amount</th>
        <th style="min-width: 105px;">Transaction ID</th>
        <th>Pay Date</th>
        <th>Stats</th>
        <th style="min-width: 100px;">Action</th>
    </tr>
</thead><?php
  while($row = mysqli_fetch_assoc($result)):
 ?>

<tr>
    <td><?php echo $srial;$srial++;?></td>
    <td><?php echo $row['accountNumber'];?></td>
    <td><?php echo $row['payMathod'];?></td>
    <td><?php echo $row['payAmount'];?></td>
    <td><?php echo $row['trxID'];?></td>
    <td><?php echo date('d-M-Y',strtotime($row['payDate']));?></td>

    <td>
        <?php
              if($row['paystats']=="Pending"){
                  echo '<div class="badge badge-warning badge-shadow">';
                      echo $row['paystats'];
                  echo '</div>';
              }else{
                  echo '<div class="badge badge-success badge-shadow">';
                      echo $row['paystats'];
                  echo '</div>';
              }
          
          ?>

    </td>
    <!-- Action -->


    <td>
        <a href="" data-toggle="modal" data-target="#viewModal<?php echo $row['payID'];?>"
            class="btn btn-icon mr-1 btn-success">
            <i class="fas fa-eye"></i>
        </a>

        <!--Start VIEW Modal -->
        <div class="modal fade" id="viewModal<?php echo $row['payID'];?>" tabindex="-1" role="dialog"
            aria-labelledby="formModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mt-4" style="color: #4e73df !important;
                         font-weight: bold;
                         width: 100%;
                         display: flex;
                         justify-content: space-between;
                         text-align: center;">
                            Payment Details
                        </h3>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table-border">
                            <tbody>
                                <tr class="col-md-6">
                                    <th>First Name:</th>
                                    <td><?php echo $row['accountNumber'];?></td>
                                </tr>
                                <tr class="col-md-6">
                                    <th>First Name:</th>
                                    <td><?php echo $row['payMathod'];?></td>
                                </tr>
                                <tr class="col-md-6">
                                    <th>First Name:</th>
                                    <td><?php echo $row['payAmount'];?></td>
                                </tr>
                                <tr class="col-md-6">
                                    <th>First Name:</th>
                                    <td><?php echo $row['trxID'];?></td>
                                </tr>
                                
                                <tr>
                                    <th>Regiseration Data:</th>
                                    <td><?php echo date('d-M-Y',strtotime($row['payDate']));?></td>
                                </tr>
                                <tr>
                                    <th>Register Stats:</th>
                                    <td><?php echo '<div class="badge badge-success badge-shadow">';
                                     echo $row['paystats'];echo '</div>';?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--END VIEW Modal -->
    </td>
</tr>
<?php endwhile;?>

<?php else: 
     echo "<h4 style='text-align:center;'>No Record Found.</h4>"; exit;?>
<?php endif; require_once('footer.php');?>