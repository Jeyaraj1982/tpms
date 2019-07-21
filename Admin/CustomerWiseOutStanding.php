<?php include_once("header.php");?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Branch Wise Outstanding</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Customer Code</th>
                                <th>Customer Name</th>
                                <th style="text-align:right">Invoice Amount</th>
                                <th style="text-align:right">Paid Amount</th>
                                <th style="text-align:right">Balance Amount</th>
                                <th style="width: 10%;text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $Customers = $mysql->select("SELECT *   FROM _tbl_customers Order BY CustomerID "); ?>
                        <?php foreach($Customers as $Customer) { 
                            $invoice =  $mysql->select("select  sum(InvoiceValue) as InvoiceAmt,  sum(PaidAmount) as PAmount, (sum(InvoiceValue)-sum(PaidAmount)) as BalanceAmt from _tbl_invoices where  CustomerID='".$Customer['CustomerID']."' "); 
                            
                            ?>
                            <tr>
                                <td><?php echo $Customer['CustomerCode'];?></td>
                                <td><?php echo $Customer['CustomerName'];?></td>
                                <td style="text-align:right"><?php echo number_format($invoice[0]['InvoiceAmt'],2);?></td>
                                <td style="text-align:right"><?php echo number_format($invoice[0]['PAmount'],2);?></td>
                                <td style="text-align:right"><?php echo number_format($invoice[0]['BalanceAmt'],2);?></td>
                                <td style="text-align:right">
                                    <div class="form-button-action">
                                        <a href="ViewCustomerTransactions.php?Customer=<?php echo $Customer["CustomerCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 2px 10px" >
                                        <i class="fa fa-list-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php }?>
                            <?php if (sizeof($Customers)==0) {?>
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