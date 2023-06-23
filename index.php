<?php include('header.php');
      $customerID=$_SESSION['customer'][0]['customerID'];
      
      $stm=$pdo->prepare("SELECT c.firstName, c.lastName,c.biller_number,
      c.phnoneNumber,c.email,c.fatherName,c.address,
      c.birthDate,c.stats,b.amount,b.billCreateData,b.lastDate 
      FROM customer c JOIN bills b ON c.customerID = b.customerID");
      $stm->execute();
      $result=$stm->fetchAll(PDO::FETCH_ASSOC);

      

?>
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Due Bill</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                $conditionBill="WHERE customerID='$customerID'";
                                $select="COUNT(customerID)";
                                $totalBill=clculateWithCondition($select,'bills',$conditionBill);

                                $billID=billsDetails($customerID,'billID');
                                $Condition="WHERE billID='$billID'";
                                $selectpayAmount="SUM(payAmount)";
                                $totalPayments=clculateWithCondition($selectpayAmount,'payments',$Condition);

                                $condition1="WHERE customerID='$customerID'";
                                $select="SUM(amount)";
                                $TotalBills=clculateWithCondition($select,'bills',$condition1);

                                $dueBills=$TotalBills-$totalPayments;
                               
                            if($totalBill==0){
                                echo 00; 
                            }else{
                                echo $dueBills ;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pending Payment</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            
                                $condition="WHERE payStats='Pending'";
                                $select="SUM(payAmount)";
                                $pendingPayment=clculateWithCondition($select,'payments',$condition);
                                if($pendingPayment==0){
                                    echo 00; 
                                }else{
                                    echo $pendingPayment;
                                }
                                
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Payment</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                
                                $condition="WHERE customerID='$customerID'";
                                $select="COUNT(billID)";
                                $customerCount=clculateWithCondition($select,'bills',$condition);
                                if($customerCount==0){
                                    echo 00; 
                                }else{
                                    $billID= billsDetails($customerID,'billID');
                                        $condition="WHERE billID='$billID'";
                                        $select="COUNT(billID)";
                                        
                                        $customerCount=clculateWithCondition($select,'payments',$condition);
                                    if($customerCount==0){
                                        echo 00; 
                                    }else{
                                        $condition="WHERE paystats='Pending' or paystats='Approve' and billID='$billID'";
                                        $select="SUM(payAmount)";
                                        echo clculateWithCondition($select,'payments',$condition);
                                    }
                                }

                                
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Billing Details</h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tbody>
                                <tr>
                                    <th>First Name: </th>
                                    <td><?php echo customerDetails($customerID,'firstName'); ?></td>
                                </tr>
                                <tr>
                                    <th>Last Name: </th>
                                    <td><?php echo customerDetails($customerID,'lastName'); ?></td>
                                </tr>
                                <tr>
                                    <th>Father's Name: </th>
                                    <td><?php echo customerDetails($customerID,'fatherName'); ?></td>
                                </tr>
                                <tr>
                                    <th>Account Number: </th>
                                    <td><?php echo customerDetails($customerID,'biller_number'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Bill Month: </th>
                                    <td>

                                        <?php
                                             $condition="WHERE customerID='$customerID'";
                                             $select="COUNT(customerID)";
                                             $customerCount=clculateWithCondition($select,'bills',$condition);
                                            if($customerCount==0){
                                                echo "Null"; 
                                            }else{
                                                $currentDate = billsDetails($customerID,'billCreateData');
                                                $month = date('F-Y', strtotime($currentDate));
                                                echo $month;
                                            }

                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bill Create Date: </th>
                                    <td>
                                        <?php
                                             $condition="WHERE customerID='$customerID'";
                                             $select="COUNT(customerID)";
                                             $customerCount=clculateWithCondition($select,'bills',$condition);
                                            if($customerCount==0){
                                                echo "Null"; 
                                            }else{
                                                $billCreateDate=billsDetails($customerID,'billCreateData');
                                                $date = date('d-m-y', strtotime($currentDate));
                                                echo  $date; 
                                            }

                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bill Pay Last Date: </th>
                                    <td>
                                        <?php
                                             $condition="WHERE customerID='$customerID'";
                                             $select="COUNT(customerID)";
                                             $customerCount=clculateWithCondition($select,'bills',$condition);
                                            if($customerCount==0){
                                                echo "Null"; 
                                            }else{
                                                $lastDate=billsDetails($customerID,'lastDate');
                                                $date = date('d-m-y', strtotime($lastDate));
                                                echo $date; 
                                            }

                                        ?>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body"
                            style="display: flex;justify-content: center;border: 1px solid;margin-top: 15px;margin-bottom: 15px;">
                            <table>
                                <tbody>

                                    <tr>
                                        <th>
                                            <h4>Total Bill: </h4>
                                        </th>
                                        <td>
                                            <h4>
                                                <?php
                                                    $condition="WHERE customerID='$customerID'";
                                                    $select="COUNT(customerID)";
                                                    $customerCount=clculateWithCondition($select,'bills',$condition);
                                                    if($customerCount==0){
                                                        ?>
                                        <td>
                                            <h4><?php echo "Null"; ?>
                                        </td><?php
                                                    }else{
                                                        echo billsDetails($customerID,'amount');
                                                    }

                                                ?>
                                        </h4>
                                        </td>
                                    </tr>

                                        
                                    <?php 
                                
                                        $condition="WHERE customerID='$customerID'";
                                        $select="COUNT(billID)";
                                        $customerCount=clculateWithCondition($select,'bills',$condition);
                                        if($customerCount==0):?>
                                           
                                        <?php else: 
                                            $billID= billsDetails($customerID,'billID');
                                                $condition="WHERE billID='$billID'";
                                                $select="COUNT(billID)";
                                                
                                                $customerCount=clculateWithCondition($select,'payments',$condition);
                                            if($customerCount==0):?>
                                    <?php else: ?><?php
                                                $select1="payStats='Pending'";
                                                $condition1="WHERE billID='$billID'";
                                                $check=clculateWithCondition($select1,'payments',$condition1);
                                                 ?>
                                    <tr>
                                        <th>
                                            <h4>Total Pending Payment: &nbsp;</h4>
                                        </th>
                                        <td>
                                            <h4><?php $condition="WHERE payStats='Pending' and billID=$billID";$select="SUM(payAmount)"; echo clculateWithCondition($select,'payments',$condition); ?>
                                                
                                            </h4>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <h4>Total Approved Payment: &nbsp;</h4>
                                        </th>
                                        <td>
                                            <h4><?php 
                                            
                                            $condition="WHERE payStats='Approve' and billID=$billID";
                                            $select="SUM(payAmount)"; 
                                            echo clculateWithCondition($select,'payments',$condition); ?>
                                                <!-- <span style="font-size: 14px;"> (Approved)</span> -->
                                            </h4>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endif; ?>




                                    <tr class="border-top">


                                        <th>
                                            <h4>Total (Due/Advance): &nbsp;</h4>
                                        </th>
                                        <?php 
                                
                                        $condition="WHERE customerID='$customerID'";
                                        $select="COUNT(billID)";
                                        $customerCount=clculateWithCondition($select,'bills',$condition);
                                        if($customerCount==0){
                                            ?><td>
                                            <h4><?php echo "Null"; ?>
                                        </td><?php
                                             
                                        }else{
                                            $billID= billsDetails($customerID,'billID');
                                            $select="SUM(payAmount)";
                                            $condition="WHERE paystats='Pending' or paystats='Approve' and billID='$billID'";
                                            $due=billsDetails($customerID,'amount');
                                            $payment=clculateWithCondition($select,'payments',$condition);
                                            $total=$due-$payment;
                                            ?><td>
                                            <h4> <?php echo $total; ?>
                                                <span style="font-size: 14px;"> (Negative Blance means Advance
                                                    Pay)</span>
                                            </h4>
                                        </td><?php
                                        }
                                    ?>


                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a class="btn btn-primary mr-1" href="payBill.php" name="payBill">Pay Bill</a>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include('footer.php'); ?>