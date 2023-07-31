<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('message'); ?>"></div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h4 class="card-title">List of All Vehicles</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-8">

                        </div>
                        <div class="col-4">
                            <div class="row d-flex justify-content-end">
                                <!-- <a href="vehiclesXLSX" class="btn btn-primary btn-sm mr-1">Excel</a>
                                <a href="vehiclesPDF" class="btn btn-primary btn-sm mr-1" target="_blank">PDF</a> -->
                                <a href="addvehicle" class="btn btn-primary btn-sm">Add Vehicle</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table id="tableAll" class="table table-bordered table-stripped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Vehicle Image</th>
                                        <th>Vehicle Name</th>
                                        <th>Vehicle Brand</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vehicles as $v) : ?>
                                        <tr>
                                            <td>
                                                <img src="assets/img/vehiclesimage/<?= $v->vehicle_img; ?>" height="100px">
                                            </td>
                                            <td><?= $v->vehicle_name; ?></td>
                                            <td><?= $v->brand_id; ?></td>
                                            <td><a href="detailvehicle/<?= $v->vehicle_slug; ?>" class="btn btn-block btn-success btn-sm">Detail</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Vehicle Image</th>
                                        <th>Vehicle Name</th>
                                        <th>Vehicle Brand</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>