<?php 
  
  session_start();

$mysqli = new mysqli('localhost', 'root', 'Flipper07', 'crud') or die(mysqli_error($mysqli));

$update = FALSE;
$name = "";
$location = "";


if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name, location) VALUES ('$name','$location')") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id")or die($mysqli_error);

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = TRUE;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli_error);
    if (count($result)==1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}
?>