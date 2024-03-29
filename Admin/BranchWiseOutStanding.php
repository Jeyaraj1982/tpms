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
                                <th>Branch Code</th>
                                <th>Branch Name</th>
                                <th style="text-align:right">Outstanding Amount</th>
                                <th style="width: 10%;text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $Branches = $mysql->select("SELECT BranchCode,BranchName, (SUM(PaidToAdmin)-SUM(ReceviedAmount)) AS amt FROM _tbl_branches_accounts GROUP BY BranchID "); ?>
                        <?php foreach($Branches as $Branch) { ?>
                            <tr>
                                <td><?php echo $Branch['BranchCode'];?></td>
                                <td><?php echo $Branch['BranchName'];?></td>
                                <td style="text-align:right"><?php echo number_format($Branch['amt'],2);?></td>
                                <td style="text-align:right">
                                    <div class="form-button-action">
                                        <?php if ($Branch['amt']<0) { ?>
                                        <a href="Payment.php?Branch=<?php echo $Branch['BranchCode'];?>" class="btn btn-primary btn-round ml-auto" style="padding:2px 10px">
                                        Pay Amount
                                        </a>
                                        <?php } else { ?>
                                        <a href="Payment.php?Branch=<?php echo $Branch['BranchCode'];?>" class="btn btn-primary btn-round ml-auto" style="padding:2px 10px">
                                        Refill
                                        </a>
                                        <?php } ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="BranchWiseOutStandingInfo.php?Branch=<?php echo $Branch["BranchCode"];?>" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" style="padding: 2px 10px" >
                                        <i class="fa fa-list-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php }?>
                            <?php if (sizeof($Branches)==0) {?>
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