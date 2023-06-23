<div class="row mt-4 ">
	<div class="col-lg-12 mb-lg-4 mb-4">
		<div class="card h-100">
			<div class="card-header pb-0 pt-3 bg-transparent row">
				<h3 class="text-capitalize col-9">Order List</h3>
				<div class="col-3 d-flex justify-content-end">
					<button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form-order"><i class="fas fa-plus me-2"></i>Add Order</button>
					<div class="modal fade" id="modal-form-order" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-md" role="document">
							<div class="modal-content">
								<div class="modal-body p-0">
									<div class="card card-plain">
										<div class="card-header pb-0 text-left">
											<h3 class="font-weight-bolder text-info text-gradient">Add Order</h3>
										</div>
										<div class="card-body">
											<form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_order">
												<label>SKU Code</label>
												<div class="input-group mb-3 row">
													<div class="col-12">
														<select class="selectize" id="sku_code" name="sku_code">
															<option value="">Select SKU...</option>
															<?php foreach ($sku_code as $sku) : ?>
																<?php if ($sku['line_name'] != 'All') : ?>
																	<option value="<?php echo $sku['sku_code'] ?>"><?php echo $sku['sku_code'] ?></option>
																<?php endif; ?>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
												<label>Batch Number</label>
												<div class="input-group mb-3">
													<input class="form-control" type="text" placeholder="Batch Number" name='batch_id' required>
												</div>
												<label>Lot Number</label>
												<div class="input-group mb-3">
													<input class="form-control" type="text" placeholder="Lot Number" name='lot_number' required>
												</div>
												<label>Quantity</label>
												<div class="input-group mb-3">
													<input class="form-control" type="number" placeholder="Quantity" name='quantity' required>
												</div>
												<!-- <label>Input to storage?</label> -->
												<div class="input-group mb-3">
													<select class="form-select" hidden name="storage">
														<option value="1" default>Yes</option>
														<option value="0">No</option>
													</select>
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
				<table id="order_list" class="display text-center text-nowrap" style="width:100%">
					<thead>
						<tr>
							<!-- <th>ID</th> -->
							<th>Batch Number</th>
							<th>Lot Number</th>
							<th>Line Name</th>
							<th>SKU Name</th>
							<th>Target Quantity</th>
							<!-- <th>Counter</th>
                            <th>NG Product</th> -->
							<th>Created At</th>
							<th>Started At</th>
							<!-- <th>Estimation</th> -->
							<th>Finished At</th>
							<th>Storage</th>
							<th>Status</th>
							<th>Progress</th>
							<!-- <th>Edit</th> -->
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<!-- <th>ID</th> -->
							<th>Batch Number</th>
							<th>Lot Number</th>
							<th>Line Name</th>
							<th>SKU Name</th>
							<th>Target Quantity</th>
							<!-- <th>Counter</th>
                            <th>NG Product</th> -->
							<th>Created At</th>
							<th>Started At</th>
							<!-- <th>Estimation</th> -->
							<th>Finished At</th>
							<th>Storage</th>
							<th>Status</th>
							<th>Progress</th>
							<!-- <th>Edit</th> -->
							<th>Delete</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>