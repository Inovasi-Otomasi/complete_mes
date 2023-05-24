<div>
	<button type="button" class="btn m-0 p-0" style="background-color: transparent;border-color: transparent;box-shadow: none;" data-bs-toggle="modal" data-bs-target="#modal-form-<?php echo $id; ?>"><i class="fas fa-edit"></i></button>
	<div class="modal fade" id="modal-form-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="card card-plain">
						<div class="card-header pb-0 text-left">
							<h3 class="font-weight-bolder text-info text-gradient">Edit Log</h3>
						</div>
						<div class="card-body text-start">
							<form role="form" method="post" action="<?php echo base_url(); ?>ajax/edit_log">
								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<label>PIC</label>
								<div class="input-group mb-3 row">
									<select id="pic_name-<?php echo $id; ?>" name="pic_name">
										<?php foreach ($pic_list as $pic) : ?>
											<option value="<?php echo $pic['pic_name']; ?>" <?php if ($pic_name == $pic['pic_name']) echo "selected"; ?>><?php echo $pic['pic_name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<label>Remark</label>
								<div class="input-group mb-3 row">
									<select id="remark-<?php echo $id; ?>" name="remark">
										<?php foreach ($remark_list as $list) : ?>
											<?php if ($list['status'] == 'DOWN TIME') : ?>
												<option value="<?php echo $list['detail']; ?>" <?php if ($remark == $list['detail']) echo "selected"; ?>><?php echo $list['detail']; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
								</div>

								<label>Detail</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="Detail" name="detail" value="<?php echo $detail; ?>" required>
								</div>
								<label>PIC 2</label>
								<div class="input-group mb-3 row">
									<select id="pic_name_2-<?php echo $id; ?>" name="pic_name_2">
										<?php foreach ($pic_list as $pic) : ?>
											<option value="<?php echo $pic['pic_name']; ?>" <?php if ($pic_name == $pic['pic_name']) echo "selected"; ?>><?php echo $pic['pic_name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<label>Remark 2</label>
								<div class="input-group mb-3 row">
									<select id="remark_2-<?php echo $id; ?>" name="remark_2">
										<?php foreach ($remark_list as $list) : ?>
											<?php if ($list['status'] == 'DOWN TIME') : ?>
												<option value="<?php echo $list['detail']; ?>" <?php if ($remark == $list['detail']) echo "selected"; ?>><?php echo $list['detail']; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
								</div>
								<script>
									$('#pic_name-<?php echo $id; ?>').selectize({});
									$('#remark-<?php echo $id; ?>').selectize({});
									$('#pic_name_2-<?php echo $id; ?>').selectize({});
									$('#remark_2-<?php echo $id; ?>').selectize({});
								</script>
								<label>Detail 2</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="Detail 2" name="detail_2" value="<?php echo $detail_2; ?>" required>
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