<?php include_once("header.php");?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Manage Branches</h4>
                    <a href="CreateBranch.php" class="btn btn-primary btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Create Branch
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Branch Name</th>
                                <th>Person Name</th>
                                <th>Mobile Number</th>
                                <th>Created</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $Branches = $mysql->select("select * from _tbl_branches"); ?>
                        <?php foreach($Branches as $Branch) { ?>
                            <tr>
                                <td><span class="<?php echo ($Branch['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $Branch['BranchName'];?></td>
                                <td><?php echo $Branch['PersonName'];?></td>
                                <td><?php echo $Branch['MobileNumber'];?></td>   
                                <td><?php echo putDateTime($Branch['CreatedOn']);?></td> 
                                <td><div class="form-button-action">
                                    <a href="EditBranch.php?BranchCode=<?php echo $Branch["BranchCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 0px;">
                                        <i class="fa fa-edit"></i>
                                    </a> &nbsp;&nbsp;
                                    <a href="ViewBranchDetails.php?BranchCode=<?php echo $Branch["BranchCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 0px;" >
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