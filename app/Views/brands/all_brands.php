<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
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
                                <a href="#" class="btn btn-primary btn-sm">Add Vehicle</a>
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
                                        <th>Brand Slug</th>
                                        <th>Brand Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($brands as $b) : ?>
                                        <tr>
                                            <td><img class="imgpdf" src="data:image/png;base64,<?= base64_encode(file_get_contents('assets/img/brandslogo/' . $b->brand_logo)); ?>" alt="" width="100px"></td>
                                            <td><?= $b->brand_name; ?></td>
                                            <td><?= $b->brand_slug; ?></td>
                                            <td><a href="#" class="btn btn-block btn-primary btn-sm">Detail</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Brand Logo</th>
                                        <th>Brand Name</th>
                                        <th>Brand Slug</th>
                                        <th>Brand Action</th>
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