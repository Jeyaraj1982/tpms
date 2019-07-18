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
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="index.php">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Bookings</a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="NewBookingForm.php">New Bookings</a>
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
                                                <label for="BranchCode" class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Customer</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="Customer" name="Customer" placeholder="Customer" style="width:100%">
                                                    <span class="errorstring" id="ErrCustomer"><?php echo isset($ErrCustomer)? $ErrCustomer : "";?></span>
                                                </div>
                                                <div class="col-sm-1"><a data-toggle="modal" data-target="#SearchCustomer" style="color:white" class="btn btn-primary btn-round ml-auto"><i class="fa fa-search search-icon"></i></a></div>
                                                <div class="col-sm-1"><a data-toggle="modal" data-target="#addCusomer" style="color:white" class="btn btn-primary btn-round ml-auto"><i class="fa fa-plus"></i></a></div>
                                    </div>
                                    <div class="form-group form-inline">
                                                <label for="CustomerName" class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Customer Name</label>
                                                <div class="col-sm-4"></div>
                                                <label for="OrderID" class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Order ID</label>
                                                <div class="col-sm-4"></div>
                                    </div><div class="form-group form-inline">
                                                <label for="EmailID" class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Email ID</label>
                                                <div class="col-sm-4"></div>
                                                <label for="OrderOn" class="col-sm-2" style="padding-left: 0px !important;">Order On</label>
                                                <div class="col-sm-4"></div>
                                    </div>
                                    <div class="form-group form-inline">
                                                <label for="MobileNumber" class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Mobile Number</label>
                                                <div class="col-sm-4"></div>
                                    </div>
                                    <div class="form-group form-inline">
                                                <label for="Password" class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Password</label>
                                                <div class="col-sm-4"></div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>
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
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><div class="form-button-action">
                                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div></td>
                                                </tr>
                                            </tbody> 
                                        </table>
                                    </div>
                                    <a class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal" style="color:white">
                                                        <i class="fa fa-plus"></i>
                                                        </a>
                                    <div class="form-group form-inline">
                                        <div class="col-sm-8"></div> 
                                        <label for="SubTotal" class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Sub Total</label>
                                        <div class="col-sm-2">
                                                <input type="text" class="form-control" id="SubTotal" name="SubTotal" placeholder="Sub Total" style="width:100%">
                                                    <span class="errorstring" id="ErrSubTotal"><?php echo isset($ErrSubTotal)? $ErrSubTotal : "";?></span></div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <div class="col-sm-8"></div> 
                                        <label for="ServiceCharge" class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Service Charge</label>
                                        <div class="col-sm-2">
                                                <input type="text" class="form-control" id="ServiceCharge" name="ServiceCharge" placeholder="Sub Total" style="width:100%">
                                                    <span class="errorstring" id="ErrServiceCharge"><?php echo isset($ErrServiceCharge)? $ErrServiceCharge : "";?></span></div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <div class="col-sm-8"></div> 
                                        <label for="PayableAmount" class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Payable Amount</label>
                                        <div class="col-sm-2">
                                                <input type="text" class="form-control" id="PayableAmount" name="PayableAmount" placeholder="Sub Total" style="width:100%">
                                                    <span class="errorstring" id="ErrPayableAmount"><?php echo isset($ErrPayableAmount)? $ErrPayableAmount : "";?></span></div>
                                    </div>
                                    <div class="card-action">
                                    <button class="btn btn-success" name="SaveOrder">Save Order</button>
                                        </div>
                                </div>
                <div class="modal fade" id="SearchCustomer" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header no-bd">
                            <h5 class="modal-title">Sarch Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <div class="form-group form-inline">
                                    <label for="MobileNumber" class="col-sm-3">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" placeholder="Mobile Number" style="width:100%">
                                        <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                    </div>
                                </div>
                                <br>
                                <div class="card-action">
                                    <button class="btn btn-success" name="Search">Search</button>
                                    <button class="btn btn-danger">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addCusomer" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header no-bd">
                            <h5 class="modal-title">Add Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <script>
                                function submitCustomerDetails() {

                                    $('#ErrCustomerName').html("");
                                    $('#ErrContactMobileNumber').html("");
                                    $('#ErrContactEmailAddress').html("");
                                    $('#ErrAddress').html("");
                                    $('#ErrPincode').html("");

                                    ErrorCount = 0;

                                    IsNonEmpty("CustomerName", "ErrCustomerName", "Please Enter Valid Customer Name");

                                    /*  if(IsNonEmpty("ContactMobileNumber","ErrContactMobileNumber","Please Enter MobileNumber")) {
                                     IsMobileNumber("ContactMobileNumber","ErrContactMobileNumber","Please Enter Valid MobileNumber");
                                     }*/

                                    if (IsNonEmpty("ContactEmailAddress", "ErrContactEmailAddress", "Please Enter Contact Email Address")) {
                                        IsEmail("ContactEmailAddress", "ErrContactEmailAddress", "Please Enter valid Contact Email Address")
                                    }
                                    IsNonEmpty("Address", "ErrAddress", "Please Enter Valid Address");

                                    IsNonEmpty("Pincode", "ErrPincode", "Please Enter Pincode");

                                    if (ErrorCount == 0) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            </script>
                            <form method="post" action="" onsubmit="return submitCustomerDetails()">
                                <div class="form-group form-inline">
                                    <label for="CustomerName" class="col-sm-3">Customer Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="CustomerName" name="CustomerName" placeholder="Customer Name" style="width:100%">
                                        <span class="errorstring" id="ErrCustomerName"><?php echo isset($ErrCustomerName)? $ErrCustomerName : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="MobileNumber" class="col-sm-3">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" placeholder="Mobile Number" style="width:100%">
                                        <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="ContactEmailAddress" class="col-sm-3">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="ContactEmailAddress" name="ContactEmailAddress" placeholder="Email Address" style="width:100%">
                                        <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                        <span class="errorstring" id="ErrContactEmailAddress"><?php echo isset($ErrContactEmailAddress)? $ErrContactEmailAddress : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="Address" class="col-sm-3">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Address" name="Address" placeholder="Address" style="width:100%">
                                        <span class="errorstring" id="ErrAddress"><?php echo isset($ErrAddress)? $ErrAddress : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="Address1" class="col-sm-3">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Address1" name="Address1" placeholder="Address" style="width:100%">
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="Pincode" class="col-sm-3">Pincode</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" maxlength="6" id="Pincode" name="Pincode" placeholder="Pincode" style="width:100%">
                                        <span class="errorstring" id="ErrPincode"><?php echo isset($ErrPincode)? $ErrPincode : "";?></span>
                                    </div>
                                </div>
                                <br>
                                <div class="card-action">
                                    <button class="btn btn-success" name="CreateCustomer">Create</button>
                                    <button class="btn btn-danger">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
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