<!DOCTYPE html>
<html lang="en">

<head>
    <title>CodingHax</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("dist/images/logo.png") ?>" />
    <link href=" <?php echo base_url("public/dist/css/style.css") ?>" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <section class="spacer">
        <div class="container">
            <p class="fs-7 text-center py-3">
                Dynamic Dependent dropdown in CodeIgniter 4
                <a href="#code8" class="ms-2 text-danger code-btn8"><i class="fa fa-code"></i></a>
            </p>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Action Cards 1 Start -->
                    <div class="card shadow-out mb-5">
                        <div class="card-body p-5">
                            <div class="col-12 fs-4 mb-3">
                                <select name="" class="fw-lighter form-select border-1 border-dark rounded" onchange="fetchStateData(this.value)">
                                    <option value="">Select Country</option>
                                    <?php foreach ($country as $row) { ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                            <div class="col-12 fs-4 mb-3">
                                <select name="" class="fw-lighter form-select border-1 border-dark rounded" id="stateID" onchange="fetchCityData(this.value)">
                                    <option value="">Select State</option>
                                </select>
                            </div>
                            <div class="col-12 fs-4 mb-3">
                                <select name="" class="fw-lighter form-select border-1 border-dark rounded" id="cityId">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                            <div class="row align-items-center justify-content-start">
                                <div class="col-lg-6">
                                    <div class="text-center text-md-start my-3">
                                        <a href="javascript:void(0)" class="btn btn-lg shadow-out-hover">
                                            <i class="fas fa-headphones me-2"></i> Submit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function fetchStateData(countryId) {
            $.ajax({
                url: "<?php echo site_url("state") ?>",
                method: "POST",
                data: {
                    cId: countryId
                },
                success: function(result) {
                    let data = JSON.parse(result);

                    let output = "<option>select state</option>";
                    for (let row in data) {
                        output += `<option value="${data[row].id}">${data[row].name}</option>`;
                        // console.log(data[row].id);
                        // console.log(data[row].name);
                    }
                    document.querySelector("#stateID").innerHTML = output;
                    // console.log(result);
                }
            });
        }

        function fetchCityData(stateID) {
            $.ajax({
                url: "<?php echo site_url("city") ?>",
                method: "POST",
                data: {
                    sId: stateID
                },
                success: function(result) {
                    let data = JSON.parse(result);

                    // let output = "<option>select city</option>";
                    // for (let row in data) {
                    //     output += `<option value="${data[row].id}">${data[row].name}</option>`;
                    //     console.log(data[row].id);
                    //     console.log(data[row].name);
                    // }
                    // document.querySelector("#cityId").innerHTML = output;
                    document.querySelector("#cityId").innerHTML = data;
                    // console.log(result);
                }
            });
        }
    </script>




    <script src="<?php echo base_url("public/dist/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?php echo base_url("public/dist/js/custom.js") ?>"></script>
</body>

</html>