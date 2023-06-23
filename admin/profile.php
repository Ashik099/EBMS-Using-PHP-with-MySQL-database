<?php require_once('header.php');
$adminID=$_SESSION['admins'][0]['adminID'];


?>
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                      <div class="author-box-name">
                        <a href="#"><?php echo adminDetails($adminID,'name');?></a>
                      </div>
                      <div class="author-box-job"><?php echo adminDetails($adminID,'designation');?></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4>Personal Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">
                      <p class="clearfix">
                        <span class="float-left">
                          Birthday
                        </span>
                        <span class="float-right text-muted">
                        <?php echo adminDetails($adminID,'birthday');?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Phone
                        </span>
                        <span class="float-right text-muted">
                        <?php echo adminDetails($adminID,'adminMobile');?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Email
                        </span>
                        <span class="float-right text-muted">
                        <?php echo adminDetails($adminID,'adminEmail');?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Address
                        </span>
                        <span class="float-right text-muted">
                        <?php echo adminDetails($adminID,'address');?>
                        </span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#profile" role="tab"
                          aria-selected="true">Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#changePassword" role="tab"
                          aria-selected="false">Change Password</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#changePhoto" role="tab"
                          aria-selected="false">Change Photo</a>
                      </li>
                      
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab2">
                        <form method="post" class="needs-validation">
                            <div class="card-header">
                              <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="form-group col-md-12">
                                  <label>Full Name</label>
                                  <input type="text" class="form-control" value="<?php echo adminDetails($adminID,'name');?>">
                                  <div class="invalid-feedback">
                                    Please fill in the first name
                                  </div>
                                </div>
                                <div class="form-group col-md-12">
                                  <label>Email</label>
                                  <input type="email" class="form-control" value="<?php echo adminDetails($adminID,'adminEmail');?>">
                                  <div class="invalid-feedback">
                                    Please fill in the email
                                  </div>
                                </div>
                                <div class="form-group col-md-12">
                                  <label>Phone</label>
                                  <input type="tel" class="form-control" value="<?php echo adminDetails($adminID,'adminMobile');?>">
                                </div>
                                <div class="form-group col-md-12">
                                  <label>Address</label>
                                  <input type="text" class="form-control" value="<?php echo adminDetails($adminID,'address');?>">
                                  <div class="invalid-feedback">
                                    Please fill in the last name
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card-footer text-right">
                              <button type="submit" class="btn btn-primary">UPdate Profile</button>
                            </div>
                          </form>
                      </div>

                      <div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="profile-tab2">
                        <form method="post" class="needs-validation">
                          <div class="card-header">
                            <h4>Changes Password</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-md-12">
                                <label>Current Password</label>
                                <input type="password" name="currentPassword" class="form-control">
                                <div class="invalid-feedback">
                                  Please fill in the first Current Password
                                </div>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="">New Password</label>
                                <input type="password" name="newPassword" class="form-control">
                                <div class="invalid-feedback">
                                  Please fill in the last New Password
                                </div>
                              </div>
                              <div class="form-group col-md-12">
                                <label>Retype New Password</label>
                                <input type="password" class="form-control" name="retypeNewPassword">
                                <div class="invalid-feedback">
                                  Please fill in the Retype Password
                                </div>
                              </div>
                              <div class="card-footer text-right">
                                <input type="submit" class="btn btn-primary" class="form-control" value="Changes Password">
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- Change Photo -->
                      <div class="tab-pane fade" id="changePhoto" role="tabpanel" aria-labelledby="profile-tab3">
                        <form method="post" class="needs-validation">
                          <div class="card-header">
                            <h4>Change Photo</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>Upload Photo</label>
                                <input type="file" class="form-control" value="John">
                              </div>
                            </div>
                          </div>

                          <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                          </div>
                        </form>
                      </div>
  
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php require_once('footer.php'); ?>