<?php include_once("header.php");?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Branch Transactions</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <?php
                     $BranchInfo = $mysql->select("select * from _tbl_branches where BranchCode='".$_GET['Branch']."'");
                     echo  "<b>".$BranchInfo[0]['BranchName']. "</b> (".$BranchInfo[0]['BranchCode'].")"."<br>";
                     echo  "Email : ".$BranchInfo[0]['EmailID']."<br>";
                     echo  "Mobile : ".$BranchInfo[0]['MobileNumber']."<br>";
                ?>
                <a href="ViewBranchDetails.php?BranchCode=<?php echo $BranchInfo[0]['BranchCode'];?>">View branch information</a>
                <br>
                <div style="text-align:right;padding-bottom:10px;">
                      <?php
                       $a=$applicaiton->GetBranchBalance($BranchInfo[0]['BranchID']);
                       if ($a<0) {
                          
                           ?>
                            <a href="Payment.php?Branch=<?php echo $BranchInfo[0]['BranchCode'];?>" class="btn btn-primary btn-round ml-auto" >
                                Pay Amount
                            </a> <Br>
                           <?php
                            echo "Outstanding Amount : Rs. ".number_format($a,2);
                       }
                      ?>
                </div>
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Invoice Number</th>
                                <th>Particulars</th>
                                <th>Cash In</th>
                                <th>Paid To Admin</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $Receipts = $mysql->select("select * from _tbl_branches_accounts where  BranchCode='".$_GET['Branch']."'  order by  BranchTxnID desc"); ?>
                        <?php foreach($Receipts as $Receipt) { ?>
                            <tr>
                                <td><?php echo putDateTime($Receipt['TxnDate']);?></td>    
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