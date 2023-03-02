<div class="row mt-4 ">
    <div class="col-lg-12 mb-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0 pt-3 bg-transparent row">
                <h3 class="text-capitalize col-9">Inventory List</h3>
                <div class="col-3 d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form-inventory"><i class="fas fa-plus me-2"></i>Add Inventory</button>
                    <div class="modal fade" id="modal-form-inventory" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h3 class="font-weight-bolder text-info text-gradient">Add Inventory</h3>
                                        </div>
                                        <div class="card-body">
                                            <form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_inventory">
                                                <label>Invetory Name</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="text" placeholder="Inventory Name" name='inventory_name' required>
                                                </div>
                                                <label>Inventory Code</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="text" placeholder="Inventory Code" name='inventory_code' required>
                                                </div>
                                                <label>Quantity</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="number" placeholder="Quantity" name='quantity' required>
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
                <table id="inventory_list" class="display text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Inventory Name</th>
                            <th>Inventory Code</th>
                            <th>Quantity</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Inventory Name</th>
                            <th>Inventory Code</th>
                            <th>Quantity</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0 pt-3 bg-transparent row">
                <h3 class="text-capitalize col-9">Finished Goods List</h3>
            </div>
            <div class="card-body table-responsive">
                <table id="finished_goods_list" class="display text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SKU Code</th>
                            <th>Quantity</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>SKU Code</th>
                            <th>Quantity</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>