<?php

session_start();

$db = mysqli_connect('127.0.0.1','root','','crud') or die(mysqli_connect_error());

$email = "";
$name = "";
$phone == "";
$edit = false;
$id = "";


if (isset($_POST['insert'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    if (!empty($email) and !empty($name) and !empty($phone)) {
        $insert = mysqli_query($db, "INSERT INTO customers (email, name, phone) VALUES ('$email','$name','$phone')");
        
        if (!$insert) {
            $_SESSION['error'] = mysqli_error($db);

        } else {
            $_SESSION['message'] = "Successfully insert a record";
            $_SESSION['alert'] = "success";
        }
    } else {
        $_SESSION['error'] = "Please input all contents";
        
    }
    header("location: index.php");
    
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($db, "DELETE FROM customers WHERE id='$id'") or die(mysqli_error($db));
    if ($delete) {
        $_SESSION['message'] = "Successfully delete a record";
        $_SESSION['alert'] = "danger";
        header("location: index.php");
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = true;
    $result = mysqli_query($db, "SELECT * FROM customers WHERE id='$id'") or die(mysqli_error($db));
    if ($row = mysqli_fetch_assoc($result)) {
        $email = $row['email'];
        $name = $row['name'];
        $phone = $row['phone'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $update = mysqli_query($db, "UPDATE customers SET email='$email',name='$name',phone='$phone' WHERE id='$id'");
    if ($update) {
        $_SESSION['message'] = "Successfully update a record";
        $_SESSION['alert'] = "warning";
        
    } else {
        $_SESSION['error'] = mysqli_error($db);
    }
    header("location: index.php");
}

?>