<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="savebrand" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h4 class="card-title">Add New Brand</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group row">
                                    <label for="brand_name" class="col-sm-2 col-form-label">Brand Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="brand_name" id="brand_name" class="form-control <?= (!empty(validation_show_error('brand_name'))) ? 'is-invalid' : null; ?>" value="<?= old('brand_name'); ?>" autofocus>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('brand_name'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="brand_g_company" class="col-sm-2 col-form-label">Principal</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="brand_g_company" id="brand_g_company" class="form-control <?= (!empty(validation_show_error('brand_g_company'))) ? 'is-invalid' : null; ?>" value="<?= old('brand_g_company'); ?>">
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('brand_g_company'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="brand_i_company" class="col-sm-2 col-form-label">Local Company</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="brand_i_company" id="brand_i_company" class="form-control <?= (!empty(validation_show_error('brand_i_company'))) ? 'is-invalid' : null; ?>" value="<?= old('brand_i_company'); ?>">
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('brand_i_company'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="brand_logo" class="col-sm-2 col-form-label">Logo</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= (!empty(validation_show_error('brand_logo'))) ? 'is-invalid' : null; ?>" id="img_preview" name="brand_logo" onchange="previewImg()">
                                            <label class="custom-file-label" for="brand_logo">Choose file</label>
                                            <div class="invalid-feedback">
                                                <?= validation_show_error('brand_logo'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group row justify-content-center">
                                    <img src="/assets/img/default.jpg" class="img-thumbnail img-preview" style="max-height: 300px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row d-flex justify-content-end" style="gap: 5px;">
                            <a href="/allbrands" class="btn btn-warning btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>