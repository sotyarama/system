<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('message'); ?>"></div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h4 class="card-title">List of All Brands</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-8">

                        </div>
                        <div class="col-4">
                            <div class="row d-flex justify-content-end">
                                <a href="brandsXLSX" class="btn btn-primary btn-sm mr-1">Excel</a>
                                <a href="brandsPDF" class="btn btn-primary btn-sm mr-1" target="_blank">PDF</a>
                                <a href="addbrand" class="btn btn-primary btn-sm">Add Brand</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table id="tableAllBrands" class="table table-bordered table-stripped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Brand Logo</th>
                                        <th>Brand Name</th>
                                        <th>Principal</th>
                                        <th>Local Company</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($brands as $b) : ?>
                                        <tr>
                                            <td>
                                                <img src="assets/img/brandslogo/<?= $b->brand_logo; ?>" width="50px">
                                            </td>
                                            <td><?= $b->brand_name; ?></td>
                                            <td><?= $b->brand_g_company; ?></td>
                                            <td><?= $b->brand_i_company; ?></td>
                                            <td><a href="detailbrand/<?= $b->brand_slug; ?>" class="btn btn-block btn-primary btn-sm">Detail</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Brand Logo</th>
                                        <th>Brand Name</th>
                                        <th>Principal</th>
                                        <th>Local Company</th>
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