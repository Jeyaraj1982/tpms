<?php include_once("header.php");?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Manage Product</h4>
                    <a href="AddProduct.php" class="btn btn-primary btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Add Product
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Create On</th>
                                <th>Create By</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $Products = $mysql->select("select * from _tbl_products"); ?>
                        <?php foreach($Products as $Product) { ?>
                            <tr>
                                <td><span class="<?php echo ($Product['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $Product['ProductCode'];?></td>
                                <td><?php echo $Product['ProductName'];?></td>
                                <td><?php echo putDateTime($Product['CreatedOn']);?></td>    
                                <td><?php echo $Product['CreatedBy'];?></td>
                                <td><div class="form-button-action">
                                    <a href="EditProduct.php?ProductCode=<?php echo $Product["ProductCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 0px;">
                                        <i class="fa fa-edit"></i>
                                    </a> &nbsp;&nbsp;
                                    <a href="ViewProductDetails.php?ProductCode=<?php echo $Product["ProductCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 0px;" >
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