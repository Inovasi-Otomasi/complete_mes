<div class="row mt-4 ">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card h-100">
			<div class="card-header pb-0 pt-3 bg-transparent row">
				<h3 class="text-capitalize col-9">Down Time Log</h3>
				<div class="col-3 d-flex justify-content-end">
				</div>
			</div>
			<div class="card-body">
				<form class="" role="form">
					<div class="mb-3 row g-3">
						<div class="col-sm-12 col-lg-2">
							<label for="datetimerange" class="col-form-label">Choose Range</label>
						</div>
						<div class="col-xs-auto col-lg-5">
							<input type="text" name="datetimerange" id="datetimerange" value="<?php echo $request['datetimerange']; ?>" class="form-control">
						</div>
						<div class="col-xs-auto col-lg-5">
							<button type="submit" value="Submit" name="apply" formmethod="post" formaction="<?php echo base_url(); ?>pages/breakdown_log" class="btn btn-primary">Apply</button>
						</div>
					</div>
				</form>
				<div class="table-responsive">
					<table id="log_list" class="display text-center" style="width:100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>Timestamp</th>
								<th>Batch Number</th>
								<th>Doc Number</th>
								<th>Line Name</th>
								<th>SKU Code</th>
								<th>Item Counter</th>
								<th>NG Count</th>
								<th>Status</th>
								<th>Delta Downtime</th>
								<th>PIC Operator</th>
								<th>Remark Operator</th>
								<th>Detail Operator</th>
								<th>PIC Engineer</th>
								<th>Remark Engineer</th>
								<th>Detail Engineer</th>
								<th>Location</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Timestamp</th>
								<th>Batch Number</th>
								<th>Doc Number</th>
								<th>Line Name</th>
								<th>SKU Code</th>
								<th>Item Counter</th>
								<th>NG Count</th>
								<th>Status</th>
								<th>Delta Downtime</th>
								<th>PIC Operator</th>
								<th>Remark Operator</th>
								<th>Detail Operator</th>
								<th>PIC Engineer</th>
								<th>Remark Engineer</th>
								<th>Detail Engineer</th>
								<th>Location</th>
								<th>Edit</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>