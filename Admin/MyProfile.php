    <?php include_once("header.php"); ?>
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">My Profile</h4>
                                </div>
                                 <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Admin Name</div>
                                                 <div class="col-sm-4">                                                                                                              
                                                    <?php echo $_SESSION['User']['AdminName'];?>
                                                 </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Created</div>
                                                <div class="col-sm-4">
                                                    <?php echo $_SESSION['User']['Created'];?>    
                                                </div>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php include_once("footer.php"); ?>