    <?php include_once("header.php");?>
    
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Pay Invoice</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <?php
                                            if (isset($_POST['PaynowBtn'])) {
                                                
                                                $InvoiceInfo = $mysql->select("select * from `_tbl_invoices` where `CreatedBy`='".$_SESSION['User']['BranchID']."' and `InvoiceNumber`='".$_GET['Invoice']."'") ;
                                                $err==0;
                                                
                                                if ($InvoiceInfo[0]['BalanceAmount']==0) {
                                                     $errorMessage = "Invoice already Paid";
                                                     $err++;
                                                }
                                                    
                                                if ($_POST['Amount']==0 || $_POST['Amount']<0) {
                                                    $errorMessage = "Invalid Amount";  
                                                    $err++;
                                                } 
                                                
                                                if ($_POST['Amount']>$InvoiceInfo[0]['BalanceAmount'])  {
                                                    $errorMessage = "Your maximum amount must have Rs. ".number_format($InvoiceInfo[0]['BalanceAmount'],2);
                                                    $err++;
                                                }

                                                if ($err==0) {
                                                    $receiptNumber =SeqMaster::GetNextReceiptNumber();                          
                                                    $receiptID  = $mysql->insert("_tbl_receipts",array("InvoiceID"     => $InvoiceInfo[0]['InvoiceID'],
                                                                                                       "InvoiceNumber" => $InvoiceInfo[0]['InvoiceNumber'],
                                                                                                       "ReceiptDate"   => date("Y-m-d H:i:s"),
                                                                                                       "ReceiptNumber" => $receiptNumber,
                                                                                                       "CustomerID"    => $InvoiceInfo[0]['CustomerID'],
                                                                                                       "CustomerName"  => $InvoiceInfo[0]['CustomerName'],
                                                                                                       "EmailID"       => $InvoiceInfo[0]['EmailID'],
                                                                                                       "MobileNumber"  => $InvoiceInfo[0]['MobileNumber'],
                                                                                                       "AddressLine1"  => $InvoiceInfo[0]['AddressLine1'],
                                                                                                       "AddressLine2"  => $InvoiceInfo[0]['AddressLine2'],
                                                                                                       "AddressLine3"  => $InvoiceInfo[0]['AddressLine3'],
                                                                                                       "Pincode"       => $InvoiceInfo[0]['Pincode'],
                                                                                                       "ReceiptAmount" => $_POST['Amount'],
                                                                                                       "Createdon"     => date("Y-m-d H:i:s"),
                                                                                                       "CreatedBy"     => $_SESSION['User']['BranchID'],
                                                                                                       "BranchName"    => $_SESSION['User']['BranchName'],
                                                                                                       "Remarks"       => $_POST['Remarks'])); 
                                                    $paidAmount = $InvoiceInfo[0]['PaidAmount'] + $_POST['Amount'];
                                                    $balanceAmount = $InvoiceInfo[0]['InvoiceValue'] - $paidAmount;
                                                
                                                    $mysql->execute("update _tbl_invoices set PaidAmount='".$paidAmount."', BalanceAmount='".$balanceAmount."' where InvoiceID='".$InvoiceInfo[0]['InvoiceID']."'");
                                                
                                                    $mysql->insert("_tbl_branches_accounts",array("BranchID"        => $InvoiceInfo[0]['CreatedBy'], 
                                                                                                  "BranchName"      => $_SESSION['User']['BranchName'],
                                                                                                  "BranchCode"      => $_SESSION['User']['BranchCode'],
                                                                                                  "InvoiceID"       => $InvoiceInfo[0]['InvoiceID'],
                                                                                                  "InvoiceNumber"   => $InvoiceInfo[0]['InvoiceNumber'],                              
                                                                                                  "CustomerID"      => $InvoiceInfo[0]['CustomerID'],
                                                                                                  "CustomerCode"    => $InvoiceInfo[0]['CustomerCode'], 
                                                                                                  "ReceiptID"       => $receiptID,
                                                                                                  "RecepitNumber"   => $receiptNumber,
                                                                                                  "ReceviedAmount"  => $_POST['Amount'],
                                                                                                  "TxnDate"         => date("Y-m-d H:i:s"),
                                                                                                  "PaidToAdmin"     => "0",
                                                                                                  "Particulars"     => "Amount Recevied from Customer ",
                                                                                                  "BalanceAmount"   => $applicaiton->GetBranchBalance($_SESSION['User']['BranchID'])-$_POST['Amount'],
                                                                                                  "ModeOfTxn"       => ""));
                                                    ?>
                                                   <style>#paymentdiv {display:none}</style>
                                                   <div class="form-group form-inline">
                                                    <div class="col-md-12"  style="text-align:left">
                                                        <span class="successmessage">Payment Process completed.</span><br>
                                                        Receipt Number: <?php echo $receiptNumber;?>
                                                    </div>
                                                   </div>
                                                <?php
                                                }  
                                            }  
                                        ?>
                                            <div class="form-group form-inline">
                                                 <div class="col-md-12"  style="text-align:left">
                                                    <span class="errormessage"><?php echo $errorMessage; ?></span>
                                                 </div>
                                            </div>
                                            <div id="paymentdiv">
                                            <?php
                                            $InvoiceInfo = $mysql->select("select * from `_tbl_invoices` where `CreatedBy`='".$_SESSION['User']['BranchID']."' and `InvoiceNumber`='".$_GET['Invoice']."'") ;
                                if (sizeof($InvoiceInfo)>0) {
                                    if ($InvoiceInfo[0]['BalanceAmount']>0) {
                                    ?>
                                        <form method="post" action="" id="PaymentForm" name="PaymentForm">
                                            <input type="hidden" value="<?php echo $_GET['Invoice'];?>"  name="Invoice">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Invoice Amount </div>
                                                <div class="col-sm-4">                                                                                                              
                                                    <input type="text" disabled="disabled" class="form-control"  style="width:100%;background:#f1f1f1 !important;text-align:right" value="<?php echo  number_format($InvoiceInfo[0]['InvoiceValue'],2);?>">
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Paid Amount</div>
                                                <div class="col-sm-4">                                                                                                              
                                                    <input type="text" disabled="disabled"  class="form-control" style="width:100%;background:#f1f1f1 !important;text-align:right" value="<?php echo  number_format($InvoiceInfo[0]['PaidAmount'],2);?>">
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Payable Amount</div>
                                                <div class="col-sm-4">                                                                                                              
                                                    <input type="text" disabled="disabled" class="form-control"  style="width:100%;background:#f1f1f1 !important;text-align:right" value="<?php echo  number_format($InvoiceInfo[0]['BalanceAmount'],2);?>">
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
                                    <a href="ViewInvoiceInfo.php?Invoice=<?php echo $_GET['Invoice'];?>" class="btn btn-danger">Cancel</a>
                                </div>
                                            </form>
                                <?php } else { 
                                
                                    echo "Couldn't process pay now. This invoice already paid full amount.";
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