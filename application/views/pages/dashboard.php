<!-- End Navbar -->
<div class="row">
	<!-- experimental -->
	<div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
		<div class="card h-100">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-8 mb-0">
						<div class="numbers">
							<p class="text-sm mb-0 text-uppercase font-weight-bold">Average OEE</p>
						</div>
					</div>
					<div class="col-4 text-end">
						<div class="btn bg-gradient-danger icon-shape  text-center rounded-circle m-0 position-relative">
							<i class="fas fa-business-time text-lg opacity-10 position-absolute top-50 start-50 translate-middle"></i>
						</div>
					</div>
					<div class="col-12">
						<div class="GaugeMeter start-50 top-50 translate-middle" id="avg_oee" data-animationstep="0" data-size="150" data-append="%" data-width="15" data-text_size="0.18"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
		<div class="card h-100">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-8">
						<div class="numbers">
							<p class="text-sm mb-0 text-uppercase font-weight-bold">Average Performance</p>
						</div>
					</div>
					<div class="col-4 text-end">
						<div class="btn bg-gradient-warning icon-shape  text-center rounded-circle m-0 position-relative">
							<i class="fas fa-spinner text-lg opacity-10 position-absolute top-50 start-50 translate-middle"></i>
						</div>
					</div>
					<div class="col-12">
						<div class="GaugeMeter start-50 top-50 translate-middle" id="avg_performance" data-animationstep="0" data-size="150" data-append="%" data-width="15" data-text_size="0.18"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
		<div class="card h-100">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-8">
						<div class="numbers">
							<p class="text-sm mb-0 text-uppercase font-weight-bold">Average Availability</p>
						</div>
					</div>
					<div class="col-4 text-end">
						<div class="btn bg-gradient-success icon-shape  text-center rounded-circle m-0 position-relative">
							<i class="fas fa-check text-lg opacity-10 position-absolute top-50 start-50 translate-middle"></i>
						</div>
					</div>
					<div class="col-12">
						<div class="GaugeMeter start-50 top-50 translate-middle" id="avg_availability" data-animationstep="0" data-size="150" data-append="%" data-width="15" data-text_size="0.18"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
		<div class="card h-100">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-8">
						<div class="numbers">
							<p class="text-sm mb-0 text-uppercase font-weight-bold">Average Quality</p>
						</div>
					</div>
					<div class="col-4 text-end">
						<div class="btn bg-gradient-primary icon-shape  text-center rounded-circle m-0 position-relative">
							<i class="fas fa-percentage text-lg opacity-10 position-absolute top-50 start-50 translate-middle"></i>
						</div>
					</div>
					<div class="col-12">
						<div class="GaugeMeter start-50 top-50 translate-middle" id="avg_quality" data-animationstep="0" data-size="150" data-append="%" data-width="15" data-text_size="0.18"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="row mt-4">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card h-100">
			<div class="card-header pb-0 p-3">
				<div class="row">
					<div class="col-6 d-flex align-items-center">
						<h6 class="mb-0">Manufacturing Lines</h6>
					</div>
					<div class="col-6 text-end">
						<button type="button" class="btn bg-gradient-primary mb-sm-0 me-sm-2" onClick="window.location.reload();"><i class="fas fa-redo"></i></button>
						<button type="button" class="btn bg-gradient-success mb-0" data-bs-toggle="modal" data-bs-target="#modal-form-add"><i class="fas fa-plus me-2"></i>Add New Line</button>
						<div class="modal text-start fade" id="modal-form-add" tabindex="-1" role="dialog" aria-labelledby="modal-form-add" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content">
									<div class="modal-body p-0">
										<div class="card card-plain">
											<div class="card-header pb-0 text-left">
												<h3 class="font-weight-bolder text-info text-gradient">Add New Line</h3>
											</div>
											<div class="card-body">
												<form role="form" method="post" action="<?php echo base_url(); ?>ajax/add_line">
													<label>Line Name</label>
													<div class=" input-group mb-3">
														<input class="form-control" type="text" placeholder="Line Name" id="line_name" name='line_name' required>
													</div>
													<!-- <label>Rules</label>
                                                    <div class="container row mb-3">
                                                        <div class="form-check col-md-4">
                                                            <input class="form-check-input" name="rule[]" type="checkbox" value="performance" id="rule1">
                                                            <label class="custom-control-label" for="rule1">Performance</label>
                                                        </div>
                                                        <div class="form-check col-md-4">
                                                            <input class="form-check-input" name="rule[]" type="checkbox" value="availability" id="rule2">
                                                            <label class="custom-control-label" for="rule2">Availability</label>
                                                        </div>
                                                        <div class="form-check col-md-4">
                                                            <input class="form-check-input" name="rule[]" type="checkbox" value="quality" id="rule3">
                                                            <label class="custom-control-label" for="rule3">Quality</label>
                                                        </div>
                                                        <div class="form-check col-md-4">
                                                            <input class="form-check-input" name="rule[]" type="checkbox" value="progress" id="rule4">
                                                            <label class="custom-control-label" for="rule4">Progress</label>
                                                        </div>
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
			</div>
			<div class="card-body pt-2 p-3">
				<?php if (in_array_any(['admin'], $privileges)) : ?>
					<div class="d-flex mb-3">
						<div class="d-flex flex-column me-2 text-start">
							<button type="button" class="btn bg-gradient-success mb-0" data-bs-toggle="modal" data-bs-target="#modal-form-start-all"><i class="fas fa-play" aria-hidden="true"></i>&nbsp;&nbsp;Start All</button>
							<div class="modal text-start fade" id="modal-form-start-all" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-md" role="document">
									<div class="modal-content">
										<div class="modal-body p-0">
											<div class="card card-plain">
												<div class="card-header pb-0 text-left">
													<h3 class="font-weight-bolder text-info text-gradient">Are you sure want to start all operation?</h3>
												</div>
												<div class="card-body">
													<form role="form" method="post" action="<?php echo base_url(); ?>operation/start_all">
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
						</div>
						<div class="d-flex flex-column me-2 text-start">
							<button type="button" class="btn btn-danger mb-0" data-bs-toggle="modal" data-bs-target="#modal-form-stop-all"><i class="fas fa-stop" aria-hidden="true"></i>&nbsp;&nbsp;Stop All</button>
							<div class="modal text-start fade" id="modal-form-stop-all" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-md" role="document">
									<div class="modal-content">
										<div class="modal-body p-0">
											<div class="card card-plain">
												<div class="card-header pb-0 text-left">
													<h3 class="font-weight-bolder text-info text-gradient">Are you sure want to stop all operation?</h3>
												</div>
												<div class="card-body">
													<form role="form" method="post" action="<?php echo base_url(); ?>operation/stop_all">
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
						</div>
					</div>
				<?php endif; ?>
				<ul class="nav nav-tabs" id="myTab">
					<li class="nav-item">
						<a href="#overview" class="nav-link active" data-bs-toggle="tab">Overview</a>
					</li>
					<?php foreach ($lines as $line) : ?>
						<?php if (in_array_any(['admin', 'view_all_line', 'view_line_' . $line['id']], $privileges)) : ?>
							<li class="nav-item">
								<a href="#section_<?php echo $line['id']; ?>" class="nav-link" data-bs-toggle="tab"><?php echo $line['line_name']; ?></a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<div class="tab-content">
					<div id="overview" class="tab-pane fade show active mt-2">
						<div class="border-0 p-4 mb-2 bg-gray-400 border-radius-lg">
							<div class="row">
								<?php foreach ($lines as $line) : ?>
									<div class="col-lg-6">
										<div class="ms-auto text-start col">
											<h6 class="mb-3 text-sm">Line <?php echo $line['line_name']; ?></h6>
										</div>
										<div class="card mb-3">
											<div class="card-body p-3">
												<div class="row">
													<div class="col col-lg-4">
														<div class="GaugeMeter start-50 top-50 translate-middle fs-5" id="performance_ov_<?php echo $line['id']; ?>" data-animationstep="0" data-label="Performance" data-size="120" data-append="%" data-width="10" data-text_size="0.18"></div>
													</div>
													<div class="col col-lg-4">
														<div class="GaugeMeter start-50 top-50 translate-middle fs-5" id="availability_ov_<?php echo $line['id']; ?>" data-animationstep="0" data-label="Availability" data-size="120" data-append="%" data-width="10" data-text_size="0.18"></div>
													</div>
													<div class="col col-lg-4">
														<div class="GaugeMeter start-50 top-50 translate-middle fs-5" id="quality_ov_<?php echo $line['id']; ?>" data-animationstep="0" data-label="Quality" data-size="120" data-append="%" data-width="10" data-text_size="0.18"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<?php foreach ($lines as $line) : ?>
						<?php if (in_array_any(['admin', 'view_all_line', 'view_line_' . $line['id']], $privileges)) : ?>
							<div id="section_<?php echo $line['id']; ?>" class="tab-pane fade mt-2">
								<div class="border-0 p-4 mb-2 bg-gray-400 border-radius-lg">
									<div class="row">
										<div class="ms-auto text-start col">
											<h6 class="mb-3 text-sm">Line <?php echo $line['line_name']; ?></h6>
										</div>
										<div class="ms-auto text-end col">
											<button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal-form-delete-<?php echo $line['id']; ?>"><i class="far fa-trash-alt me-1" aria-hidden="true"></i>&nbsp;Delete</button>
											<div class="modal text-start fade" id="modal-form-delete-<?php echo $line['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-md" role="document">
													<div class="modal-content">
														<div class="modal-body p-0">
															<div class="card card-plain">
																<div class="card-header pb-0 text-left">
																	<h3 class="font-weight-bolder text-info text-gradient">Are you sure want to delete this line?</h3>
																</div>
																<div class="card-body">
																	<form role="form" method="post" action="<?php echo base_url(); ?>ajax/delete_line">
																		<input type="hidden" name="line_id" value="<?php echo $line['id']; ?>">
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
											<button type="button" class="btn btn-link text-dark text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal-form-edit-<?php echo $line['id']; ?>"><i class="fas fa-pencil-alt text-dark me-1" aria-hidden="true"></i>&nbsp;Setup</button>
											<div class="modal text-start fade" id="modal-form-edit-<?php echo $line['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-md" role="document">
													<div class="modal-content">
														<div class="modal-body p-0">
															<div class="card card-plain">
																<div class="card-header pb-0 text-left">
																	<h3 class="font-weight-bolder text-info text-gradient">Setup</h3>
																</div>
																<div class="card-body">
																	<form role="form" method="post" action="<?php echo base_url(); ?>operation/setup_line">
																		<input type="hidden" name="line_id" value="<?php echo $line['id']; ?>">
																		<label>Setup Time</label>
																		<div class="input-group mb-3 row">
																			<div class="col">
																				<select class="selectize" id="setup_detail" name="setup_detail">
																					<option value="0" <?php if ($line['remark'] == '') echo "selected"; ?>>None (0 Second)</option>
																					<?php foreach ($remark_list as $remark) : ?>
																						<?php if ($remark['status'] == 'SETUP') : ?>
																							<option value="<?php echo $remark['detail']; ?>" <?php if ($line['remark'] == $remark['detail']) echo "selected"; ?>><?php echo $remark['detail'] . ' (' . $remark['remark_time'] . ' Seconds)'; ?></option>
																						<?php endif; ?>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																		<label>Order ID</label>
																		<div class="input-group mb-3 row">
																			<div class="col">
																				<select class="selectize" id="order_id" name="order_id" required>
																					<?php foreach ($order_list as $order) : ?>
																						<?php foreach (json_decode($order['line_rules'], true) as $rule) : ?>
																							<?php if ($rule['start_job'] == 0 && $rule['line_name'] == $line['line_name']) : ?>
																								<option value="<?php echo $order['id']; ?>" <?php if ($line['order_id'] == $order['id']) echo "selected"; ?>><?php echo "ID: " . $order['id'] . " | " . $order['sku_code'] . " | " . $order['quantity'] . " pcs"; ?></option>
																							<?php endif; ?>
																						<?php endforeach; ?>
																					<?php endforeach; ?>
																				</select>
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
											<button type="button" class="btn btn-link text-dark text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal-form-ng-<?php echo $line['id']; ?>"><i class="fas fa-times-circle text-dark me-1" aria-hidden="true"></i>&nbsp;NG</button>
											<div class="modal text-start fade" id="modal-form-ng-<?php echo $line['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-md" role="document">
													<div class="modal-content">
														<div class="modal-body p-0">
															<div class="card card-plain">
																<div class="card-header pb-0 text-left">
																	<h3 class="font-weight-bolder text-info text-gradient">NG</h3>
																</div>
																<div class="card-body">
																	<form role="form" method="post" action="<?php echo base_url(); ?>operation/ng_edit">
																		<input type="hidden" name="line_id" value="<?php echo $line['id']; ?>">
																		<label>Total NG</label>
																		<div class="input-group mb-3">
																			<input type="number" name="ng_count" class="form-control" min="0" value="<?php echo $line['NG_count']; ?>" id="ng_count_form_<?php echo $line['id']; ?>">
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
									<div class="row">
										<div class="col-lg-4">
											<div class="card mb-3">
												<div class="card-body p-3">
													<div class="row">
														<div class="col-12">
															<div class="numbers">
																<p class="text-sm mb-0 text-uppercase font-weight-bold">Performance</p>
																<div class="progress-wrapper">
																	<div class="progress-info">
																		<div class="progress-percentage">
																			<span class="text-sm font-weight-bold" id="performance_<?php echo $line['id']; ?>"></span><span class="text-sm font-weight-bold"> %</span>
																		</div>
																	</div>
																	<div class="progress">
																		<div class="progress-bar" id="performance_bar_<?php echo $line['id']; ?>" role="progressbar"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card mb-3">
												<div class="card-body p-3">
													<div class="row">
														<div class="col-12">
															<div class="numbers">
																<p class="text-sm mb-0 text-uppercase font-weight-bold">Availability</p>
																<div class="progress-wrapper">
																	<div class="progress-info">
																		<div class="progress-percentage">
																			<span class="text-sm font-weight-bold" id="availability_<?php echo $line['id']; ?>"></span><span class="text-sm font-weight-bold"> %</span>
																		</div>
																	</div>
																	<div class="progress">
																		<div class="progress-bar" id="availability_bar_<?php echo $line['id']; ?>" role="progressbar"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card mb-3">
												<div class="card-body p-3">
													<div class="row">
														<div class="col-12">
															<div class="numbers">
																<p class="text-sm mb-0 text-uppercase font-weight-bold">Quality</p>
																<div class="progress-wrapper">
																	<div class="progress-info">
																		<div class="progress-percentage">
																			<span class="text-sm font-weight-bold" id="quality_<?php echo $line['id']; ?>"></span><span class="text-sm font-weight-bold"> %</span>
																		</div>
																	</div>
																	<div class="progress">
																		<div class="progress-bar" id="quality_bar_<?php echo $line['id']; ?>" role="progressbar"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card mb-3">
												<div class="card-body p-3">
													<div class="row">
														<div class="col-12">
															<div class="numbers">
																<p class="text-sm mb-0 text-uppercase font-weight-bold">Progress</p>
																<div class="progress-wrapper">
																	<div class="progress-info">
																		<div class="progress-percentage">
																			<span class="text-sm font-weight-bold" id="progress_<?php echo $line['id']; ?>"></span><span class="text-sm font-weight-bold"> %</span>
																		</div>
																	</div>
																	<div class="progress">
																		<div class="progress-bar" id="progress_bar_<?php echo $line['id']; ?>" role="progressbar"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-5">
											<div class="row">
												<p class="col-5 text-xl">SKU</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl"><span class="text-dark font-weight-bold ms-sm-2" id='sku_<?php echo $line['id']; ?>'></span></p>
											</div>
											<div class="row">
												<p class="col-5 text-xl">Order ID</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl"><span class="text-dark font-weight-bold ms-sm-2" id='order_id_<?php echo $line['id']; ?>'></span></p>
											</div>
											<div class="row">
												<p class="col-5 text-xl">Target Item</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl"><span class="text-dark font-weight-bold ms-sm-2" id='target_<?php echo $line['id']; ?>'></span></p>
											</div>
											<div class="row">
												<p class="col-5 text-xl">Setup Allowance Time</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl"><span class="text-dark font-weight-bold ms-sm-2" id='setup_time_<?php echo $line['id']; ?>'></span></p>
											</div>
											<div class="row">
												<p class="col-5 text-xl">Cycle Time</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl"><span class="text-dark font-weight-bold ms-sm-2" id='cycle_time_<?php echo $line['id']; ?>'></span></p>
											</div>
											<div class="row">
												<p class="col-5 text-xl">Run Time</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl"><span class="text-dark font-weight-bold ms-sm-2" id='run_time_<?php echo $line['id']; ?>'></span></p>
											</div>
											<div class="row">
												<p class="col-5 text-xl">Down Time</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl"><span class="text-dark font-weight-bold ms-sm-2" id='down_time_<?php echo $line['id']; ?>'></span></p>
											</div>
											<div class="row">
												<p class="col-5 text-xl">Item Counter</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl"><span class="text-dark font-weight-bold ms-sm-2" id='item_counter_<?php echo $line['id']; ?>'></span></p>
											</div>
											<!-- <div class="row">
												<p class="col-5 text-xl">NG Product</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl">
													<button onclick="double_minus_ng(<?php echo $line['id']; ?>)" style="padding: 0; border: none; background: none;">&lt;&lt;</button>
													<button onclick="minus_ng(<?php echo $line['id']; ?>)" class="me-2" style="padding: 0; border: none; background: none;"><i class="fas fa-minus"></i></button>
													<span class="text-dark font-weight-bold" id='NG_<?php echo $line['id']; ?>' style="padding: 0; border: none; background: none;"></span>
													<button onclick="plus_ng(<?php echo $line['id']; ?>)" class="ms-2" style="padding: 0; border: none; background: none;"><i class="fas fa-plus"></i></button>
													<button onclick="double_plus_ng(<?php echo $line['id']; ?>)" style="padding: 0; border: none; background: none;">&gt;&gt;</button>
												</p>
											</div> -->
											<div class="row">
												<p class="col-5 text-xxl">Status</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl"><span class="text-dark font-weight-bold ms-sm-2" id='status_<?php echo $line['id']; ?>'></span></p>
											</div>
										</div>
										<div class="col-lg-3 mb-3 mt-3">
											<button type="button" class="btn bg-gradient-success me-1 w-100" data-bs-toggle="modal" data-bs-target="#modal-form-start-<?php echo $line['id']; ?>"><i class="fas fa-play" aria-hidden="true"></i>&nbsp;&nbsp;Start</button>
											<div class="modal text-start fade" id="modal-form-start-<?php echo $line['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-md" role="document">
													<div class="modal-content">
														<div class="modal-body p-0">
															<div class="card card-plain">
																<div class="card-header pb-0 text-left">
																	<h3 class="font-weight-bolder text-info text-gradient">Are you sure want to start this operation?</h3>
																</div>
																<div class="card-body">
																	<form role="form" method="post" action="<?php echo base_url(); ?>operation/start_operation">
																		<input type="hidden" name="line_id" value="<?php echo $line['id']; ?>">
																		<input type="hidden" name="order_id" value="<?php echo $line['order_id']; ?>">
																		<input type="hidden" name="prev_status" value="<?php echo $line['status']; ?>">
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
											<button type="button" class="btn bg-gradient-warning me-1 w-100" data-bs-toggle="modal" data-bs-target="#modal-form-standby-<?php echo $line['id']; ?>"><i class="fas fa-pause" aria-hidden="true"></i>&nbsp;&nbsp;Standby</button>
											<div class="modal text-start fade" id="modal-form-standby-<?php echo $line['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-md" role="document">
													<div class="modal-content">
														<div class="modal-body p-0">
															<div class="card card-plain">
																<div class="card-header pb-0 text-left">
																	<h3 class="font-weight-bolder text-info text-gradient">Standby</h3>
																</div>
																<div class="card-body">
																	<form role="form" method="post" action="<?php echo base_url(); ?>operation/standby_operation">
																		<input type="hidden" name="line_id" value="<?php echo $line['id']; ?>">
																		<input type="hidden" name="order_id" value="<?php echo $line['order_id']; ?>">
																		<input type="hidden" name="prev_status" value="<?php echo $line['status']; ?>">
																		<label>Remark</label>
																		<div class="input-group mb-3">
																			<select class="form-select" id="remark_id" name="remark_id">
																				<?php foreach ($remark_list as $list) : ?>
																					<?php if ($list['status'] == 'STANDBY') : ?>
																						<option value="<?php echo $list['id']; ?>"><?php echo $list['detail'] . ' (' . $list['remark_time'] . ' Seconds)'; ?></option>
																					<?php endif; ?>
																				<?php endforeach; ?>
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
											<button type="button" class="btn bg-gradient-secondary me-1 w-100" data-bs-toggle="modal" data-bs-target="#modal-form-breakdown-<?php echo $line['id']; ?>"><i class="fas fa-angle-double-down" aria-hidden="true"></i>&nbsp;&nbsp;Breakdown</button>
											<div class="modal text-start fade" id="modal-form-breakdown-<?php echo $line['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-md" role="document">
													<div class="modal-content">
														<div class="modal-body p-0">
															<div class="card card-plain">
																<div class="card-header pb-0 text-left">
																	<h3 class="font-weight-bolder text-info text-gradient">Are you sure want to breakdown this operation?</h3>
																</div>
																<div class="card-body">
																	<form role="form" method="post" action="<?php echo base_url(); ?>operation/breakdown_operation">
																		<input type="hidden" name="line_id" value="<?php echo $line['id']; ?>">
																		<input type="hidden" name="order_id" value="<?php echo $line['order_id']; ?>">
																		<input type="hidden" name="prev_status" value="<?php echo $line['status']; ?>">
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
											<hr>
											<button type="button" class="btn btn-danger me-1 w-100" data-bs-toggle="modal" data-bs-target="#modal-form-stop-<?php echo $line['id']; ?>"><i class="fas fa-stop" aria-hidden="true"></i>&nbsp;&nbsp;Stop</button>
											<div class="modal text-start fade" id="modal-form-stop-<?php echo $line['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-md" role="document">
													<div class="modal-content">
														<div class="modal-body p-0">
															<div class="card card-plain">
																<div class="card-header pb-0 text-left">
																	<h3 class="font-weight-bolder text-info text-gradient">Are you sure want to stop this operation?</h3>
																</div>
																<div class="card-body">
																	<form role="form" method="post" action="<?php echo base_url(); ?>operation/stop_operation">
																		<input type="hidden" name="line_id" value="<?php echo $line['id']; ?>">
																		<input type="hidden" name="order_id" value="<?php echo $line['order_id']; ?>">
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
											<div class="row mt-5">
												<p class="col-5 text-xl">NG Product</p>
												<p class="col-2 text-xl">:</p>
												<p class="col-5 text-xl">
													<span class="text-dark font-weight-bold" id='NG_<?php echo $line['id']; ?>' style="padding: 0; border: none; background: none;"></span>
												</p>
											</div>
											<div class="text-center">
												<div class="btn-group me-1 w-100">
													<button type="button" class="btn btn-primary" class="" onclick="double_minus_ng(<?php echo $line['id']; ?>)">&lt;&lt;</button>
													<button type="button" class="btn btn-primary" onclick="minus_ng(<?php echo $line['id']; ?>)" class="me-2"><i class="fas fa-minus"></i></button>
													<button type="button" class="btn btn-primary" onclick="plus_ng(<?php echo $line['id']; ?>)" class="ms-2"><i class="fas fa-plus"></i></button>
													<button type="button" class="btn btn-primary" onclick="double_plus_ng(<?php echo $line['id']; ?>)">&gt;&gt;</button>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
