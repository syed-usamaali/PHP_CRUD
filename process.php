<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud_php') or die(mysqli_error($mysqli));

$id = 0;
$name = '';
$location = '';
$update = false;

if (isset($_POST['save'])) {
    $name = $mysqli->real_escape_string($_POST['name']);
    $location = $mysqli->real_escape_string($_POST['location']);

    if ($name === '' || $location === '') {
        $_SESSION['message'] = "All fields are required!";
        $_SESSION['msg_type'] = "warning";
        header('location: index.php');
    } else {
        $mysqli->query("INSERT INTO data(name, location) VALUES ('$name', '$location')") or die($mysqli->error);
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header('location: index.php');
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE from data Where id = '$id' ") or die($mysqli->error);
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header('location: index.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM data WHERE id='$id' ") or die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
        $update = true;
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $result = $mysqli->query("Update data SET name = '$name',location = '$location' WHERE id = '$id' ") or die($mysqli->error);
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "success";
    header('location: index.php');
}
