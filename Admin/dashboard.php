<?php include_once("header.php");?>
		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Notification </div>
									<div class="card-category">Customers travel alert</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1"></div>
											<h6 class="fw-bold mt-3 mb-0">Today</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-2"></div>
											<h6 class="fw-bold mt-3 mb-0">This Week</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3"></div>
											<h6 class="fw-bold mt-3 mb-0">Next Week</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Total income & spend statistics</div>
									<div class="row py-3">
										<div class="col-md-4 d-flex flex-column justify-content-around">
											<div>
												<h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
												<h3 class="fw-bold">&#8377; 0.00</h3>
											</div>
											<div>
												<h6 class="fw-bold text-uppercase text-danger op-8">Total Spend</h6>
												<h3 class="fw-bold">&#8377; 0.00</h3>
											</div>
										</div>
										<div class="col-md-8">
											<div id="chart-container">
												<canvas id="totalIncomeChart"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Transactions</div>
										<div class="card-tools">
											
										</div>
                                         
									</div>
								</div>
								<div class="card-body">
									<div class="chart-container" style="min-height: 375px">
										<!-- <p align="center">No records found</p>-->
                                        <?php
                                             $cusinvoice =  $mysql->select("select  sum(InvoiceValue) as InvoiceAmt,  sum(PaidAmount) as PAmount, (sum(InvoiceValue)-sum(PaidAmount)) as BalanceAmt from _tbl_invoices ");
                                             
                                        ?>
                                         <?php $BrancheOutstanding = $mysql->select("SELECT  SUM(PaidToAdmin) AS pamt, SUM(ReceviedAmount)as ramt, (SUM(PaidToAdmin)-SUM(ReceviedAmount)) AS amt FROM _tbl_branches_accounts "); ?>
                       
                                        <table>
                                            <tr>
                                                <td><b>Overall Invoice wise</b></td>
                                            </tr>
                                            <tr>
                                                <td>Invoice Amount</td>
                                                <td style="text-align:right;padding-left:100px;"><?php echo number_format($cusinvoice[0]['InvoiceAmt'],2);?></td>
                                            </tr>
                                              <tr>
                                                <td>Receipt Amount</td>
                                                <td style="text-align:right"><?php echo number_format($cusinvoice[0]['PAmount'],2);?></td>
                                            </tr>
                                            <tr>
                                                <td>Payable Amount</td>
                                                <td style="text-align:right"><?php echo number_format($cusinvoice[0]['BalanceAmt'],2);?></td>
                                            </tr>
                                            <tr>
                                                <td><br><Br><br></td>
                                            </tr>
                                            <tr>
                                                <td><b>Overall Branch wise</b></td>
                                            </tr>
                                            <tr>
                                                <td>Collected</td>
                                                <td style="text-align:right"><?php echo number_format($BrancheOutstanding[0]['ramt'],2);?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Total Paid To Admin</td>
                                                <td style="text-align:right"><?php echo number_format($BrancheOutstanding[0]['pamt'],2);?></td>
                                            </tr>
                                            <tr>
                                                <td>Balance Paid To Admin</td>
                                                <td style="text-align:right"><?php echo number_format($BrancheOutstanding[0]['amt'],2);?></td>
                                            </tr>
                                        </table>
									</div>
									<div id="myChartLegend"></div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-primary">
								<div class="card-header">
									<div class="card-title">Daily Status</div>
									<div class="card-category"><?php echo date("Y-m-d");?></div>
								</div>
								<div class="card-body pb-0">
									<div class="mb-4 mt-2">
                                        <div class="card-title">Invoice Amount</div>
                                        <div class="card-category">&#8377; 0.00</div>
                                        <h1>&nbsp;</h1>
                                        <div class="card-title">Receipts</div>
                                        <div class="card-category">&#8377; 0.00</div>
									</div>
									 
								</div>
							</div>
							<div class="card">
								<div class="card-body pb-0">
									<div class="h1 fw-bold float-right text-warning"></div>
									<h2 class="mb-2">0</h2>
									<p class="text-muted">Transactions</p>
									<div class="pull-in sparkline-fix">
										<div id="lineChart"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    
	<?php include_once("footer.php");?>
    !-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<script>
        Circles.create({
            id:'circles-1',
            radius:45,
            value:60,
            maxValue:100,
            width:7,
            text: 0,
            colors:['#f1f1f1', '#FF9E27'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })

        Circles.create({
            id:'circles-2',
            radius:45,
            value:70,
            maxValue:100,
            width:7,
            text: 0,
            colors:['#f1f1f1', '#2BB930'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })

        Circles.create({
            id:'circles-3',
            radius:45,
            value:40,
            maxValue:100,
            width:7,
            text: 0,
            colors:['#f1f1f1', '#F25961'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })

        var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

        var mytotalIncomeChart = new Chart(totalIncomeChart, {
            type: 'bar',
            data: {
                labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
                datasets : [{
                    label: "Total Sale",
                    backgroundColor: '#ff9e27',
                    borderColor: 'rgb(23, 125, 255)',
                    data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false //this will remove only the label
                        },
                        gridLines : {
                            drawBorder: false,
                            display : false
                        }
                    }],
                    xAxes : [ {
                        gridLines : {
                            drawBorder: false,
                            display : false
                        }
                    }]
                },
            }
        });

       /* $('#lineChart').sparkline([105,103,123,100,95,105,115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });  */
    </script>