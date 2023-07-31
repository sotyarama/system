<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="/updatevehicle/<?= $vehicle['vehicle_slug']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_vehicle" value="<?= $vehicle['id_vehicle']; ?>">
                <input type="hidden" name="vehicle_slug" value="<?= $vehicle['vehicle_slug']; ?>">
                <input type="hidden" name="old_vehicle_image" value="<?= $vehicle['vehicle_img']; ?>">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h4 class="card-title">Edit <?= $vehicle['vehicle_name']; ?> Vehicle</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row mx-1">
                                    <label for="vehicle_image">Vehicle Image</label>
                                </div>
                                <div class="form-group row justify-content-center mx-1">
                                    <div class="col">
                                        <img src="/assets/img/vehiclesimage/<?= $vehicle['vehicle_img']; ?>" class="img-thumbnail img-preview" style="max-height: 300px">
                                    </div>
                                </div>
                                <div class="form-group row mx-1">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= (!empty(validation_show_error('vehicle_image'))) ? 'is-invalid' : null; ?>" id="img_preview" name="vehicle_image" onchange="previewImg()">
                                        <label class="custom-file-label" for="vehicle_image"><?= $vehicle['vehicle_img']; ?></label>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('vehicle_image'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 border-left border-right">
                                <div class="form-group row mx-1">
                                    <label for="vehicle_name">Vehicle Name</label>
                                    <input type="text" name="vehicle_name" id="vehicle_name" class="form-control <?= (!empty(validation_show_error('vehicle_name'))) ? 'is-invalid' : null; ?>" value="<?= old('vehicle_name') ? old('vehicle_name') : $vehicle['vehicle_name']; ?>" autofocus>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('vehicle_name'); ?>
                                    </div>
                                </div>
                                <div class="form-group row mx-1">
                                    <label for="vehicle_description">Vehicle Description</label>
                                    <textarea name="vehicle_description" id="vehicle_description" class="form-control" rows="3"><?= old('vehicle_description') ? old('vehicle_description') : $vehicle['vehicle_description']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row mx-1">
                                    <label for="brand_id">Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-control select2bs2 <?= (!empty(validation_show_error('brand_id'))) ? 'is-invalid' : null; ?>" value="<?= old('brand_id'); ?>" style="width: 100%" onchange="brandIdChanged(this.value)">
                                        <?php if (isset($vehicle['brand_name'])) : ?>
                                            <option value="<?= $vehicle['brand_id']; ?>" selected><?= $vehicle['brand_name']; ?></option>
                                            <option value="" disabled> ------------------- </option>
                                        <?php else : ?>
                                            <option selected disabled>Choose Brand</option>
                                        <?php endif; ?>
                                        <?php foreach ($brands as $b) : ?>
                                            <option value="<?= $b->id_brand; ?>" <?php if ($b->id_brand == old('brand_id')) echo "selected = 'selected'" ?>><?= $b->brand_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('brand_id'); ?>
                                    </div>
                                </div>
                                <div class="form-group row mx-1">
                                    <label for="series_id">Series</label>
                                    <select name="series_id" id="series_id" class="form-control select2bs2 <?= (!empty(validation_show_error('series_id'))) ? 'is-invalid' : null; ?>" value="<?= old('series_id'); ?>" style="width: 100%">
                                        <?php if (isset($vehicle['market_name'])) : ?>
                                            <option data-toggle="tooltip" data-placement="top" title="Please re-select brand to change series" value="<?= $vehicle['series_id']; ?>" selected><?= $vehicle['market_name']; ?> | <?= $vehicle['official_name']; ?></option>
                                        <?php else : ?>
                                            <option selected disabled>Choose Series</option>
                                        <?php endif; ?>
                                        <?php foreach ($series as $s) : ?>
                                            <?php if ($s->id_series == old('series_id')) : ?>
                                                <option value="<?= $s->id_series; ?>" selected><?= $s->market_name; ?> | <?= $s->official_name ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('series_id'); ?>
                                    </div>
                                </div>
                                <div class="form-group row mx-1">
                                    <label for="engine_id">Engine</label>
                                    <select name="engine_id" id="engine_id" class="form-control select2bs2 <?= (!empty(validation_show_error('engine_id'))) ? 'is-invalid' : null; ?>" value="<?= old('engine_id'); ?>" style="width: 100%">
                                        <?php if (isset($vehicle['engine_name'])) : ?>
                                            <option data-toggle="tooltip" data-placement="top" title="Please re-select brand to change engine" value="<?= $vehicle['engine_id']; ?>" selected><?= $vehicle['engine_name']; ?></option>
                                        <?php else : ?>
                                            <option selected disabled>Choose Engine</option>
                                        <?php endif; ?>
                                        <?php foreach ($engines as $eng) : ?>
                                            <?php if ($eng->id_engine == old('engine_id')) : ?>
                                                <option value="<?= $eng->id_engine; ?>" selected><?= $eng->engine_name; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('engine_id'); ?>
                                    </div>
                                </div>
                                <div class="form-group row mx-1">
                                    <label for="axle_id">Axles Configuration</label>
                                    <select name="axle_id" id="axle_id" class="form-control select2bs2 <?= (!empty(validation_show_error('axle_id'))) ? 'is-invalid' : null; ?>" value="<?= old('axle_id'); ?>" style="width: 100%">
                                        <?php if (isset($vehicle['axle_code'])) : ?>
                                            <option value="<?= $vehicle['id_axle']; ?>" selected><?= $vehicle['axle_code']; ?></option>
                                            <option value="" disabled> ------------------- </option>
                                        <?php else : ?>
                                            <option selected disabled>Choose Axles Configuration</option>
                                        <?php endif; ?>
                                        <?php foreach ($axles as $a) : ?>
                                            <option value="<?= $a->id_axle; ?>" <?php if ($a->id_axle == old('axle_id')) echo "selected = 'selected'" ?>><?= $a->axle_code; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('axle_id'); ?>
                                    </div>
                                </div>
                                <div class="form-group row mx-1">
                                    <label for="tire_id">Number of Tires</label>
                                    <select name="tire_id" id="tire_id" class="form-control select2bs2 <?= (!empty(validation_show_error('tire_id'))) ? 'is-invalid' : null; ?>" value="<?= old('tire_id'); ?>" style="width: 100%">
                                        <?php if (isset($vehicle['tire_number'])) : ?>
                                            <option value="<?= $vehicle['id_tire']; ?>" selected><?= $vehicle['tire_number']; ?></option>
                                            <option value="" disabled> ------------------- </option>
                                        <?php else : ?>
                                            <option selected disabled>Choose Number of Tires</option>
                                        <?php endif; ?>
                                        <?php foreach ($tires as $t) : ?>
                                            <option value="<?= $t->id_tire; ?>" <?php if ($t->id_tire == old('tire_id')) echo "selected = 'selected'" ?>><?= $t->tire_number; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('tire_id'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row d-flex justify-content-end" style="gap: 5px;">
                            <a href="/allvehicles" class="btn btn-warning btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>