<div class="row mt-4 ">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card h-100">
			<div class="card-header pb-0 pt-3 bg-transparent">
				<h3 class="text-capitalize">Reporting</h3>
			</div>
			<div class="card-body m-2 table-responsive">
				<form role="form">
					<div class="mb-3 row g-3 align-items-center">
						<div class="col-sm-12 col-lg-2">
							<label for="datetimerange" class="col-form-label">Choose Range</label>
						</div>
						<div class="col-xs-auto col-lg-5">
							<input type="text" name="datetimerange" id="datetimerange" value="<?php echo $request['datetimerange']; ?>" class="form-control">
						</div>
					</div>
					<div class="mb-3 row g-3 align-items-center">
						<div class="col-sm-12 col-lg-2">
							<label for="line_name" class="col-form-label">Line</label>
						</div>
						<div class="col-xs-auto col-lg-2">
							<select class="selectize" aria-label="Default select example" name="line" id="line_name" placeholder="Pick a line..." required>
								<option value="">Select a line...</option>
								<option value='All' <?php if ($request['line_name'] == 'All') : ?>selected<?php endif; ?>>All</option>
								<?php foreach ($lines as $line) : ?>
									<option value="<?php echo $line['line_name'] ?>" <?php if ($request['line_name'] == $line['line_name']) : ?>selected<?php endif; ?>><?php echo $line['line_name'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="mb-3 row g-3 align-items-center">
						<div class="col-sm-12 col-lg-2">
							<label for="sku_code" class="col-form-label">SKU</label>
						</div>
						<div class="col-xs-auto col-lg-2">
							<select class="selectize" aria-label="Default select example" name="sku" id="sku_code" placeholder="Pick SKU..." required>
								<option value="">Select SKU...</option>
								<option value='All' <?php if ($request['sku_code'] == 'All') : ?>selected<?php endif; ?>>All</option>
								<?php foreach ($sku_code as $sku) : ?>
									<option value="<?php echo $sku['sku_code'] ?>" <?php if ($request['sku_code'] == $sku['sku_code']) : ?>selected<?php endif; ?>><?php echo $sku['sku_code'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<button type="submit" value="Submit" name="apply" formmethod="post" formaction="<?php echo base_url(); ?>pages/reporting" class="btn btn-primary">Apply</button>
					<button type="submit" value="Submit" name="export" formmethod="post" formaction="<?php echo base_url(); ?>ajax/export" formtarget="_blank" class="btn btn-success">Export</button>
				</form>
				<div class="row my-5">
					<div class="row col">
						<div class="col-12 mb-0">
							<div class="numbers">
								<p class="text-sm mb-0 text-uppercase font-weight-bold text-center">OEE</p>
							</div>
						</div>
						<div class="col-12">
							<div class="GaugeMeter start-50 top-50 translate-middle" data-percent="<?php echo (int)(($summary['avg(performance_24h)'] + $summary['avg(availability_24h)']  + $summary['avg(quality_24h)']) / 3); ?>" data-text="<?php echo round(($summary['avg(performance_24h)'] + $summary['avg(availability_24h)'] + $summary['avg(quality_24h)']) / 3, 1); ?>" data-animationstep="0" data-size="150" data-append="%" data-width="15" data-text_size="0.18"></div>
						</div>
					</div>
					<div class="row col">
						<div class="col-12 mb-0">
							<div class="numbers">
								<p class="text-sm mb-0 text-uppercase font-weight-bold text-center">Performance</p>
							</div>
						</div>
						<div class="col-12">
							<div class="GaugeMeter start-50 top-50 translate-middle" data-percent="<?php echo (int)$summary['avg(performance_24h)'] ?: 0; ?>" data-text="<?php echo round($summary['avg(performance_24h)'] ?: 0, 1) ?: 0; ?>" data-animationstep="0" data-size="150" data-append="%" data-width="15" data-text_size="0.18"></div>
						</div>
					</div>
					<div class="row col">
						<div class="col-12 mb-0">
							<div class="numbers">
								<p class="text-sm mb-0 text-uppercase font-weight-bold text-center">Availability</p>
							</div>
						</div>
						<div class="col-12">
							<div class="GaugeMeter start-50 top-50 translate-middle" data-percent="<?php echo (int)$summary['avg(availability_24h)'] ?: 0; ?>" data-text="<?php echo round($summary['avg(availability_24h)'] ?: 0, 1) ?: 0; ?>" data-animationstep="0" data-size="150" data-append="%" data-width="15" data-text_size="0.18"></div>
						</div>
					</div>
					<div class="row col">
						<div class="col-12 mb-0">
							<div class="numbers">
								<p class="text-sm mb-0 text-uppercase font-weight-bold text-center">Quality</p>
							</div>
						</div>
						<div class="col-12">
							<div class="GaugeMeter start-50 top-50 translate-middle" data-percent="<?php echo (int)$summary['avg(quality_24h)'] ?: 0; ?>" data-text="<?php echo round($summary['avg(quality_24h)'] ?: 0, 1) ?: 0; ?>" data-animationstep="0" data-size="150" data-append="%" data-width="15" data-text_size="0.18"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<?php foreach ($line_list as $line) : ?>
						<div class="col-lg-6 my-2">
							<h5><?php echo $line['line_name']; ?></h5>
							<div id="chart-<?php echo $line['id']; ?>" style="width: 100%; min-height: 300px"></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>