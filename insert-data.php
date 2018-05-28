<?php
require_once('init.php');

if(isset($_POST['contactname']) && $_POST['contactname'] != ''){
    $name = $_POST['contactname'];
    $primaryphone = $_POST['primaryphone'];
    $secondaryphone = $_POST['secondaryphone'];
    $mobphone = $_POST['mobphone'];

     $sql = "INSERT INTO users (name, primaryphone, secondaryphone, mobilephone) VALUES ('$name', '$primaryphone', '$secondaryphone', '$mobphone')";

    if (mysqli_query($conn, $sql))
    {
        header("Location: {$url}index.php?action=insert&status=ok");
        die();

    } else {
        header("Location: {$url}index.php?action=insert&status=err_db");
        die();
    }
} else {
    header("Location: {$url}index.php?action=insert&status=e_fields");
    die();
}

 ?>