 <?php  include_once("header.php");?>
    <script >
        $(document).ready(function() {
            $('#basic-datatables').DataTable({
            });

            $('#multi-filter-select').DataTable( {
                "pageLength": 5,
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                                );

                            column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                        } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            });

            // Add Row
            $('#add-row').DataTable({
                "pageLength": 5,
            });

            var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                    ]);
                $('#addRowModal').modal('hide');                                                                

            });
        });
    </script>
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Forms</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Forms</a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Basic Form</a>
                            </li>
                        </ul>
                    </div>
                <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">New Booking Form</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    
                                    <div class="form-group form-inline">
                                                <label for="BranchCode" class="col-sm-2">Customer</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="Customer" name="Customer" placeholder="Enter Customer" style="width:100%">
                                                    <span class="errorstring" id="ErrCustomer"><?php echo isset($ErrCustomer)? $ErrCustomer : "";?></span>
                                                </div>
                                                <div class="col-sm-1"><a href="AddCustomer.php" class="btn btn-primary btn-round ml-auto"><i class="fa fa-plus"></i></a></div>
                                    </div>
                                    <div class="form-group form-inline">
                                                <label for="CustomerName" class="col-sm-2">Customer Name</label>
                                                <div class="col-sm-4"></div>
                                                <label for="OrderID" class="col-sm-2">Order ID</label>
                                                <div class="col-sm-4"></div>
                                    </div>
                                    <div class="form-group form-inline">
                                                <label for="EmailID" class="col-sm-2">Email ID</label>
                                                <div class="col-sm-4"></div>
                                                <label for="OrderOn" class="col-sm-2">Order On</label>
                                                <div class="col-sm-4"></div>
                                    </div>
                                    <div class="form-group form-inline">
                                                <label for="MobileNumber" class="col-sm-2">Mobile Number</label>
                                                <div class="col-sm-4"></div>
                                    </div>
                                    <div class="form-group form-inline">
                                                <label for="Password" class="col-sm-2">Password</label>
                                                <div class="col-sm-4"></div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Sl No</th>
                                                    <th>Particulars</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Amount</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal" style="color:white">
                                                        <i class="fa fa-plus"></i>
                                                        </a>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><div class="form-button-action">
                                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div></td>
                                                </tr>
                                            </tbody> 
                                        </table>
                                    </div>
                                    <div class="form-group form-inline">
                                        <div class="col-sm-6"></div> 
                                        <label for="SubTotal" class="col-sm-2">Sub Total</label>
                                        <div class="col-sm-4">
                                                <input type="text" class="form-control" id="SubTotal" name="SubTotal" placeholder="Enter Sub Total" style="width:100%">
                                                    <span class="errorstring" id="ErrSubTotal"><?php echo isset($ErrSubTotal)? $ErrSubTotal : "";?></span></div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <div class="col-sm-6"></div> 
                                        <label for="ServiceCharge" class="col-sm-2">Service Charge</label>
                                        <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ServiceCharge" name="ServiceCharge" placeholder="Enter Sub Total" style="width:100%">
                                                    <span class="errorstring" id="ErrServiceCharge"><?php echo isset($ErrServiceCharge)? $ErrServiceCharge : "";?></span></div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <div class="col-sm-6"></div> 
                                        <label for="PayableAmount" class="col-sm-2">Payable Amount</label>
                                        <div class="col-sm-4">
                                                <input type="text" class="form-control" id="PayableAmount" name="PayableAmount" placeholder="Enter Sub Total" style="width:100%">
                                                    <span class="errorstring" id="ErrPayableAmount"><?php echo isset($ErrPayableAmount)? $ErrPayableAmount : "";?></span></div>
                                    </div>
                                    <div class="card-action">
                                    <button class="btn btn-success" name="SaveOrder">Save Order</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group form-inline">
                                                                    <div class="col-sm-6">
                                                                        <select class="selectpicker form-control" data-live-search="true" class="form-control" name="bus" id="bus" style="width:100%">
                                                                            <option value="Red Bus.in">Red bus.in</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <select class="selectpicker form-control" data-live-search="true" class="form-control" name="Product" id="Product" style="width:100%">
                                                                            <option value="Product">Product</option>
                                                                        </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-inline">
                                                                    <div class="col-sm-1">Qty</div>
                                                                    <div class="col-sm-6">
                                                                        <select class="selectpicker form-control" data-live-search="true" class="form-control" name="Product" id="Product" style="width:100%">
                                                                            <option value="Product">Product</option>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                               <div class="form-group form-inline">
                                                                    <label class="col-sm-3">Amount</label>
                                                                    <div class="col-sm-6"><input id="Amount" type="text" class="form-control" style="width:100%"></div>
                                                                </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer no-bd" style="float:left">
                                                    <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<?php include_once("footer.php");?>