<div class="row mt-4 ">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h3 class="text-capitalize">Export Data</h3>
            </div>
            <div class="card-body m-3 table-responsive">
                <form class="" role="form" method="post" id="export_form" action="">
                    <div class="mb-3 row g-3 align-items-center">
                        <div class="col-sm-12 col-lg-2">
                            <label for="datetimerange" class="col-form-label">Choose Range</label>
                        </div>
                        <div class="col-xs-auto col-lg-5">
                            <input type="text" name="datetimerange" id="datetimerange" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row g-3 align-items-center">
                        <div class="col-sm-12 col-lg-2">
                            <label for="pic" class="col-form-label">Line</label>
                        </div>
                        <div class="col-xs-auto col-lg-2">
                            <select class="form-select" aria-label="Default select example" name="line" id="line_name">
                                <option value='All' selected='selected'>All</option>
                                <?php foreach ($lines as $line) : ?>
                                    <option value="<?php echo $line['line_name'] ?>"><?php echo $line['line_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" value="Submit" class="btn btn-success">Export</button>
                </form>
            </div>
        </div>
    </div>
</div>