<button type="button" class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" data-bs-toggle="modal" data-bs-target="#modal-form-account-privileges-<?php echo $id; ?>"><i class="fas fa-edit"></i></button>
<div class="modal fade" id="modal-form-account-privileges-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-info text-gradient">Edit Privileges</h3>
                    </div>
                    <div class="card-body text-start">
                        <form role="form" method="post" action="<?php echo base_url(); ?>ajax/edit_account">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <label>Privileges</label>
                            <div class="container row mb-3">
                                <label class="col-md-12 text-center"><u>Dashboard</u></label>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <input name="privileges[]" type="checkbox" checked hidden value="view_dashboard">
                                    <label class="custom-control-label">View Dashboard</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="add_line" <?php if (in_array('add_line', json_decode($privileges, true))) : ?>checked<?php endif; ?>>
                                    <label class="custom-control-label">Add Line</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_line" <?php if (in_array('delete_line', json_decode($privileges, true))) : ?>checked<?php endif; ?>>
                                    <label class="custom-control-label">Delete Line</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="view_all_line" <?php if (in_array('view_all_line', json_decode($privileges, true))) : ?>checked<?php endif; ?>>
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
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="view_order" <?php if (in_array('view_order', json_decode($privileges, true))) : ?>checked<?php endif; ?>>
                                    <label class="custom-control-label">View Order</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="add_order" <?php if (in_array('add_order', json_decode($privileges, true))) : ?>checked<?php endif; ?>>
                                    <label class="custom-control-label">Add Order</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_order" <?php if (in_array('delete_order', json_decode($privileges, true))) : ?>checked<?php endif; ?>>
                                    <label class="custom-control-label">Delete Order</label>
                                </div>
                            </div>
                            <div class="container row mb-3">
                                <label class="col-md-12 text-center"><u>OEE Management</u></label>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="view_oee_management" <?php if (in_array('view_oee_management', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">View OEE Management</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="add_sku" <?php if (in_array('add_sku', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Add SKU</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_sku" <?php if (in_array('edit_sku', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Edit SKU</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_sku" <?php if (in_array('delete_sku', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Delete SKU</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="add_pic" <?php if (in_array('add_pic', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Add PIC</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_pic" <?php if (in_array('edit_pic', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Edit PIC</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_pic" <?php if (in_array('delete_pic', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Delete PIC</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="add_remark" <?php if (in_array('add_remark', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Add Remark</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_remark" <?php if (in_array('edit_remark', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Edit Remark</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_remark" <?php if (in_array('delete_remark', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Delete Remark</label>
                                </div>
                            </div>
                            <div class="container row mb-3">
                                <label class="col-md-12 text-center"><u>Warehouse Management</u></label>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="view_warehouse_management" <?php if (in_array('view_warehouse_management', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">View Warehouse Management</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="add_inventory" <?php if (in_array('add_inventory', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Add Inventory</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_inventory" <?php if (in_array('edit_inventory', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Edit Inventory</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_inventory" <?php if (in_array('delete_inventory', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Delete Inventory</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_fg" <?php if (in_array('edit_fg', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Edit FG</label>
                                </div>
                            </div>
                            <div class="container row mb-3">
                                <label class="col-md-12 text-center"><u>Product Cycle Tracking</u></label>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="view_pct" <?php if (in_array('view_pct', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">View Product Cycle Tracking</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="add_delivery" <?php if (in_array('add_delivery', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Add Delivery</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="delete_delivery" <?php if (in_array('delete_delivery', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Delete Delivery</label>
                                </div>
                            </div>
                            <div class="container row mb-3">
                                <label class="col-md-12 text-center"><u>Breakdown Log</u></label>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="view_breakdown_log" <?php if (in_array('view_breakdown_log', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">View Breakdown Log</label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="edit_breakdown_log" <?php if (in_array('edit_breakdown_log', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">Edit Breakdown Log</label>
                                </div>
                            </div>
                            <div class="container row mb-3">
                                <label class="col-md-12 text-center"><u>Event Log</u></label>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="view_event_log" <?php if (in_array('view_event_log', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
                                    <label class="custom-control-label">View Event Log</label>
                                </div>
                            </div>
                            <div class="container row mb-3">
                                <label class="col-md-12 text-center"><u>Reporting</u></label>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" name="privileges[]" type="checkbox" value="view_reporting" <?php if (in_array('view_reporting', json_decode($privileges, true))) : ?> checked<?php endif; ?>>
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