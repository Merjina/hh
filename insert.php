<?php
session_start();
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    if (isset($_FILES["image"])) {
        $target_directory = "./images";
        $image = $target_directory . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $allowed_formats = ["jpg", "jpeg", "png", "gif"];
            if (in_array($imageFileType, $allowed_formats)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
                    $query = "INSERT INTO pp (name, price, description, image) VALUES ('$name', '$price', '$description', '$image')"; 
                    if (mysqli_query($conn, $query)) {
                        echo '<script>alert("Product added successfully!");</script>';
                    } else {
                        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
                    }
                } else {
                    echo '<script>alert("Error uploading image.");</script>';
                }
            } else {
                echo '<script>alert("Invalid image format. Allowed formats: jpg, jpeg, png, gif.");</script>';
            }
        } else {
            echo '<script>alert("File is not an image.");</script>';
        }
    } else {
        echo '<script>alert("Image file is required.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-secondary">
<div class="container-fluid  p-5 ">
    <h2 class="text-center">Add New Product</h2>
    <form action="insert.php" method="POST" enctype="multipart/form-data"><br>
        <div class="form-group">
            <label for="name">Category name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div><br>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div><br>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
        </div><br>
        <div class="form-group">
            <label for="image"> Image:</label>
            <input type="file" class="form-control-file" id="image" name="image"  required>
        </div><br>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
</body>
</html>
