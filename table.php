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

    <title>List</title>
    <style>
        li {
            list-style-type: none;
        }

        a {
            text-decoration: none;
        }

        select {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <section class="container-fluid m-0 p-0">
        <nav class="container-fluid d-flex justify-content-between p-3 pe-3 ps-3 bg-light">
            <h6 class="m-0">Drug Personality Monitoring System</h6>
            <ul class="d-flex m-0 gap-3">
                <li><a href="./index.php">Data Entry</a></li>
                <li><a href="./table.php">Report</a></li>
            </ul>
        </nav>
        <section class="container pt-5">
            <input class="form-control" type="text" id="liveSearch" autocomplete="off" placeholder="Search....">

            <div id="searchResult">

            </div>
        </section>

    </section>

    <section class="container p-5">
        <h2> Total Number of Encoded Personal Information by Status</h2>
        <table class="table m-auto">
            <thead>
                <tr>
                    <th>STATUS</th>
                    <th>TOTAL</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($results = mysqli_fetch_array($sqlStatus)) { ?>
                    <tr>
                        <td>
                            <?= $results['status'] ?>
                        </td>
                        <td>
                            <?= $results['total'] ?>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>

        </table>
    </section>

    <section class="container p-5">
        <h2> Ratio per status against population</h2>
        <table class="table m-auto">
            <thead>
                <tr class="table-primary">
                    <th>Status</th>
                    <th>Total count</th>
                    <th>Population</th>
                    <th>Ratio</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($results = mysqli_fetch_array($sqlPopulation)) { ?>
                    <tr class="table-light">
                        <td>
                            <?= $results['status'] ?>
                        </td>
                        <td>
                            <?= $results['TotalCount'] ?>
                        </td>
                        <td>
                            <?= $results['population'] ?>
                        </td>
                        <td>
                            <?= $results['Ratio'] ?>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>

        </table>
    </section>

    <section class="container p-5">
        <h2> Disaggregate by age bracket </h2>
        <table class="table m-auto">
            <thead>
                <tr class="table-primary">
                    <th>AgeBracket</th>
                    <th>Total count</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($results = mysqli_fetch_array($sqlAge)) { ?>
                    <tr class="table-light">
                        <td>
                            <?= $results['AgeBracket'] ?>
                        </td>
                        <td>
                            <?= $results['TotalCount'] ?>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>

        </table>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            fetchData();

            // Event handler for name, bdate, region, and etc.. select change
            $('#liveSearch').keyup(function () {
                fetchData();
            });

            function fetchData() {
                var input = $('#liveSearch').val();
                $.ajax({
                    url: 'searchResult.php',
                    type: 'POST',
                    data: { input: input },
                    success: function (data) {
                        $('#searchResult').html(data);
                    },
                    error: function () {
                        alert('Error fetching data.');
                    }
                });
            }
        });

    </script>
</body>

</html>