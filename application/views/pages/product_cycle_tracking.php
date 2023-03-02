<div class="row mt-4 ">
    <div class="col-lg-12 mb-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0 pt-3 bg-transparent row">
                <h3 class="text-capitalize col-9">Tracking</h3>
                <div class="col-3 d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form-delivery"><i class="fas fa-plus me-2"></i>Add Delivery</button>
                    <div class="modal fade" id="modal-form-delivery" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h3 class="font-weight-bolder text-info text-gradient">Add Delivery</h3>
                                        </div>
                                        <div class="card-body">
                                            <form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_delivery">
                                                <label>From Order</label>
                                                <div class="container row mb-3">
                                                    <?php if (!$order_list) : ?>
                                                        <div class="badge bg-gradient-warning">No Items Found</div>
                                                    <?php endif; ?>
                                                    <?php foreach ($order_list as $list) : ?>
                                                        <div class="form-check col-md-6">
                                                            <input class="form-check-input" name="items_order[]" type="checkbox" value="<?php echo $list['id']; ?>">
                                                            <label class="custom-control-label"><?php echo "ID: " . $list['id'] . " | " . $list['sku_code'] . " | " . $list['quantity'] . " pcs"; ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <label>From Finished Goods</label>
                                                <div class="container row mb-3">
                                                    <?php if (!$sku_code) : ?>
                                                        <div class="badge bg-gradient-warning">No Items Found</div>
                                                    <?php endif; ?>
                                                    <?php foreach ($sku_code as $list) : ?>
                                                        <div class="form-check col-md-4">
                                                            <input class="form-check-input" name="items_sku[]" type="checkbox" value="<?php echo $list['sku_code']; ?>">
                                                            <label class="custom-control-label"><?php echo $list['sku_code']; ?></label>
                                                            <input type="number" class="form-control" placeholder="Quantity" name="quantity_sku_<?php echo $list['id'] ?>" max="<?php echo $list['quantity']; ?>" min="0" value="0" required>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <label>Customer</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="text" placeholder="Customer" name='customer' required>
                                                </div>
                                                <label>Driver</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-select" name="tracker_id" required>
                                                        <!-- <option value=""></option> -->
                                                        <?php if ($tracker_list->success) : ?>
                                                            <?php foreach ($tracker_list->list as $tracker) : ?>
                                                                <option value="<?php echo $tracker->id ?>"><?php echo $tracker->label ?></option>
                                                            <?php endforeach; ?>
                                                        <?php else : ?>
                                                            <option value="none" disabled>Driver Not Found</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <label>Schedule From</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="datetime-local" name='from_time' required>
                                                </div>
                                                <label>Schedule To</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="datetime-local" name='to_time' required>
                                                </div>
                                                <label>Address</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="text" placeholder="Address" name='address' required>
                                                </div>
                                                <!-- <label>Lattitude</label>
                                                <div class="input-group mb-3"> -->
                                                <input class="form-control" type="number" step="any" placeholder="Lattitude" name='lat' id="lattitude" hidden required>
                                                <!-- </div>
                                                <label>Longitude</label> -->
                                                <!-- <div class="input-group mb-3"> -->
                                                <input class="form-control" type="number" step="any" placeholder="Longitude" name='lng' id="longitude" hidden required>
                                                <!-- </div> -->
                                                <label>Map</label>
                                                <div class="input-group mb-3">
                                                    <input id="pac-input" placeholder="Enter your address" type="text" />
                                                    <div id="googleMap" style="width:100%;height:400px;"></div>
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
                <table id="tracking_list" class="display text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tracking Number</th>
                            <th>Items</th>
                            <!-- <th>SKU Code</th>
                            <th>Quantity</th> -->
                            <th>Customer</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Schedule From</th>
                            <th>Schedule To</th>
                            <th>Tracking</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tracking Number</th>
                            <th>Items</th>
                            <!-- <th>SKU Code</th>
                            <th>Quantity</th> -->
                            <th>Customer</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Schedule From</th>
                            <th>Schedule To</th>
                            <th>Tracking</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>