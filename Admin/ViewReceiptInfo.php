<?php include_once("header.php");?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Receipt Information</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                                $ReceiptInfo = $mysql->select("select * from `_tbl_receipts` where   `ReceiptNumber`='".$_GET['Receipt']."'") ;
                                if (sizeof($ReceiptInfo)>0) {
                                    
                            ?>
                            <div style=";margin:10px;padding:20px;padding-top:0px;padding-right:0px;padding-bottom:10px;text-align:right">
                               <a target="_blank" href="download.php?Receipt=<?php echo $ReceiptInfo[0]["ReceiptNumber"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 2px 10px" >
                                        <i class="fas fa-download"></i>
                                        </a>
                            </div>
                                <div style="border:1px solid #e5e5e5;margin:10px;padding:20px;">
                                <table style="width:100%;">
                                <tr>
                                    <td style="width:50%;vertical-align:top">
                                        <div>
                                            <b>Customer Information</b><Br><br>
                                            <?php echo $ReceiptInfo[0]['CustomerName'];?>,<br>
                                            <?php
                                                echo strlen(trim($ReceiptInfo[0]['AddressLine1']))>0 ?  $ReceiptInfo[0]['AddressLine1'].",<br>" : ""; 
                                                echo strlen(trim($ReceiptInfo[0]['AddressLine2']))>0 ?  $ReceiptInfo[0]['AddressLine2'].",<br>" : ""; 
                                                echo strlen(trim($ReceiptInfo[0]['AddressLine3']))>0 ?  $ReceiptInfo[0]['AddressLine3'].",<br>" : ""; 
                                                echo strlen(trim($ReceiptInfo[0]['Pincode']))>0 ?  $ReceiptInfo[0]['Pincode'].",<br>" : ""; 
                                            ?>
                                            Mobile: <?php echo $ReceiptInfo[0]['MobileNumber'];?>,<br>
                                            Email: <?php echo $ReceiptInfo[0]['EmailID'];?>,<br>
                                        </div>
                                    </td>
                                    <td style="text-align:right;width:50%;vertical-align:top">
                                        <b>Receipt Information</b><br><br>
                                        <b>Receipt #</b>&nbsp;:&nbsp;<?php echo $ReceiptInfo[0]['ReceiptNumber'];?><br>
                                        <b>Date</b>&nbsp;:&nbsp;<?php echo putDateTime($ReceiptInfo[0]['ReceiptDate']);?><br><br>
                                        
                                        <b>Invoice Information</b><br> 
                                        <b>Invoice #</b>&nbsp;:&nbsp;<?php echo $ReceiptInfo[0]['InvoiceNumber'];?><br><Br>
                                       
                                        <b>Branch</b>&nbsp;:&nbsp;<?php echo $ReceiptInfo[0]['BranchName'];?><br><br>
                                    </td>
                                </tr>
                               </table>
                               <hr> 
                               <table id="add-row" class="display table table-striped table-hover">
                                   <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Particulars</th>
                                        <th style="text-align:center">Amount</th>
                                    </tr>
                                   </thead>
                                   <tbody>
                                   <tr>
                                    <td>1.</td>
                                        <td>Part payment Recevied against Invoice Number <?php echo $ReceiptInfo[0]['InvoiceNumber'];?></td>
                                        <td style="text-align:right"><?php echo number_format($ReceiptInfo[0]['ReceiptAmount'],2);?></td>
                                   </tr>
                                   </tbody> 
                               </table>
                               <hr>
                               <div class="form-group form-inline">
                                    <div class="col-sm-8"></div> 
                                    <div class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Paid Amount</div>
                                    <div class="col-sm-2">
                                        <input type="text" disabled="disabled" class="form-control"   value="<?php echo number_format($ReceiptInfo[0]['ReceiptAmount'],2);?>" style="width:100%;text-align:right">
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