<?php
require("./database.php");
// retrieved all data 
$queryRegion = "SELECT * FROM tblregion INNER JOIN tblprovince ON tblregion.region_c = tblprovince.region_c 
INNER JOIN tblcitymun ON tblprovince.province_c = tblcitymun.province_c";
$sqlRegion = mysqli_query($connection, $queryRegion);

// Total number of encoded personal information by status
$queryStatus = "SELECT status, count(*) as total FROM personal_information GROUP BY status";
$sqlStatus = mysqli_query($connection, $queryStatus);


// Ratio per status against population

$queryPopulation = "SELECT
personal_information.status,
COUNT(*) AS TotalCount,
lgu_information.population,
CASE
    WHEN lgu_information.population > 0 THEN COUNT(*) / lgu_information.population
    ELSE 0
END AS Ratio
FROM
personal_information
JOIN
lgu_information
ON
personal_information.lgu_id = lgu_information.lgu_id
GROUP BY
personal_information.status, lgu_information.population
";
$sqlPopulation = mysqli_query($connection, $queryPopulation);




// Disaggregate by age bracket 
$queryAge = "SELECT
CASE
    WHEN Age BETWEEN 0 AND 12 THEN '0-12'
    WHEN Age BETWEEN 13 AND 18 THEN '13-18'
    WHEN Age BETWEEN 19 AND 25 THEN '19-25'
    WHEN Age BETWEEN 26 AND 35 THEN '26-35'
    WHEN Age BETWEEN 36 AND 50 THEN '36-50'
    WHEN Age BETWEEN 51 AND 65 THEN '51-65'
    ELSE '65 and above'
END AS AgeBracket,
COUNT(*) AS TotalCount
FROM
personal_information
GROUP BY
AgeBracket;
";
$sqlAge = mysqli_query($connection, $queryAge);
?>