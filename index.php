<?php
require("./read.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Drug Personality Monitoring System</title>
    <style>
        .form-add {
            margin: 20px auto;
            max-width: 800px;
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            align-items: center;
        }

        input[type="submit"] {
            order: 2;
        }

        input {
            max-width: 310px;
            width: 100%;
            margin-bottom: 1rem;
        }

        input[type="number"] {
            max-width: 100px;
            width: 100%;
        }

        #sex {
            max-width: 195px;
            width: 100%;
            margin: 0 0 16px;
            cursor: pointer;
        }

        select {
            margin: 0 0 16px;
        }

        #region,
        #province,
        #city,
        #status {
            max-width: 310px;
            width: 100%;
            cursor: pointer;
        }

        #bdaten,
        input[type="date"] {
            cursor: pointer;
            width: 310px;
        }

        li {
            list-style-type: none;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main class="container_fluid">
        <nav class="container-fluid d-flex justify-content-between p-3 pe-3 ps-3 bg-light">
            <h6 class="m-0">Drug Personality Monitoring System</h6>
            <ul class="d-flex m-0 gap-3">
                <li><a href="./index.php">Data Entry</a></li>
                <li><a href="./table.php">Report</a></li>
            </ul>
        </nav>
        <section class="container p-5">
            <h2 class="text-center">Data Entry</h2>
            <form action="./create.php" method="post" class="form-add">
                <div class="left_form">
                    <label for="lguId">LGU ID
                        <input class="form-control" type="number" name="lguId" min="1" max="2" value=0>
                    </label>
                    <input class="form-control" type="text" name="Fname" placeholder="First name" required>
                    <input class="form-control" type="text" name="Mname" placeholder="Middle name" required>
                    <input class="form-control" type="text" name="Lname" placeholder="Last name" required>
                    <div class="d-flex gap-3">
                        <input class="form-control" type="number" min="1" max="69" name="age" placeholder="Age"
                            required>
                        <select class="form-control" name="sex" id="sex">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Prefer not to say">Prefer not to say</option>
                        </select>
                    </div>

                    <label for="birthdate" id="bdate">Birthdate:
                        <input class="form-control " type="date" name="birthdate">
                    </label>
                </div>
                <div class="right_form">
                    <input class="form-control" type="text" name="address" placeholder="Address" required>
                    <input class="form-control" type="text" name="contact" placeholder="Contact" required>
                    <select class="form-control" name="status" id="status">
                        <option value="Under Investigation">Under Investigation</option>
                        <option value="Surrendered">Surrendered</option>
                        <option value="Apprehended">Apprehended</option>
                        <option value="Escaped">Escaped</option>
                        <option value="Deceased">Deceased</option>
                    </select>

                    <select class="form-control" name="region" id="region">
                        <?php
                        while ($region = mysqli_fetch_array($sqlRegion)) { ?>
                            <option value="<?= $region['abbreviation'] ?>"><?= $region['abbreviation'] ?></option>
                        <?php }
                        ?>
                    </select>


                    <select class="form-control" name="province" id="province">

                    </select>

                    <select class="form-control" name="city" id="city">

                    </select>
                </div>
                <input class="btn btn-success" type="submit" name="create" value="Submit">
            </form>
        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Fetch province options for the initially selected region
            fetchProvinces();

            // Event handler for region select change
            $('#region').on('change', function () {
                fetchProvinces();
            });

            function fetchProvinces() {
                var selectedRegion = $('#region').val();
                // alert(selectedRegion);
                if (selectedRegion !== '') {
                    $.ajax({
                        url: 'fetchProvince.php', // Change this to the URL of your server-side script
                        type: 'POST',
                        data: { region: selectedRegion },
                        success: function (data) {
                            $('#province').html(data);
                        },
                        error: function () {
                            alert('Error fetching provinces.');
                        }
                    });
                } else {
                    // Clear the province select if no region is selected
                    $('#province').css('display', 'none');
                }
            }
        });

        $(document).ready(function () {
            // Fetch city options for the initially selected region
            fetchCity();

            // Event handler for region select change
            $('#region').on('change', function () {
                fetchCity();
            });

            function fetchCity() {
                var selectedRegion = $('#region').val();
                // alert(selectedRegion);
                if (selectedRegion !== '') {
                    $.ajax({
                        url: 'fetchCity.php',
                        type: 'POST',
                        data: { region: selectedRegion },
                        success: function (data) {
                            $('#city').html(data);
                        },
                        error: function () {
                            alert('Error fetching provinces.');
                        }
                    });
                } else {
                    // Clear the city select if no region is selected
                    $('#city').css('display', 'none');
                }
            }
        });
    </script>
</body>

</html>