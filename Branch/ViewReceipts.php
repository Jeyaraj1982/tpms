<?php include_once("header.php");?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Receipts</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Receipt No</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Invoice Number</th>
                                <th>Amount</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $Receipts = $mysql->select("select * from _tbl_receipts where  CreatedBy='".$_SESSION['User']['BranchID']."'  order by  ReceiptID desc"); ?>
                        <?php foreach($Receipts as $Receipt) { ?>
                            <tr>
                                <td><?php echo $Receipt['ReceiptNumber'];?></td>
                                <td><?php echo putDateTime($Receipt['ReceiptDate']);?></td>    
                                <td><?php echo $Receipt['CustomerName'];?></td>
                                <td><?php echo $Receipt['InvoiceNumber'];?></td>
                                <td style="text-align:right"><?php echo number_format($Receipt['ReceiptAmount'],2);?></td>
                                <td style="text-align:right"><div class="form-button-action">
                                    <a href="ViewReceiptInfo.php?Receipt=<?php echo $Receipt["ReceiptNumber"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 2px 10px" >
                                        <i class="fa fa-list-alt"></i>
                                    </a>
                                    </div></td>
                                    </tr>
                                <?php }?>
                                <?php if (sizeof($Receipts)==0) {?>
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
 
            
<?php  include_once("footer.php");?>