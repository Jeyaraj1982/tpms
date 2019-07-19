<?php
    include_once("../config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>TPMS : Admin Console</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>
    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css">
</head>
<style>
.sub-header{
padding: 5px;
margin-bottom:15px;
background-color: transparent;
border-bottom: 1px solid #ebecec !important;
}
.errorstring{
    color:red;
}
</style>
<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">
                
                <a href="index.php" class="logo">
                    <!--<img src="../assets/img/logo.svg" alt="navbar brand" class="navbar-brand"> -->
                </a>
              <!--  <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>-->
                <div class="nav-toggle">
                    <!--<button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>-->
                </div>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">            
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img src="../assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4>Hizrian</h4>
                                                Administrator
                                               <!-- <p class="text-muted">hello@example.com</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>-->
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="MyProfile.php">My Profile</a>
                                        <a class="dropdown-item" href="ChangePassword.php">Change Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="index.php?action=logout">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-primary">
                        <li class="nav-item">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#Masters">
                                <i class="fas fa-layer-group"></i>
                                <p>Masters</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="Masters">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="ManageCustomer.php">
                                            <span class="sub-item">Customer Master</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ManageSupplier.php">
                                            <span class="sub-item">Supplier Master</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ManageProduct.php">
                                            <span class="sub-item">Product Master</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#Branch">
                                <i class="fas fa-layer-group"></i>
                                <p>Branch</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="Branch">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="CreateBranch.php">
                                            <span class="sub-item">Create Branch</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ManageBranch.php">
                                            <span class="sub-item">Manage Branches</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>                                                           
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#BookingDetails">
                                <i class="fas fa-layer-group"></i>
                                <p>Booking Details</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="BookingDetails">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="ViewRecentBookings.php">
                                            <span class="sub-item">View Recent Bookings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Report.php">
                                            <span class="sub-item">Report</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#Accounts">
                                <i class="fas fa-layer-group"></i>
                                <p>Accounts</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="Accounts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="CustomerWiseOutStanding.php">
                                            <span class="sub-item">Customer Wise OutStanding</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="BranchWiseOutStanding.php">
                                            <span class="sub-item">Branch Wise OutStanding</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#Profile">
                                <i class="fas fa-layer-group"></i>
                                <p>Profile</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="Profile">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="MyProfile.php">
                                            <span class="sub-item">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ChangePassword.php">
                                            <span class="sub-item">Change Password</span>                     
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>