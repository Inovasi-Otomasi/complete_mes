<button type="button" class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" data-bs-toggle="modal" data-bs-target="#modal-form-FG-<?php echo $id; ?>"><i class="fas fa-edit"></i></button>
<div class="modal fade" id="modal-form-FG-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-info text-gradient">Edit FG</h3>
                    </div>
                    <div class="card-body text-start">
                        <form role="form" method="post" action="<?php echo base_url(); ?>ajax/edit_FG">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <label><?php echo $sku_code; ?> Quantity</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Quantity" name="quantity" value="<?php echo $quantity; ?>" required>
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