<div class="row mt-4 ">
    <div class="col-lg-12 mb-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0 pt-3 bg-transparent row">
                <h3 class="text-capitalize col-9">Accounts</h3>
                <div class="col-3 d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form-account"><i class="fas fa-plus me-2"></i>Add Account</button>
                    <div class="modal fade" id="modal-form-account" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h3 class="font-weight-bolder text-info text-gradient">Add Account</h3>
                                        </div>
                                        <div class="card-body">
                                            <form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_account">
                                                <label>User Name</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="text" placeholder="User Name" name='user_name' required>
                                                </div>
                                                <label>Password</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="password" placeholder="Password" name='user_password' required>
                                                </div>
                                                <!-- <label>Contact</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="text" placeholder="Contact" name='contact' required>
                                                </div> -->
                                                <label>Privileges</label>
                                                <div class="container row mb-3">
                                                    <label class="col-md-12 text-center"><u>Dashboard</u></label>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" type="checkbox" checked disabled>
                                                        <input name="privileges[]" type="checkbox" checked hidden value="view_dashboard">
                                                        <label class="custom-control-label">View Dashboard</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="add_line">
                                                        <label class="custom-control-label">Add Line</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_line">
                                                        <label class="custom-control-label">Delete Line</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="view_all_line">
                                                        <label class="custom-control-label">View All Line</label>
                                                    </div>
                                                    <?php foreach ($lines as $line) : ?>
                                                        <div class="form-check col-md-4">
                                                            <input class="form-check-input" name="privileges[]" type="checkbox" value="view_line_<?php echo $line['id']; ?>">
                                                            <label class="custom-control-label">View Line <?php echo $line['line_name']; ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="container row mb-3">
                                                    <label class="col-md-12 text-center"><u>Order</u></label>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="view_order">
                                                        <label class="custom-control-label">View Order</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="add_order">
                                                        <label class="custom-control-label">Add Order</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_order">
                                                        <label class="custom-control-label">Delete Order</label>
                                                    </div>
                                                </div>
                                                <div class="container row mb-3">
                                                    <label class="col-md-12 text-center"><u>OEE Management</u></label>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="view_oee_management">
                                                        <label class="custom-control-label">View OEE Management</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="add_sku">
                                                        <label class="custom-control-label">Add SKU</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_sku">
                                                        <label class="custom-control-label">Edit SKU</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_sku">
                                                        <label class="custom-control-label">Delete SKU</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="add_pic">
                                                        <label class="custom-control-label">Add PIC</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_pic">
                                                        <label class="custom-control-label">Edit PIC</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_pic">
                                                        <label class="custom-control-label">Delete PIC</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="add_remark">
                                                        <label class="custom-control-label">Add Remark</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_remark">
                                                        <label class="custom-control-label">Edit Remark</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_remark">
                                                        <label class="custom-control-label">Delete Remark</label>
                                                    </div>
                                                </div>
                                                <div class="container row mb-3">
                                                    <label class="col-md-12 text-center"><u>Warehouse Management</u></label>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="view_warehouse_management">
                                                        <label class="custom-control-label">View Warehouse Management</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="add_inventory">
                                                        <label class="custom-control-label">Add Inventory</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_inventory">
                                                        <label class="custom-control-label">Edit Inventory</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_inventory">
                                                        <label class="custom-control-label">Delete Inventory</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_fg">
                                                        <label class="custom-control-label">Edit FG</label>
                                                    </div>
                                                </div>
                                                <div class="container row mb-3">
                                                    <label class="col-md-12 text-center"><u>Product Cycle Tracking</u></label>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="view_pct">
                                                        <label class="custom-control-label">View Product Cycle Tracking</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="add_delivery">
                                                        <label class="custom-control-label">Add Delivery</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_delivery">
                                                        <label class="custom-control-label">Delete Delivery</label>
                                                    </div>
                                                </div>
                                                <div class="container row mb-3">
                                                    <label class="col-md-12 text-center"><u>Breakdown Log</u></label>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="view_breakdown_log">
                                                        <label class="custom-control-label">View Breakdown Log</label>
                                                    </div>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_breakdown_log">
                                                        <label class="custom-control-label">Edit Breakdown Log</label>
                                                    </div>
                                                </div>
                                                <div class="container row mb-3">
                                                    <label class="col-md-12 text-center"><u>Event Log</u></label>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="view_event_log">
                                                        <label class="custom-control-label">View Event Log</label>
                                                    </div>
                                                </div>
                                                <div class="container row mb-3">
                                                    <label class="col-md-12 text-center"><u>Reporting</u></label>
                                                    <div class="form-check col-md-4">
                                                        <input class="form-check-input" name="privileges[]" type="checkbox" value="view_reporting">
                                                        <label class="custom-control-label">View Reporting</label>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn bg-gradient-primary" value="Submit">Submit</button>
                                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
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
            <div class="card-body table-responsive">
                <table id="account_list" class="display text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Change Password</th>
                            <th>Edit Privileges</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Change Password</th>
                            <th>Edit Privileges</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>