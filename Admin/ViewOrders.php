<?php include_once("header.php");?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Orders</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Date</th>
                                <th>Ordered </th>
                                <th>Customer Name</th>
                                <th>Order Value</th>
                                
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          if (isset($_GET['filter']) && $_GET['filter']=="Invoiced")  {
                               $Orders = $mysql->select("select * from _tbl_orders where InvoiceID>0 order by  OrderID desc"); 
                          } else if (isset($_GET['filter']) && $_GET['filter']=="nonInvoiced")  {
                              $Orders = $mysql->select("select * from _tbl_orders where InvoiceID=0 order by  OrderID desc"); 
                          } else {
                               $Orders = $mysql->select("select * from _tbl_orders order by  OrderID desc"); 
                          }
                         
                         
                         ?>
                        <?php foreach($Orders as $Order) { ?>
                            <tr>
                                <td><?php echo $Order['OrderNumber'];?></td>
                                <td><?php echo putDateTime($Order['OrderDate']);?></td>    
                                <td><?php echo $Order['BranchName'];?></td>
                                <td><?php echo $Order['CustomerName'];?></td>
                                <td style="text-align:right"><?php echo number_format($Order['OrderValue'],2);?></td>
                                <td style="Text-align:center;"><?php echo ($Order['InvoiceID']== 0)? "Not Invoiced" :  "<a href='ViewInvoiceInfo.php?Invoice=".$Order['InvoiceNumber']."'  style='cursor:pointer;color:blue'> Invoiced </a>";?></td>
                                <td><div class="form-button-action">
                                    <a href="ViewOrderInfo.php?Order=<?php echo $Order["OrderNumber"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 0px;" >
                                        <i class="fa fa-list-alt"></i>
                                    </a>
                                    </div></td>
                                    </tr>
                                <?php }?>
                                <?php if (sizeof($Orders)==0) {?>
                                    <tr>
                                        <td colspan="7" style="text-align:center">No records found</td>
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