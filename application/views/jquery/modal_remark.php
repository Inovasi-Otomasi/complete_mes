<button type="button" class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" data-bs-toggle="modal" data-bs-target="#modal-form-remark-<?php echo $id; ?>"><i class="fas fa-edit"></i></button>
<div class="modal fade" id="modal-form-remark-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-info text-gradient">Edit Remark</h3>
                    </div>
                    <div class="card-body text-start">
                        <form role="form" method="post" action="<?php echo base_url(); ?>ajax/edit_remark">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <label>Status</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="status" name="status">
                                    <option value="SETUP" <?php if ($status == "SETUP") echo "selected"; ?>>SETUP</option>
                                    <option value="STANDBY" <?php if ($status == "STANDBY") echo "selected"; ?>>STANDBY</option>
                                    <option value="BREAKDOWN" <?php if ($status == "BREAKDOWN") echo "selected"; ?>>BREAKDOWN</option>
                                </select>
                            </div>
                            <label>Remark</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Remark" name='remark' value="<?php echo $detail; ?>" required>
                            </div>
                            <label>Remark Time (Second) Note: ignore for BREAKDOWN</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" placeholder="Remark Time" name='remark_time' value="<?php echo $remark_time; ?>" required>
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