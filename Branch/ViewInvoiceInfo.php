<?php include_once("header.php");?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Invoice Information</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                                $InvoiceInfo = $mysql->select("select * from `_tbl_invoices` where `CreatedBy`='".$_SESSION['User']['BranchID']."' and `InvoiceNumber`='".$_GET['Invoice']."'") ;
                                if (sizeof($InvoiceInfo)>0) {
                                    $InvoiceItems = $mysql->select("select * from _tbl_invoices_items where InvoiceID='".$InvoiceInfo[0]['InvoiceID']."'");
                                    $i=1;
                            ?>
                            <div style=";margin:10px;padding:20px;padding-top:0px;padding-right:0px;padding-bottom:10px;text-align:right">
                            <?php
                                if ($InvoiceInfo[0]['BalanceAmount']==0) {
                                    echo "Paid";
                                } else {
                                    echo "Unpaid Amount : Rs. ".number_format($InvoiceInfo[0]['BalanceAmount'],2);
                                }
                            ?>
                            </div>
                                <div style="border:1px solid #e5e5e5;margin:10px;padding:20px;">
                                <table style="width:100%;">
                                <tr>
                                    <td style="width:50%;vertical-align:top">
                                        <div>
                                            <b>Customer Information</b><Br><br>
                                            <?php echo $InvoiceInfo[0]['CustomerName'];?>,<br>
                                            <?php
                                                echo strlen(trim($InvoiceInfo[0]['AddressLine1']))>0 ?  $InvoiceInfo[0]['AddressLine1'].",<br>" : ""; 
                                                echo strlen(trim($InvoiceInfo[0]['AddressLine2']))>0 ?  $InvoiceInfo[0]['AddressLine2'].",<br>" : ""; 
                                                echo strlen(trim($InvoiceInfo[0]['AddressLine3']))>0 ?  $InvoiceInfo[0]['AddressLine3'].",<br>" : ""; 
                                                echo strlen(trim($InvoiceInfo[0]['PinCode']))>0 ?  $InvoiceInfo[0]['PinCode'].",<br>" : ""; 
                                            ?>
                                            Mobile: <?php echo $InvoiceInfo[0]['MobileNumber'];?>,<br>
                                            Email: <?php echo $InvoiceInfo[0]['EmailID'];?>,<br>
                                        </div>
                                    </td>
                                    <td style="text-align:right;width:50%;vertical-align:top">
                                        <b>Invoice Information</b><br><br>
                                        <b>Invoice #</b>&nbsp;:&nbsp;<?php echo $InvoiceInfo[0]['InvoiceNumber'];?><br>
                                        <b>Invoiced</b>&nbsp;:&nbsp;<?php echo putDateTime($InvoiceInfo[0]['InvoiceDate']);?><br><br>
                                       
                                        <b>Order #</b>&nbsp;:&nbsp;<?php echo $InvoiceInfo[0]['OrderNumber'];?><br>
                                        <b>Ordered</b>&nbsp;:&nbsp;<?php echo putDateTime($InvoiceInfo[0]['OrderDate']);?><br><br>
                                        <b>Branch</b>&nbsp;:&nbsp;<?php echo $InvoiceInfo[0]['BranchName'];?><br><br>
                                    </td>
                                </tr>
                               </table>
                               <hr> 
                               <table id="add-row" class="display table table-striped table-hover">
                                   <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Particulars</th>
                                        <th style="text-align:center">Qty</th>
                                        <th style="text-align:center">Price</th>
                                        <th style="text-align:center">Amount</th>
                                        <th style="text-align:center">Service Chrg</th>
                                        <th style="text-align:center">Total</th>
                                    </tr>
                                   </thead>
                                   <tbody>
                                    <?php foreach($InvoiceItems as $items) {?>
                                        <tr>
                                            <td style="text-align:right"><?php echo $i;?>.&nbsp;</td>
                                            <td>
                                                <?php echo $items['ProductName'];?><Br>
                                                <span style="color:#555"><?php echo $items['Remarks'];?></span>
                                            </td>
                                            <td style="text-align:right"><?php echo $items['Qty'];?></td>
                                            <td style="text-align:right"><?php echo number_format($items['Amount'],2);?></td>
                                            <td style="text-align:right"><?php echo number_format($items['TAmount'],2);?></td>
                                            <td style="text-align:right"><?php echo number_format($items['ServiceCharge'],2);?></td>
                                            <td style="text-align:right"><?php echo number_format($items['TsAmount'],2);?></td>
                                        </tr>
                                    <?php 
                                        $i++; 
                                        $totalAmt+=$items['TsAmount'];
                                        } 
                                    ?>
                                   </tbody> 
                               </table>
                               <hr>
                               <div class="form-group form-inline">
                                    <div class="col-sm-8"></div> 
                                    <div class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Payable Amount</div>
                                    <div class="col-sm-2">
                                        <input type="text" disabled="disabled" class="form-control"   value="<?php echo number_format($InvoiceInfo[0]['InvoiceValue'],2);?>" style="width:100%;text-align:right">
                                    </div>
                                </div>
                               </div>
                               <?php 
                            } else {
                                echo "Access denied. Please contact administrator";
                            }
                            
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<?php  include_once("footer.php");?>