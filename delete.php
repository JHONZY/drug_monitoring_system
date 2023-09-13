<?php
require("./database.php");
if (isset($_POST['delete'])) { // delete all where id equl to selected ID
    $deleteId = $_POST['deleteID'];

    $queryDelete = "DELETE FROM personal_information WHERE id = $deleteId";
    $queryDelete = mysqli_query($connection, $queryDelete);

    echo '<script>window.location.href = "/exam/table.php"</script>';
} else {
    echo '<script>window.location.href = "/exam/table.php"</script>';
}
?>