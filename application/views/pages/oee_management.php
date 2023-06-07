<div class="row mt-4 ">
	<div class="col-lg-12 mb-lg-4 mb-4">
		<div class="card h-100 ">
			<ul class="nav nav-tabs mb-2" id="myTab">
				<li class="nav-item">
					<a href="#sku-list" class="nav-link active" data-bs-toggle="tab">SKU</a>
				</li>
				<li class="nav-item">
					<a href="#pic-list" class="nav-link" data-bs-toggle="tab">PIC</a>
				</li>
				<li class="nav-item">
					<a href="#remark-list" class="nav-link" data-bs-toggle="tab">REMARK</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="sku-list" class="tab-pane fade show active">
					<div class="card-header pb-0 bg-transparent row">
						<h3 class="text-capitalize col-9">SKU List</h3>
						<div class="col-3 d-flex justify-content-end">
							<button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form-sku"><i class="fas fa-plus me-2"></i>Add SKU</button>
							<div class="modal fade" id="modal-form-sku" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-md" role="document">
									<div class="modal-content">
										<div class="modal-body p-0">
											<div class="card card-plain">
												<div class="card-header pb-0 text-left">
													<h3 class="font-weight-bolder text-info text-gradient">Add SKU</h3>
												</div>
												<div class="card-body">
													<form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_sku">
														<!-- <label>Line</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-select" id="line_name" name="line_name">
                                                        <?php foreach ($lines as $line) : ?>
                                                            <option value="<?php echo $line['line_name'] ?>"><?php echo $line['line_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div> -->
														<label>SKU Code</label>
														<div class="input-group mb-3">
															<input class="form-control" type="text" placeholder="SKU Code" name='sku_code' required>
														</div>
														<!-- <label>Cycle Time (Second)</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="number" placeholder="Cycle Time" name='cycle_time' required>
                                                </div> -->
														<label>Line</label>
														<div class="container row mb-3">
															<?php if (!$lines) : ?>
																<div class="badge bg-gradient-warning">No Items Found</div>
															<?php endif; ?>
															<?php foreach ($lines as $line) : ?>
																<div class="form-check col-md-4">
																	<input class="form-check-input" name="line_id[]" type="checkbox" value="<?php echo $line['id']; ?>">
																	<label class="custom-control-label"><?php echo $line['line_name']; ?></label>
																	<div class="input-group mb-2">
																		<input type="number" step="any" class="form-control" title="Cycle Time (Detik)" placeholder="Cycle Time" name="cycle_time_<?php echo $line['id'] ?>" value="0" required><span class="input-group-text">detik</span>
																	</div>
																	<div class="input-group">
																		<input type="number" class="form-control" title="Quantity" placeholder="Quantity" name="quantity_sku_<?php echo $line['id'] ?>" value="0" step="any" required><span class="input-group-text">pcs</span>
																	</div>
																</div>
															<?php endforeach; ?>
														</div>
														<!-- <label>Required Material</label>
														<div class="container row mb-3">
															<?php if (!$inventory_info) : ?>
																<div class="badge bg-gradient-warning">No Items Found</div>
															<?php endif; ?>
															<?php foreach ($inventory_info as $list) : ?>
																<div class="form-check col-md-4">
																	<input class="form-check-input" name="inv[]" type="checkbox" value="<?php echo $list['id']; ?>">
																	<label class="custom-control-label"><?php echo $list['inventory_name']; ?></label>
																	<input type="number" class="form-control" title="Quantity" placeholder="Quantity" name="quantity_<?php echo $list['id'] ?>" value="0" required>
																</div>
															<?php endforeach; ?>
														</div> -->
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
						<table id="sku_list" class="display text-center" style="width:100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>SKU Code</th>
									<th>Line Name (Cycle Time, Quantity)</th>
									<!-- <th>Line Name</th> -->
									<!-- <th>Setup Time</th> -->
									<!-- <th>Cycle Time (s)</th> -->
									<th>Material (Quantity)</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>SKU Code</th>
									<th>Line Name (Cycle Time, Quantity)</th>
									<!-- <th>Line Name</th> -->
									<!-- <th>Setup Time</th> -->
									<!-- <th>Cycle Time (s)</th> -->
									<th>Material (Quantity)</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div id="pic-list" class="tab-pane fade ">
					<div class="card-header pb-0 bg-transparent row">
						<h3 class="text-capitalize col-9">PIC List</h3>
						<div class="col-3 d-flex justify-content-end">
							<button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form-pic"><i class="fas fa-plus me-2"></i>Add PIC</button>
							<div class="modal fade" id="modal-form-pic" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-md" role="document">
									<div class="modal-content">
										<div class="modal-body p-0">
											<div class="card card-plain">
												<div class="card-header pb-0 text-left">
													<h3 class="font-weight-bolder text-info text-gradient">Add PIC</h3>
												</div>
												<div class="card-body">
													<form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_pic">
														<label>PIC Name</label>
														<div class="input-group mb-3">
															<input class="form-control" type="text" placeholder="PIC Name" name='pic_name' required>
														</div>
														<label>Employee ID</label>
														<div class="input-group mb-3">
															<input class="form-control" type="number" placeholder="Employee ID" name='employee_id' required>
														</div>
														<label>Contact</label>
														<div class="input-group mb-3">
															<input class="form-control" type="text" placeholder="Contact" name='contact' required>
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
						<table id="pic_list" class="display text-center" style="width:100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>PIC Name</th>
									<th>Employee ID</th>
									<th>Contact</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>PIC Name</th>
									<th>Employee ID</th>
									<th>Contact</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div id="remark-list" class="tab-pane fade ">
					<div class="card-header pb-0 bg-transparent row">
						<h3 class="text-capitalize col-9">Remark List</h3>
						<div class="col-3 d-flex justify-content-end">
							<button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form-remark"><i class="fas fa-plus me-2"></i>Add Remark</button>
							<div class="modal fade" id="modal-form-remark" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-md" role="document">
									<div class="modal-content">
										<div class="modal-body p-0">
											<div class="card card-plain">
												<div class="card-header pb-0 text-left">
													<h3 class="font-weight-bolder text-info text-gradient">Add Remark</h3>
												</div>
												<div class="card-body">
													<form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_remark">
														<label>Status</label>
														<div class="input-group mb-3">
															<select class="form-select" id="status" name="status">
																<option value="SETUP">SETUP</option>
																<option value="STANDBY">STANDBY</option>
																<option value="DOWN TIME">DOWN TIME</option>
																<option value="SMALL STOP">SMALL STOP</option>
															</select>
														</div>
														<label>Remark</label>
														<div class="input-group mb-3">
															<input class="form-control" type="text" placeholder="Remark" name='remark' required>
														</div>
														<label>Remark Time (Detik) Note: ignore for DOWN TIME</label>
														<div class="input-group mb-3">
															<input class="form-control" type="number" placeholder="Remark Time" name='remark_time' value="0" required>
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
						<table id="remark_list" class="display text-center" style="width:100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Status</th>
									<th>Detail</th>
									<th>Remark Time (s)</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>Status</th>
									<th>Detail</th>
									<th>Remark Time (s)</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="col-lg-12 mb-lg-4 mb-4">
		<div class="card h-100">
			<div class="card-header pb-0 pt-3 bg-transparent row">
				<h3 class="text-capitalize col-9">PIC List</h3>
				<div class="col-3 d-flex justify-content-end">
					<button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form-pic"><i class="fas fa-plus me-2"></i>Add PIC</button>
					<div class="modal fade" id="modal-form-pic" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-md" role="document">
							<div class="modal-content">
								<div class="modal-body p-0">
									<div class="card card-plain">
										<div class="card-header pb-0 text-left">
											<h3 class="font-weight-bolder text-info text-gradient">Add PIC</h3>
										</div>
										<div class="card-body">
											<form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_pic">
												<label>PIC Name</label>
												<div class="input-group mb-3">
													<input class="form-control" type="text" placeholder="PIC Name" name='pic_name' required>
												</div>
												<label>Employee ID</label>
												<div class="input-group mb-3">
													<input class="form-control" type="number" placeholder="Employee ID" name='employee_id' required>
												</div>
												<label>Contact</label>
												<div class="input-group mb-3">
													<input class="form-control" type="text" placeholder="Contact" name='contact' required>
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
				<table id="pic_list" class="display text-center" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>PIC Name</th>
							<th>Employee ID</th>
							<th>Contact</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>PIC Name</th>
							<th>Employee ID</th>
							<th>Contact</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div> -->
	<!-- <div class="col-lg-12 mb-lg-4 mb-4">
		<div class="card h-100">
			<div class="card-header pb-0 pt-3 bg-transparent row">
				<h3 class="text-capitalize col-9">Remark List</h3>
				<div class="col-3 d-flex justify-content-end">
					<button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form-remark"><i class="fas fa-plus me-2"></i>Add Remark</button>
					<div class="modal fade" id="modal-form-remark" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-md" role="document">
							<div class="modal-content">
								<div class="modal-body p-0">
									<div class="card card-plain">
										<div class="card-header pb-0 text-left">
											<h3 class="font-weight-bolder text-info text-gradient">Add Remark</h3>
										</div>
										<div class="card-body">
											<form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_remark">
												<label>Status</label>
												<div class="input-group mb-3">
													<select class="form-select" id="status" name="status">
														<option value="SETUP">SETUP</option>
														<option value="STANDBY">STANDBY</option>
														<option value="BREAKDOWN">BREAKDOWN</option>
													</select>
												</div>
												<label>Remark</label>
												<div class="input-group mb-3">
													<input class="form-control" type="text" placeholder="Remark" name='remark' required>
												</div>
												<label>Remark Time (Second) Note: ignore for BREAKDOWN</label>
												<div class="input-group mb-3">
													<input class="form-control" type="number" placeholder="Remark Time" name='remark_time' value="0" required>
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
				<table id="remark_list" class="display text-center" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Status</th>
							<th>Detail</th>
							<th>Remark Time (s)</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>Status</th>
							<th>Detail</th>
							<th>Remark Time (s)</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div> -->
</div>