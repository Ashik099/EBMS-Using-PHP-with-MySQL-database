<?php require_once('header.php'); 
    if(isset($_GET['id'])){
        $c_id=$_GET['id'];
        $stm=$pdo->prepare("DELETE FROM payments WHERE payID=?");
        $stm->execute(array($c_id));
    }

    if(isset($_GET['approveID'])){
        $approveID=$_GET['approveID'];
        $stats="Approve";
        $stm=$pdo->prepare("UPDATE payments SET payStats=? WHERE payID=?");
        $stm->execute(array($stats,$approveID));
    }



?>
<h3 class="h3 mb-3 color-success" >All Pending Payments</h3>
<div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Pending Payment Lists</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr class="">
                            <th class="text-center"> #</th>
                            <th style="min-width: 100px;">Accout Number</th>
                            <th style="min-width: 105px;">Payment Method</th>
                            <th style="min-width: 105px;">Payment Amount</th>
                            <th style="min-width: 105px;">Transaction ID</th>
                            <th>Pay Date</th>
                            <th>Stats</th>
                            <th style="min-width: 180px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stm=$pdo->prepare("SELECT * FROM payments where paystats='Pending'");
                            $stm->execute();
                            $result=$stm->fetchAll(PDO::FETCH_ASSOC);
                
                            $srial=1;
                            foreach($result as $row):
                        ?>
                            <tr>
                                <td><?php echo $srial;$srial++;?></td>
                                <td><?php echo $row['accountNumber'];?></td>
                                <td><?php echo $row['payMathod'];?></td>
                                <td><?php echo $row['payAmount'];?></td>
                                <td><?php echo $row['trxID'];?></td>
                                <td><?php echo $row['payDate'];?></td>
                                
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
                                    <a href="" data-toggle="modal" data-target="#confrimModal<?php echo $row['payID'];?>" class="btn btn-icon mr-1 btn-success">
                                        <i class="fas fa-check"></i> 
                                    </a>
                                    
                                    <a href="#" data-toggle="modal" data-target="#deleteModal<?php echo $row['payID'];?>" class="btn btn-icon btn-danger">
                                        <i class="fas fa-times"></i> 
                                    </a>


                                
                                    <!--Start PENDING TO COMPLETE  Modal -->
                                    <div class="modal fade" id="confrimModal<?php echo $row['payID'];?>" tabindex="-1" role="dialog" aria-labelledby="formModal"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="formModal">Are You Sure Registration Complete?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <a href="pendingPayment.php?approveID=<?php echo $row['payID']; ?>" type="submit" style="float: right;margin-right: 30px;" name="approveCustomer" class="btn btn-success waves-effect">Approved</a>
    
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END PENDING TO COMPLETE Modal -->
                                    
                                    <!--Start VIEW Modal -->
                                    <div class="modal fade" id="viewModal<?php echo $row['payID'];?>" tabindex="-1" role="dialog" aria-labelledby="formModal"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="mt-4" style="color: #4e73df !important;
                                                    font-weight: bold;
                                                    width: 100%;
                                                    display: flex;
                                                    justify-content: space-between;
                                                    text-align: center;">
                                                    <?php echo $row['lastName'];?>'s Profile 
                                                    <a href="#" class="btn btn-icon mr-1 btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['payID'];?>">
                                                        <i class="fas fa-edit"></i> 
                                                    </a>
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
                                                            <td><?php echo $row['firstName'];?></td>
                                                        </tr>
                                                        <tr class="col-md-6">
                                                            <th>Last Name:</th>
                                                            <td><?php echo $row['lastName'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Bill Account Number:</th>
                                                            <td><?php echo $row['biller_number'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mobile Number:</th>
                                                            <td><?php echo $row['phnoneNumber'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email Address:</th>
                                                            <td><?php echo $row['email'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Father's Name:</th>
                                                            <td><?php echo $row['fatherName'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address:</th>
                                                            <td><?php echo $row['address'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Birth of Date:</th>
                                                            <td><?php echo $row['birthDate'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Regiseration Data:</th>
                                                            <td><?php echo date('d-M-Y',strtotime($row['registerDate']));?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Register Stats:</th>
                                                            <td><?php echo '<div class="badge badge-success badge-shadow">';
                                                                echo $row['stats'];echo '</div>';?>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END VIEW Modal -->

                                    <!--Start DELETE Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $row['payID'];?>" tabindex="-1" role="dialog" aria-labelledby="formModal"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="formModal">Are You Sure Remove This Customer?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <a href="pendingPaymet.php?id=<?php echo $row['payID']; ?>" type="submit" style="float: right;margin-right: 30px;" name="deleteCustomer" class="btn btn-danger m-t-30 waves-effect">Delete</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END DELETE Modal -->
                                </td>




                            </tr>
                        <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

<?php require_once('footer.php'); ?>