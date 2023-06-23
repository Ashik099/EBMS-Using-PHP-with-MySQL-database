
<?php
    require_once('../config.php');
    require_once('../functions.php');
    session_start();
    if(!isset($_SESSION['admins'])){
        header('location:admin-login.php');
    }

    $adminID=$_SESSION['admins'][0]['adminID'];
    
    if(isset($_GET['id'])){
      $senderID=$_GET['id'];
      $condi="Where senderID=?";
      $messageID=messageDetails($senderID,'messageID', $condi);

      $stm=$pdo->prepare("UPDATE message_text SET stats='1' WHERE messageID=?");
      $stm->execute(array($messageID));
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>EBMS Admin Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <!-- <div class="loader"></div> -->
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav style="height: 90px;" class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            </li>
          </ul>
        </div>

        <?php
        $stm=$pdo->prepare("SELECT *
        FROM message_text mt
        JOIN message m ON mt.messageID = m.messageID
        WHERE mt.stats = '0' AND m.receiverID = 1");
        $stm->execute();
        $count=$stm->rowCount();
        ?>
        
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
              <span class="badge headerBadge1">
                <?php echo $count; ?></span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Messages
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <?php
                  $stm=$pdo->prepare("SELECT *
                  FROM message_text mt
                  JOIN message m ON mt.messageID = m.messageID
                  WHERE mt.stats = '0' AND m.receiverID = 1");
                  $stm->execute();
                  $result=$stm->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result as $row):
                    $smsID=$row['messageID'];
                    $condi="Where messageID=?";
                    $senterID=messageDetails($smsID,'senderID', $condi);
                ?>
                <a href="adminSupports.php?id=<?php echo $senterID; ?>" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $row['subject']; ?></span>
                    <span class="time messege-text"><?php echo $row['textContent']; ?></span>
                    <span class="time">
                    <!-- Time Counting -->
                      <?php
                          $database_time = $row['timeMessage'];
                          $current_time = date("Y-m-d H:i:s");

                          $difference = strtotime($current_time) - strtotime($database_time);

                          $hours = floor($difference / 3600);
                          $minutes = floor($difference / 60) - $hours * 60;
                          $seconds = $difference - $hours * 3600 - $minutes * 60;

                          $formatted_hours = str_pad($hours % 12, 2, "0", STR_PAD_LEFT);

                          $formatted_minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

                          $formatted_seconds = str_pad($seconds, 2, "0", STR_PAD_LEFT);

                          $time_ago = "";

                          switch ($difference) {
                          case $difference < 60:
                              $time_ago = $formatted_minutes . " minutes ago";
                              break;
                          case $difference < 86400:
                              $time_ago = floor($difference / 3600) . " hours ago";
                              break;
                          default:
                              $time_ago = ceil($difference / 86400) . " days ago";
                              break;
                          }

                          echo $time_ago;
                      ?>
                    </span>
                  </span>
                </a>
              <?php endforeach; ?>
              </div>
              <div class="dropdown-footer text-center">
                <a href="supportHistory.php">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>

          
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo adminDetails($adminID,'name');?></div>
              
              <a href="profile.php" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a> 
               <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                  Settings
                </a>
              <div class="dropdown-divider"></div>
              <a href="logOut.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.php"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">EBMS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Customers</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="pendingCustomers.php">Pending Customers</a></li>
                <li><a class="nav-link" href="approveCustomers.php">Approved Customers</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="dollar-sign"></i><span>Bills Option</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="createBill.php">Create Bill</a></li>
                <li><a class="nav-link" href="modifyBill.php">Modify Bill</a></li>
                <li><a class="nav-link" href="billHistory.php">Billing History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-cart"></i><span>Payments Option</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="PendingPayment.php">Pending Payment List</a></li>
                <li><a class="nav-link" href="paymentHistory.php">Payments History</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="help-circle"></i><span>Supports</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="supportHistory.php">Customer Supports</a></li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">