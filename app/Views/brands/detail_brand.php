<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h4 class="card-title"><?= $brand['brand_name']; ?> brand detail information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-3">
                                    <p class="card-text">Brand Name</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><b><?= $brand['brand_name']; ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p class="card-text">Principal</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><b><?= $brand['brand_g_company']; ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p class="card-text">Local Company</p>
                                </div>
                                <div class="col-1">
                                    <p class="card-text">:</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><b><?= $brand['brand_i_company']; ?></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">Brand Logo :</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img class="border" src="data:image/png;base64,<?= base64_encode(file_get_contents('assets/img/brandslogo/' . $brand['brand_logo'])); ?>" alt="" width="200px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row d-flex justify-content-end" style="gap: 5px;">
                        <a href="/allbrands" class="btn btn-success btn-sm">Back</a>
                        <a href="/editbrand/<?= $brand['brand_slug']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/deletebrand/<?= $brand['brand_slug']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" id="delete-brand" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>