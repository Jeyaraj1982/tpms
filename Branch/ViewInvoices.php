<?php include_once("header.php");?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Invoices</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th style="text-align:center">Invoice Value</th>
                                <th style="text-align:center">Paid</th>
                                <th style="text-align:center">Balance</th>
                                <th style="width: 10%;text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                             if (isset($_GET['filter']) && $_GET['filter']=="Paid")  {
                               $Invoices = $mysql->select("select * from _tbl_invoices where  CreatedBy='".$_SESSION['User']['BranchID']."' and BalanceAmount='0'  order by  OrderID desc"); 
                                } else if (isset($_GET['filter']) && $_GET['filter']=="Unpaid")  {
                               $Invoices = $mysql->select("select * from _tbl_invoices where  CreatedBy='".$_SESSION['User']['BranchID']."' and BalanceAmount>'0'  order by  OrderID desc"); 
                                } else {
                               $Invoices = $mysql->select("select * from _tbl_invoices where  CreatedBy='".$_SESSION['User']['BranchID']."'  order by  OrderID desc"); 
                                }
                          ?>
                        <?php foreach($Invoices as $invoice) { ?>
                            <tr>
                                <td><?php echo $invoice['InvoiceNumber'];?></td>
                                <td><?php echo putDateTime($invoice['InvoiceDate']);?></td>    
                                <td><?php echo $invoice['CustomerName'];?></td>
                                <td style="text-align:right"><?php echo number_format($invoice['InvoiceValue'],2);?></td>
                                <td style="Text-align:right;"><?php echo number_format($invoice['PaidAmount'],2);?></td>   
                                <td style="Text-align:right;"><?php echo number_format($invoice['BalanceAmount'],2);?></td>   
                                <td style="text-align:right">
                                    <div class="form-button-action">
                                        <?php if ($invoice['BalanceAmount']>0) { ?>
                                        <a href="PayInvoice.php?Invoice=<?php echo $invoice['InvoiceNumber'];?>" class="btn btn-primary btn-round ml-auto" style="padding:2px 10px">
                                        Pay Now
                                        </a>
                                        <?php } ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="ViewInvoiceInfo.php?Invoice=<?php echo $invoice["InvoiceNumber"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 2px 10px" >
                                        <i class="fa fa-list-alt"></i>
                                        </a>&nbsp;<a target="_blank" href="download.php?Invoice=<?php echo $invoice["InvoiceNumber"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 2px 10px" >
                                        <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php }?>
                            <?php if (sizeof($Invoices)==0) {?>
                            <tr>
                                <td colspan="8" style="text-align:center">No records found</td>
                            </tr>
                            <?php } ?>
                                </tbody>
                            </table>
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
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 style="text-align:center">Do you want to Generate</h5>
                                                </div>
                                                <div class="modal-footer no-bd" style="display: auto;">
                                                    <button type="button" id="Yes" class="btn btn-primary">Yes</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
<?php  include_once("footer.php");?>