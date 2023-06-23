<?php require_once('header.php'); 

?>
<h3 class="h3 mb-3 color-success" >All Customers Bills</h3>
<div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Bills History</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr class="">
                            <th class="text-center"> #</th>
                            <th style="min-width: 130px;">Biller Name</th>
                            <th style="min-width: 100px;">Biller Number</th>
                            <th style="min-width: 100px;">Pay Amount</th>
                            <th style="min-width: 100px;">Bill Create Date</th>
                            <th style="min-width: 100px;">Pya Last Date</th>
                            <th style="min-width: 100px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stm=$pdo->prepare("SELECT * FROM bills");
                            $stm->execute();
                            $result=$stm->fetchAll(PDO::FETCH_ASSOC);
                
                            $srial=1;
                            foreach($result as $row):
                        ?>
                            <tr>
                                <td><?php echo $srial;$srial++;?></td>
                                <td><?php echo $row['billerName'];?></td>
                                <td><?php echo $row['accountNumber'];?></td>
                                <td><?php echo $row['amount'];?></td>
                                <td><?php echo date('d-M-Y',strtotime($row['billCreateData']));?></td>
                                <td><?php echo date('d-M',strtotime($row['lastDate'])); ?></td>
                                <!-- Action -->
                                <td>
                                    <a href="singleBillModify.php?id=<?php echo $row['customerID']; ?>" class="btn mr-1 btn-icon btn-info">
                                        <i class="fas fa-edit"></i> 
                                    </a>
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