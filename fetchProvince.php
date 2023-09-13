<?php
require("./database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["region"])) {
    $selectedRegion = $_POST["region"];

    // Prepare a query to fetch provinces based on the selected region
    $sql = "SELECT DISTINCT tblprovince.province_m 
            FROM tblregion
            INNER JOIN tblprovince ON tblregion.region_c = tblprovince.region_c 
            INNER JOIN tblcitymun ON tblprovince.province_c = tblcitymun.province_c
            WHERE tblregion.abbreviation = ?";

    if ($stmt = mysqli_prepare($connection, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $selectedRegion);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $provinceName);

        while (mysqli_stmt_fetch($stmt)) {
            echo '<option value="' . $provinceName . '">' . $provinceName . '</option>';
        }

        mysqli_stmt_close($stmt);
    }
}
?>