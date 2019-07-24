<?php
include_once("../config.php");
   if (isset($_SESSION['User']) && $_SESSION['User']['BranchID']>0) {
} else {
     echo "<script>location.href='index.php';</script>"; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>TPMS : Branch Console</title>
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
#star{
    color: red;
}
</style>
<body>
	<div class="wrapper ">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				<!--<a href="index.php" class="logo">
					<img src="../assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
				</a> -->
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
							<ul class="dropdown-menu dropdown-user animated fadeIn" style="width:200px;">
								<div class="dropdown-user-scroll scrollbar-outer">
									<!--<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>Hizrian</h4>
											</div>
										</div>
									</li>-->
									<li>
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
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
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
                            <a data-toggle="collapse" href="#Booking">
                                <i class="fas fa-layer-group"></i>
                                <p>Orders</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="Booking">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="NewBookingForm.php">                                     
                                            <span class="sub-item">New Order</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ViewOrders.php">
                                            <span class="sub-item">Recent Orders</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ViewOrders.php?filter=Invoiced">
                                            <span class="sub-item">Invoiced Orders</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ViewOrders.php?filter=nonInvoiced">
                                            <span class="sub-item">Non-Invoiced Orders</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#Invoices">
                                <i class="fas fa-layer-group"></i>
                                <p>Invoices</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="Invoices">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="ViewInvoices.php">
                                            <span class="sub-item">Recent Invoices</span>
                                        </a>
                                    </li> 
                                    <li>
                                        <a href="ViewInvoices.php?filter=Paid">
                                            <span class="sub-item">Paid Invoices</span>
                                        </a>
                                    </li> <li>
                                        <a href="ViewInvoices.php?filter=Unpaid">
                                            <span class="sub-item">Unpaid Invoices</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#Receipts">
                                <i class="fas fa-layer-group"></i>
                                <p>Receipts</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="Receipts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="ViewReceipts.php">
                                            <span class="sub-item">Manage Receipts</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#Customers">
                                <i class="fas fa-layer-group"></i>
                                <p>Customers</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="Customers">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="AddCustomer.php">
                                            <span class="sub-item">Create Customer</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ViewCustomers.php">
                                            <span class="sub-item">Manage My Customers</span>
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
                                        <a href="MyTransactions.php">
                                            <span class="sub-item">My Transactions</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="CustomerWiseOutStanding.php">
                                            <span class="sub-item">Customer Wise OutStanding</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
					</ul>
				</div>
			</div>
		</div>