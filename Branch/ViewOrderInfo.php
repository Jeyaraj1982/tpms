<?php include_once("header.php");?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Orders Information</h4>
                            <a href="NewBookingForm.php" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i>&nbsp;New Order
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                                $OrderInfo = $mysql->select("select * from `_tbl_orders` where `CreatedBy`='".$_SESSION['User']['BranchID']."' and `OrderNumber`='".$_GET['Order']."'") ;
                                if (sizeof($OrderInfo)>0) {
                                    $OrderItems = $mysql->select("select * from _tbl_orders_items where OrderID='".$OrderInfo[0]['OrderID']."'");
                                    $i=1;
                            ?>
                            <div style=";margin:10px;padding:20px;padding-top:0px;padding-right:0px;padding-bottom:10px;text-align:right">
                                <?php
                                    if ($OrderInfo[0]['InvoiceID']>0) {
                                        echo "<a href='ViewInvoiceInfo.php?Invoice=".$OrderInfo[0]['InvoiceNumber']."'  style='cursor:pointer;color:blue'>View Invoice</a>";
                                    } else {   
                                        echo '<a data-toggle="modal" data-target="#ConfirmGenerate" style="cursor:pointer;color:blue">Generate Invoice</a>';
                                    }
                                ?>
                                &nbsp;<a target="_blank" href="download.php?Order=<?php echo $OrderInfo[0]["OrderNumber"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 2px 10px" >
                                        <i class="fas fa-download"></i>
                                        </a>
                            </div>
                                <div style="border:1px solid #e5e5e5;margin:10px;padding:20px;">
                                <table style="width:100%;">
                                <tr>
                                    <td style="width:50%;vertical-align:top">
                                        <div>
                                            <b>Order From</b><Br><br>
                                            <?php echo $OrderInfo[0]['CustomerName'];?>,<br>
                                            <?php
                                                echo strlen(trim($OrderInfo[0]['AddressLine1']))>0 ?  $OrderInfo[0]['AddressLine1'].",<br>" : ""; 
                                                echo strlen(trim($OrderInfo[0]['AddressLine2']))>0 ?  $OrderInfo[0]['AddressLine2'].",<br>" : ""; 
                                                echo strlen(trim($OrderInfo[0]['AddressLine3']))>0 ?  $OrderInfo[0]['AddressLine3'].",<br>" : ""; 
                                                echo strlen(trim($OrderInfo[0]['PinCode']))>0 ?  $OrderInfo[0]['PinCode'].",<br>" : ""; 
                                            ?>
                                            Mobile: <?php echo $OrderInfo[0]['MobileNumber'];?>,<br>
                                            Email: <?php echo $OrderInfo[0]['EmailID'];?>,<br>
                                        </div>
                                    </td>
                                    <td style="text-align:right;width:50%;vertical-align:top">
                                        <b>Order Information</b><br><br>
                                        <b>Order #</b>&nbsp;:&nbsp;<?php echo $OrderInfo[0]['OrderNumber'];?><br>
                                        <b>Ordered</b>&nbsp;:&nbsp;<?php echo putDateTime($OrderInfo[0]['OrderDate']);?><br><br>
                                        <b>Branch</b>&nbsp;:&nbsp;<?php echo $OrderInfo[0]['BranchName'];?><br><br>
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
                                    <?php foreach($OrderItems as $items) {?>
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
                                        <input type="text" disabled="disabled" class="form-control"   value="<?php echo number_format($OrderInfo[0]['OrderValue'],2);?>" style="width:100%;text-align:right">
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

<div class="modal fade" id="ConfirmGenerate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">Confirmation of Generate Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 style="text-align:center">Are you want to Generate?</h5>
            </div>
            <div class="modal-footer no-bd" style="display: auto;">
                <form action="GenerateInvoice.php" method="post">
                    <input type="hidden" name="OrderNumber" value="<?php echo $OrderInfo[0]['OrderNumber'];?>">
                    <button type="submit" id="Yes" name="GenerateInvoiceBtn" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>      
<?php  include_once("footer.php");?>