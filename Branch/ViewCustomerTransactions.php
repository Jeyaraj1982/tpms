<?php include_once("header.php");?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">View Customers Transaction</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                
                <table  style="width:100%;"> 
                    <tr>
                        <td style="width:50%;text-align:left;vertical-align:top">
                           <?php
                 $Customer = $mysql->select("select * from _tbl_customers  where  CreatedByID ='".$_SESSION['User']['BranchID']."' and CustomerCode='".$_GET['Customer']."'");
                 echo  "<b>".$Customer[0]['CustomerName']. "</b> (".$Customer[0]['CustomerCode'].")"."<br>";
                     echo  "Email : ".$Customer[0]['EmailID']."<br>";
                     echo  "Mobile : ".$Customer[0]['MobileNumber']."<br><br>";
                     $cusinvoice =  $mysql->select("select  sum(InvoiceValue) as InvoiceAmt,  sum(PaidAmount) as PAmount, (sum(InvoiceValue)-sum(PaidAmount)) as BalanceAmt from _tbl_invoices where  CustomerID='".$Customer[0]['CustomerID']."' ");
                ?>
                        </td>
                        <td style="width:50%;text-align:right;vertical-align:top">
                         <?php
                         $cusinvoice =  $mysql->select("select  sum(InvoiceValue) as InvoiceAmt,  sum(PaidAmount) as PAmount, (sum(InvoiceValue)-sum(PaidAmount)) as BalanceAmt from _tbl_invoices where  CustomerID='".$Customer[0]['CustomerID']."' ");
                     echo  "Invoiced : ".number_format($cusinvoice[0]['InvoiceAmt'],2)."<br>";
                     echo  "Paid : ". number_format($cusinvoice[0]['PAmount'],2)."<br>";
                     echo  "Balance : ".number_format($cusinvoice[0]['BalanceAmt'],2)."<br><br>";
                    
                ?>
                        </td>
                    </tr>
                </table>
                <hr>
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Txn Date</th>
                                <th>Invoce Number </th>
                                <th>Invoice Amount</th>
                                <th>Recepit Number</th>
                                <th>Recepit Amount</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                       
                        
                        $Receipts = $mysql->select(
                        
                        "SELECT * FROM (
SELECT
  InvoiceDate AS transactionDate,
  InvoiceNumber AS InvoiceNumber,    
  InvoiceValue AS InvoceAmount,
  '' AS ReceiptNumber,
  '0' AS ReceiptAmount,
  BalanceAmount as BalanceAmount
FROM _tbl_invoices WHERE CustomerID='".$Customer[0]['CustomerID']."'
UNION ALL 
SELECT 
    ReceiptDate AS transactoinDate,
    InvoiceNumber AS InvoiceNumber,
    '0' AS InvoceAmount ,
    ReceiptNumber AS ReceiptNumber,
    ReceiptAmount AS ReceiptAmount ,
    '-1' as BalanceAmount
    
FROM
    _tbl_receipts  WHERE CustomerID='".$Customer[0]['CustomerID']."') AS t1  ORDER BY transactionDate Desc
                        
                        "
                        ); ?>
                        <?php foreach($Receipts as $Receipt) { ?>
                            <tr>
                                <td>
                                <?php
                                    if ($Receipt['BalanceAmount']==0) {
                                        ?>
                                        <span class="Activedot"></span>&nbsp;
                                        <?php }  else if ($Receipt['BalanceAmount']>0) { ?>
                                           <span class="Deactivedot"></span>&nbsp;
                                        <?php 
                                    }
                                ?>
                                <?php echo putDateTime($Receipt['transactionDate']);?></td>    
                                <td><?php echo $Receipt['InvoiceNumber'];?></td>                                                                      
                                 <td style="text-align:right"><?php echo number_format($Receipt['InvoceAmount'],2);?></td>
                                <td><?php echo $Receipt['ReceiptNumber'];?></td>
                                <td style="text-align:right"><?php echo number_format($Receipt['ReceiptAmount'],2);?></td>
                                <td style="text-align:right"><div class="form-button-action">
                                <?php if ($Receipt['InvoceAmount']>0) {?>
                                     <a href="ViewInvoiceInfo.php?Receipt=<?php echo $Receipt["ReceiptNumber"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 2px 10px" >
                                        <i class="fa fa-list-alt"></i>&nbsp;&nbsp;View Invoice
                                    </a>
                                <?php } ?>
                                 <?php if ($Receipt['ReceiptAmount']>0) {?>
                                     <a href="ViewReceiptInfo.php?Receipt=<?php echo $Receipt["ReceiptNumber"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 2px 10px" >
                                        <i class="fa fa-list-alt"></i>&nbsp;&nbsp;View Receipt
                                    </a>
                                <?php } ?>
                                    
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