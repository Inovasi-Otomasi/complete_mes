<button type="button" class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" data-bs-toggle="modal" data-bs-target="#modal-form-<?php echo $id; ?>"><i class="fas fa-edit"></i></button>
<div class="modal fade" id="modal-form-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-info text-gradient">Edit SKU</h3>
                    </div>
                    <div class="card-body text-start">
                        <form role="form" method="post" action="<?php echo base_url(); ?>ajax/edit_sku">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <label>SKU Code</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="SKU Code" name="sku_code" value="<?php echo $sku_code; ?>" required>
                            </div>
                            <label>Line</label>
                            <div class="container row mb-3">
                                <?php if (!$lines) : ?>
                                    <div class="badge bg-gradient-warning">No Items Found</div>
                                <?php endif; ?>
                                <?php $leftover_line = array(); ?>
                                <?php foreach ($lines as $line) : ?>
                                    <?php foreach ($self_lines as $line2) : ?>
                                        <?php if ($line['line_name'] == $line2['line_name']) : ?>
                                            <div class="form-check col-md-4">
                                                <input class="form-check-input" name="line_id[]" type="checkbox" value="<?php echo $line['id']; ?>" checked>
                                                <label class="custom-control-label"><?php echo $line['line_name']; ?></label>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" title="Cycle Time (second)" placeholder="Cycle Time" name="cycle_time_<?php echo $line['id'] ?>" value="<?php echo $line2['cycle_time']; ?>" required><span class="input-group-text">s</span>
                                                </div>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" title="Quantity" placeholder="Quantity" name="quantity_sku_<?php echo $line['id'] ?>" value="<?php echo $line2['quantity']; ?>" step="any" required><span class="input-group-text">pcs</span>
                                                </div>
                                            </div>
                                            <?php array_push($leftover_line, $line2['line_name']); ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if (!in_array($line['line_name'], $leftover_line)) : ?>
                                        <div class="form-check col-md-4">
                                            <input class="form-check-input" name="line_id[]" type="checkbox" value="<?php echo $line['id']; ?>">
                                            <label class="custom-control-label"><?php echo $line['line_name']; ?></label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" title="Cycle Time (second)" placeholder="Cycle Time" name="cycle_time_<?php echo $line['id'] ?>" value="0" required><span class="input-group-text">s</span>
                                            </div>
                                            <div class="input-group">
                                                <input type="number" class="form-control" title="Quantity" placeholder="Quantity" name="quantity_sku_<?php echo $line['id'] ?>" value="0" step="any" required><span class="input-group-text">pcs</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </div>
                            <label>Required Inventory</label>
                            <div class="container row mb-3">
                                <?php if (!$inv) : ?>
                                    <div class="badge bg-gradient-warning">No Items Found</div>
                                <?php endif; ?>
                                <?php $leftover = array(); ?>
                                <?php foreach ($inv as $list) : ?>
                                    <?php foreach ($self_inv as $list2) : ?>
                                        <?php if ($list['inventory_code'] == $list2['inventory_code']) :
                                        ?>
                                            <div class="form-check col-md-4">
                                                <input class="form-check-input" name="inv[]" checked type="checkbox" value="<?php echo $list['id']; ?>">
                                                <label class="custom-control-label"><?php echo $list['inventory_name']; ?></label>
                                                <input type="number" class="form-control" placeholder="Quantity" name="quantity_<?php echo $list['id'] ?>" value="<?php echo $list2['quantity'] ?>" required>
                                            </div>
                                            <?php array_push($leftover, $list2['inventory_code']); ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if (!in_array($list['inventory_code'], $leftover)) : ?>
                                        <div class="form-check col-md-4">
                                            <input class="form-check-input" name="inv[]" type="checkbox" value="<?php echo $list['id']; ?>">
                                            <label class="custom-control-label"><?php echo $list['inventory_name']; ?></label>
                                            <input type="number" class="form-control" placeholder="Quantity" name="quantity_<?php echo $list['id'] ?>" value="0" required>
                                        </div>
                                        <?php array_push($leftover, $list['inventory_code']); ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
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