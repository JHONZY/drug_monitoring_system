<?php
require("./database.php");

if (isset($_POST["create"])) { // inserting data into table personal_information
    $lguId = $_POST['lguId'];
    $fname = $_POST['Fname'];
    $mname = $_POST['Mname'];
    $lname = $_POST['Lname'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $bdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $status = $_POST['status'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];

    $queryCreate = "INSERT INTO personal_information VALUES (null,'$lguId', '$fname', '$mname', '$lname', '$age', '$sex', '$bdate', '$address', '$contact', '$status', '$region', '$province', '$city', NOW(), NOW())";
    $sqlCreate = mysqli_query($connection, $queryCreate);

    // Check if the insertion was successful
    if ($sqlCreate) {
        // Add the update for the population column in the lgu_information table
        $queryUpdatePopulation = "UPDATE lgu_information
                                    SET lgu_information.population = (
                                     SELECT COUNT(*)
                                     FROM personal_information
                                     WHERE personal_information.lgu_id = lgu_information.lgu_id
                                 )";
        $sqlUpdatePopulation = mysqli_query($connection, $queryUpdatePopulation);

        if ($sqlUpdatePopulation) {
            echo '<script>alert("Successfully created and updated population!")</script>';
        } else {
            echo '<script>alert("Successfully created, but failed to update population.")</script>';
        }
    } else {
        echo '<script>alert("Failed to create.")</script>';
    }

    echo '<script>window.location.href = "/exam/index.php"</script>';
} else {
    echo '<script>window.location.href = "/exam/index.php"</script>';
}
?>