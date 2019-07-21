     <?php include_once("header.php");?>
    
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Pay Amount</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <?php
                                            if (isset($_POST['PaynowBtn'])) {
                                               $BranchInfo = $mysql->select("select * from _tbl_branches where BranchCode='".$_GET['Branch']."'");
                      
                                                    $mysql->insert("_tbl_branches_accounts",array("BranchID"        => $BranchInfo[0]['BranchID'], 
                                                                                                  "BranchName"      => $BranchInfo[0]['BranchName'],
                                                                                                  "BranchCode"      => $BranchInfo[0]['BranchCode'],
                                                                                                  "InvoiceID"       => "0",
                                                                                                  "InvoiceNumber"   => "0",                              
                                                                                                  "CustomerID"      => "0",
                                                                                                  "CustomerCode"    => "0", 
                                                                                                  "ReceiptID"       => "0",
                                                                                                  "RecepitNumber"   => "0",
                                                                                                  "ReceviedAmount"  => "0",
                                                                                                  "TxnDate"         => date("Y-m-d H:i:s"),
                                                                                                  "PaidToAdmin"     => $_POST['Amount'],
                                                                                                  "Particulars"     => "Amount Recevied from Branch ",
                                                                                                  "BalanceAmount"   => $applicaiton->GetBranchBalance($BranchInfo[0]['BranchID'])+$_POST['Amount'],
                                                                                                  "ModeOfTxn"       => ""));
                                                    ?>
                                                       <style>
                                                       #paymentdiv {display:none}
                                                       </style>
                                                       <div class="form-group form-inline">
                                                 <div class="col-md-12"  style="text-align:left">
                                                    <span class="successmessage">Payment Process completed.</span><br>
                                                    
                                                    
                                                 </div>
                                            </div>
                                                    <?php
                                                
                                            }  
                                        ?>
                                            <div class="form-group form-inline">
                                                 <div class="col-md-12"  style="text-align:left">
                                                    <span class="errormessage"><?php echo $errorMessage; ?></span>
                                                 </div>
                                            </div>
                                            <div id="paymentdiv">
                                             <div class="form-group form-inline">
                                              <div class="col-sm-4">
                                            <?php
                     $BranchInfo = $mysql->select("select * from _tbl_branches where BranchCode='".$_GET['Branch']."'");
                     echo  "<b>".$BranchInfo[0]['BranchName']. "</b> (".$BranchInfo[0]['BranchCode'].")"."<br>";
                     echo  "Email : ".$BranchInfo[0]['EmailID']."<br>";
                     echo  "Mobile : ".$BranchInfo[0]['MobileNumber']."<br><Br>";
                ?>
                          </div>    </div>
                                            <?php
                                            $OutStanding = $mysql->select("SELECT BranchCode,BranchName, (SUM(PaidToAdmin)-SUM(ReceviedAmount)) AS amt FROM _tbl_branches_accounts where BranchCode='".$_GET['Branch']."'") ;
                                if (sizeof($OutStanding)>0) {
                                    //if ($OutStanding[0]['amt']<0) {
                                    if (true) {
                                    ?>
                                        <form method="post" action="" id="PaymentForm" name="PaymentForm">
                                            <input type="hidden" value="<?php echo $_GET['Invoice'];?>"  name="Invoice">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Outstanding Amount </div>
                                                <div class="col-sm-4">
                                                    <?php if ($OutStanding[0]['amt']<0) {?>                                                                                                               
                                                    <input type="text" disabled="disabled" class="form-control"  style="width:100%;background:#f1f1f1 !important;text-align:right" value="<?php echo  number_format($OutStanding[0]['amt']*-1,2);?>">
                                                    <?php } else { ?> 
                                                    <input type="text" disabled="disabled" class="form-control"  style="width:100%;background:#f1f1f1 !important;text-align:right" value="<?php echo  number_format(0,2);?>">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Amount<span id="star">*</span></div>
                                                <div class="col-sm-4">                                                                                                              
                                                    <input type="text" name="Amount" id="Amount" class="form-control" Placeholder="Enter Amount" style="width:100%;text-align:right" value="<?php echo (isset($_POST['Amount']) ? $_POST['Amount'] : "");?>">
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Remarks</div>
                                                <div class="col-sm-4">                                                                                                              
                                                    <input type="text" name="Remarks" id="Remarks" placeholder="Enter Remarks" class="form-control" style="width:100%;" value="<?php echo (isset($_POST['CurrentPassword']) ? $_POST['CurrentPassword'] : "");?>">
                                                </div>
                                            </div>
                                            <div class="card-action" style="text-align:right">
                                    <button class="btn btn-success" name="PaynowBtn" onclick="Paynow()">Pay Now</button>
                                    <a href="BranchWiseOutStanding.php?Branch=<?php echo $_GET['Branch'];?>" class="btn btn-danger">Cancel</a>
                                </div>
                                            </form>
                                <?php } else { 
                                
                                    echo "Couldn't process pay now. no outstanding.";
                                }
                                
                                } else { 
                                       echo "Access denied. Please contact administrator";
                                 } ?>
                                 </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
            function Paynow() {
                $('#PaymentForm').submit();
            }
            </script>
<?php include_once("footer.php");?>