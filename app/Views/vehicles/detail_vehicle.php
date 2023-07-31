<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h4 class="card-title"><?= $vehicle['vehicle_name']; ?> Vehicle detail information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order-2 order-md-1">
                            <div class="row">
                                <div class="col-5">
                                    <p class="card-text">Vehicle Name</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><b><?= $vehicle['vehicle_name']; ?></b></p>
                                </div>
                            </div>
                            <div class="row border-top">
                                <div class="col-5">
                                    <p class="card-text">Brand</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><b><?= $vehicle['brand_name']; ?></b></p>
                                </div>
                            </div>
                            <div class="row border-top">
                                <div class="col-5">
                                    <p class="card-text">Series</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><b><?= $vehicle['market_name']; ?> | <?= $vehicle['official_name']; ?></b></p>
                                </div>
                            </div>
                            <div class="row border-top">
                                <div class="col-5">
                                    <p class="card-text">Engine</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><b><?= $vehicle['engine_name']; ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="card-text ml-2">- Cylinder Configuration</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><?= $vehicle['cylinder_number']; ?> Cylinders | <?= $vehicle['cylinder_config_name']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="card-text ml-2">- Diameter (mm) x Stroke (mm)</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><?= $vehicle['cylinder_diameter']; ?> x <?= $vehicle['cylinder_stroke']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="card-text ml-2">- Total Cylinder Volume (cc)</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><?= $vehicle['total_cylinder_volume']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="card-text ml-2">- Max Power (PS/rpm)</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><?= $vehicle['power']; ?>/<?= $vehicle['power_rpm']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="card-text ml-2">- Max Torque (Kg.m/rpm)</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><?= $vehicle['torque']; ?>/<?= $vehicle['torque_rpm_low']; ?> - <?= $vehicle['torque_rpm_high']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="card-text ml-2">- Standard Emission</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><?= $vehicle['euro_name']; ?></p>
                                </div>
                            </div>
                            <div class="row border-top">
                                <div class="col-5">
                                    <p class="card-text">Axles & Tire</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><b><?= $vehicle['axle_code']; ?> | <?= $vehicle['tire_number']; ?> Tires</b></p>
                                </div>
                            </div>
                            <div class="row border-top">
                                <div class="col-5">
                                    <p class="card-text">Description</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><b><?= $vehicle['vehicle_description']; ?></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 order-1 order-md-2 mb-3">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img class="border" src="/assets/img/vehiclesimage/<?= $vehicle['vehicle_img']; ?>" width="200px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row d-flex justify-content-end" style="gap: 5px;">
                        <a href="/allvehicles" class="btn btn-success btn-sm">Back</a>
                        <a href="/editvehicle/<?= $vehicle['vehicle_slug']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/deletevehicle/<?= $vehicle['vehicle_slug']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" id="delete-vehicle" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>