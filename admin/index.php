<?php require_once('header.php');
require_once('../config.php'); 


?>

<div class="row ">

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Total Customers</h5>
                                <h2 class="mb-3 font-18">
                                    <?php echo allCount('customer'); ?>
                                </h2>
                                <p class="mb-0"><span class="col-green">Yearly</span> Count</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="assets/img/banner/2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">New Customers</h5>
                                <h2 class="mb-3 font-18">
                                    <?php 
                                    $condition="WHERE stats='Pending'";
                                    $select="*";
                                    echo countWithCondition($select,'customer',$condition); 
                                  ?>
                                </h2>
                                </h2>
                                <p class="mb-0"><span class="col-orange">Pending</span> Customers</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="assets/img/banner/1.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Runing Customers</h5>
                                <h2 class="mb-3 font-18">
                                    <?php 
                                      $condition="WHERE stats='Completed'";
                                      $select="*";
                                      echo countWithCondition($select,'customer',$condition); 
                                  ?>
                                </h2>
                                <p class="mb-0"><span class="col-green">Registation</span>
                                    Done</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="assets/img/banner/3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Total Bills</h5>
                                <h2 class="mb-3 font-18"><strong class="font-30">&#2547;</strong>
                                    <?php
                            
                                        $condition="";
                                        $select="SUM(amount)";
                                        $TotalBills=clculateWithCondition($select,'bills',$condition);
                                        if($TotalBills==0){
                                            echo 00; 
                                        }else{
                                            echo $TotalBills;
                                        }
                                        
                                    ?>
                                </h2>
                                <p class="mb-0"><span class="col-green">Bills</span> Amount</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="assets/img/banner/7.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Due Bills</h5>
                                <h2 class="mb-3 font-18"><strong class="font-30">&#2547;</strong>
                                    <?php

                                        $Condition="";
                                        $selectpayAmount="SUM(payAmount)";
                                        $totalPayments=clculateWithCondition($selectpayAmount,'payments',$Condition);
                            
                                        $condition="";
                                        $select="SUM(amount)";
                                        $TotalBills=clculateWithCondition($select,'bills',$condition);

                                        $dueBills=$TotalBills-$totalPayments;
                                        if($dueBills==0){
                                            echo 00; 
                                        }else{
                                            echo $dueBills;
                                        }
                                        
                                    ?>
                                </h2>
                                <p class="mb-0"><span class="col-red">Due</span> Amount</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="assets/img/banner/5.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Total Payment</h5>
                                <h2 class="mb-3 font-18"><strong class="font-30">&#2547;</strong>
                                    <?php
                            
                                        $condition="WHERE payStats='Approve'";
                                        $select="SUM(payAmount)";
                                        $approvePayment=clculateWithCondition($select,'payments',$condition);
                                        if($approvePayment==0){
                                            echo 00; 
                                        }else{
                                            echo $approvePayment;
                                        }
                                        
                                    ?>
                                </h2>
                                <p class="mb-0"><span class="col-green">Approved</span> Payments</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="assets/img/banner/8.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Total Pending</h5>
                                <h2 class="mb-3 font-18"><strong class="font-30">&#2547;</strong>
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
                                </h2>
                                <p class="mb-0"><span class="col-yellow">Pending</span> Amount</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="assets/img/banner/6.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<?php require_once('footer.php'); ?>