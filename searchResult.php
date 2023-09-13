<?php
require("./database.php");

if (isset($_POST['input'])) {
    $input = $_POST['input'];

    // Check if the input is empty
    if (empty($input)) {
        // If input is empty, retrieve all data
        $querySearch = "SELECT *, CONCAT(first_name, ' ', middle_name, ' ', last_name) as fullname 
                        FROM personal_information";
    } else {
        // If input is not empty, perform the search
        $querySearch = "SELECT *, CONCAT(first_name, ' ', middle_name, ' ', last_name) as fullname 
                        FROM personal_information 
                        WHERE birthdate LIKE '%$input%' OR first_name LIKE '%$input%' OR last_name LIKE '%$input%'";
    }

    $querySearch = mysqli_query($connection, $querySearch);

    if (mysqli_num_rows($querySearch)) { ?>
        <table class="table mt-5">
            <thead>
                <tr class="table-dark">
                    <th>#</th>
                    <th>Full name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Adddress</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Region</th>
                    <th>Province</th>
                    <th>City</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($results = mysqli_fetch_assoc($querySearch)) { ?>
                    <tr class="table-light">
                        <th scope="row">
                            <?= $results['id'] ?>
                        </th>
                        <td>
                            <?= $results['fullname'] ?>
                        </td>
                        <td>
                            <?= $results['age'] ?>
                        </td>
                        <td>
                            <?= $results['sex'] ?>
                        </td>
                        <td>
                            <?= $results['address'] ?>
                        </td>
                        <td>
                            <?= $results['contact'] ?>
                        </td>
                        <td>
                            <?= $results['status'] ?>
                        </td>
                        <td>
                            <?= $results['region'] ?>
                        </td>
                        <td>
                            <?= $results['province'] ?>
                        </td>
                        <td>
                            <?= $results['city'] ?>
                        </td>
                        <td class="d-flex justify-content-evenly">
                            <form action="./delete.php" method="post">
                                <input type="hidden" name="deleteID" value="<?= $results['id'] ?>">
                                <input type="submit" class="btn btn-danger" name="delete" value="DELETE">
                            </form>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
        <?php

    } else {
        echo "<h6 class='text-danger'> No data fount </h6>";
    }

}
?>