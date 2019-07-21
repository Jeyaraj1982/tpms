<?php include_once("header.php");?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">My Transactions</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Branch Name </th>
                                <th>Invoice Number</th>
                                <th>Particulars</th>
                                <th>Cash In</th>
                                <th>Paid To Admin</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $Receipts = $mysql->select("select * from _tbl_branches_accounts where  BranchID='".$_SESSION['User']['BranchID']."'  order by  BranchTxnID desc"); ?>
                        <?php foreach($Receipts as $Receipt) { ?>
                            <tr>
                                <td><?php echo putDateTime($Receipt['TxnDate']);?></td>    
                                <td><?php echo $Receipt['BranchName'];?></td>                                                                      
                                <td><?php echo $Receipt['InvoiceNumber'];?></td>                                                                      
                                <td><?php echo $Receipt['Particulars'];?></td>                                                                      
                                <td style="text-align:right"><?php echo number_format($Receipt['ReceviedAmount'],2);?></td>
                                <td style="text-align:right"><?php echo number_format($Receipt['PaidToAdmin'],2);?></td>
                                <td style="text-align:right"><?php echo number_format($Receipt['BalanceAmount'],2);?></td>
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