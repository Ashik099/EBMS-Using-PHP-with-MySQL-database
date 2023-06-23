<?php include('header.php'); 
    $customerID=$_SESSION['customer'][0]['customerID'];
?>    
    <div class="row justify-content-center">
        <div class="col-md-6">
                <h1 style="background-color:#4e73df;color:#fff !important;font-weight: bold;display: flex;
                    justify-content: space-between;" class="h3 p-3 mb-4 text-gray-800">Profile 
                    <a href="profileUpdate.php" class="btn btn-light">Update Profile</a>
                </h1>
            <table class="table table-striped table-bordered">

                <tbody>
                    <tr>
                        <th>First Name:</th>
                        <td><?php echo customerDetails($customerID,'firstName');?></td>
                    </tr>
                    <tr>
                        <th>Nick Name:</th>
                        <td><?php echo customerDetails($customerID,'lastName');?></td>
                    </tr>
                    <tr>
                        <th>Biller AC No:</th>
                        <td><?php echo customerDetails($customerID,'biller_number');?></td>
                    </tr>
                    <tr>
                        <th>Phone Number:</th>
                        <td><?php echo customerDetails($customerID,'phnoneNumber');?></td>
                    </tr>
                    <tr>
                        <th>Email Address:</th>
                        <td><?php echo customerDetails($customerID,'email');?></td>
                    </tr>
                    <tr>
                        <th>Father's Name:</th>
                        <td><?php echo customerDetails($customerID,'fatherName');?></td>
                    </tr>
                    <tr>
                        <th>Home Address:</th>
                        <td><?php echo customerDetails($customerID,'address');?></td>
                    </tr>
                    <tr>
                        <th>Birth of Date:</th>
                        <td><?php echo customerDetails($customerID,'birthDate');?></td>
                    </tr>
                               
                </tbody>
            </table>
        </div>
    </div>

<?php include('footer.php'); ?>