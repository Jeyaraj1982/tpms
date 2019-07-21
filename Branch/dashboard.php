<?php include_once("header.php");?>
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                            <h5 class="text-white op-7 mb-2"></h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href="NewBookingForm.php" class="btn btn-white btn-border btn-round mr-2">Booking</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="page-inner mt--5">
                <div class="row mt--2">
                    <div class="col-md-6">
                        <div class="card full-height">
                            <div class="card-body">
                                <div class="card-title">Overall statistics</div>
                                <div class="card-category">Daily information about statistics in system</div>
                                <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-1"></div>
                                        <h6 class="fw-bold mt-3 mb-0">My Orders</h6>
                                    </div>
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-2"></div>
                                        <h6 class="fw-bold mt-3 mb-0">My Invoices</h6>
                                    </div>
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-3"></div>
                                        <h6 class="fw-bold mt-3 mb-0">My Balance</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                          
                    <div class="col-md-6">
                        <div class="card full-height">
                            <div class="card-body">
                                <div class="card-title">statistics</div>
                                <div class="row py-3">
                                    <div class="col-md-4 d-flex flex-column justify-content-around">
                                        <?php
                                            $wallet= $applicaiton->GetBranchBalance($_SESSION['User']['BranchID']);
                                            if ($wallet>=0) {
                                                ?>
                                                 <div>
                                            <h6 class="fw-bold text-uppercase text-success op-8">My Balance</h6>
                                            <h3 class="fw-bold"><?php echo number_format($wallet,2);?></h3>
                                            </div>
                                             <div>
                                            <h6 class="fw-bold text-uppercase text-danger op-8">Pay To Admin</h6>
                                            <h3 class="fw-bold"><?php echo number_format(0,2);?></h3>
                                            </div>
                                                <?php
                                            }  
                                            
                                            if ($wallet<0) {  
                                                ?>
                                                <div>
                                            <h6 class="fw-bold text-uppercase text-success op-8">My Balance</h6>
                                            <h3 class="fw-bold"><?php echo number_format(0,2);?></h3>
                                            </div>
                                            
                                                <div>
                                            <h6 class="fw-bold text-uppercase text-danger op-8">Pay To Admin</h6>
                                            <h3 class="fw-bold"><?php echo number_format($wallet*-1,2);?></h3>
                                            </div>
                                                <?php
                                            }   
                                              ?>
                                         
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
                 
             <div class="card-body">
                                    <div class="chart-container" style="min-height: 375px">
                                        <!-- <p align="center">No records found</p>-->
                                        <?php
                                             $cusinvoice =  $mysql->select("select  sum(InvoiceValue) as InvoiceAmt,  sum(PaidAmount) as PAmount, (sum(InvoiceValue)-sum(PaidAmount)) as BalanceAmt from _tbl_invoices where CreatedBy ='".$_SESSION['User']['BranchID']."' ");
                                             
                                        ?>
                                         <?php $BrancheOutstanding = $mysql->select("SELECT  SUM(PaidToAdmin) AS pamt, SUM(ReceviedAmount)as ramt, (SUM(PaidToAdmin)-SUM(ReceviedAmount)) AS amt FROM _tbl_branches_accounts where BranchID ='".$_SESSION['User']['BranchID']."' "); ?>
                       
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
                <div class="row">
                    <?php include_once("footer.php");?>