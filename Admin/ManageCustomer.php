    <?php include_once("header.php");?>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Manage Customers</h4>
                                <a href="AddCustomer.php" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i>
                                Add Customer
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Customer Code</th>
                                            <th>Customer Name</th>
                                            <th>Mobile Number</th>
                                            <th>Created On</th>
                                            <th>Created By</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $Customers = $mysql->select("select * from _tbl_customers"); ?>
                                    <?php foreach($Customers as $Customer) { ?>
                                        <tr>
                                            <td><?php echo $Customer['CustomerCode'];?></td>
                                            <td><?php echo $Customer['CustomerName'];?></td>
                                            <td><?php echo $Customer['MobileNumber'];?></td>
                                            <td><?php echo putDateTime($Customer['CreatedOn']);?></td>    
                                            <td><?php echo $Customer['CreatedBy'];?></td>
                                            <td><div class="form-button-action">
                                                <a href="EditCustomer.php?CusCode=<?php echo $Customer["CustomerCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 0px;">
                                                    <i class="fa fa-edit"></i>
                                                </a> &nbsp;&nbsp;
                                                <a href="ViewCustomerDetails.php?CusCode=<?php echo $Customer["CustomerCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 0px;" >
                                                    <i class="fa fa-list-alt"></i>
                                                </a>
                                                &nbsp;&nbsp;
                                                <a data-toggle="modal" data-target="#Delete" class="btn btn-link btn-primary btn-lg" style="padding: 0px;" >
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                </div></td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header no-bd">
                            <h5 class="modal-title">Delete Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="" id="" name="">
                                <div class="form-group">
                                    <div class="col-sm-6" style="text-align:center">Do you want delete?</div>
                                </div>
                                <div class="card-action">
                                    <a class="btn btn-success" name="yes" style="color: white;">Yes</a>
                                   <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php  include_once("footer.php");?>