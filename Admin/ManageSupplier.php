    <?php include_once("header.php");?>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Manage Suppliers</h4>
                                <a href="AddSupplier.php" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i>
                                Add Supplier
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Supplier Code</th>
                                            <th>Supplier Name</th>
                                            <th>Supplier Description</th>
                                            <th>Create On</th>
                                            <th>Create By</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $Suppliers = $mysql->select("select * from _tbl_suppliers"); ?>
                                    <?php foreach($Suppliers as $Supplier) { ?>
                                        <tr>
                                            <td><span class="<?php echo ($Supplier['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $Supplier['SupplierCode'];?></td>
                                            <td><?php echo $Supplier['SupplierName'];?></td>
                                            <td><?php echo $Supplier['SupplierDescription'];?></td>
                                            <td><?php echo putDateTime($Supplier['CreatedOn']);?></td>    
                                            <td><?php echo $Supplier['CreatedBy'];?></td>
                                            <td><div class="form-button-action">
                                                <a href="EditSupplier.php?SuplierCode=<?php echo $Supplier["SupplierCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 0px;">
                                                    <i class="fa fa-edit"></i>
                                                </a> &nbsp;&nbsp;
                                                <a href="ViewSupplierDetails.php?SuplierCode=<?php echo $Supplier["SupplierCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 0px;" >
                                                    <i class="fa fa-list-alt"></i>
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
            
<?php  include_once("footer.php");?>