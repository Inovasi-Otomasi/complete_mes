<button type="button" class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" data-bs-toggle="modal" data-bs-target="#modal-form-delete-order-<?php echo $id; ?>"><i class="fas fa-trash"></i></button>
<div class="modal fade" id="modal-form-delete-order-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-info text-gradient">Are you sure you want to delete this item?</h3>
                    </div>
                    <div class="card-body text-start">
                        <form role="form" method="post" action="<?php echo base_url('ajax/delete_order?id=') . $id; ?>">
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary" value="Submit">Yes</button>
                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>