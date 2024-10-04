<?php
include 'header.php';
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vineel_bookstore_4266";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookName = $_POST['book_name'];
    $description = $_POST['description'];
    $quantityAvailable = $_POST['quantity'];
    $price = $_POST['price'];

    
    $stmt = $conn->prepare("INSERT INTO books (BookName, Description, QuantityAvailable, Price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $bookName, $description, $quantityAvailable, $price);

    
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">New book added successfully</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Add New Book</h2>
        <form method="post" action="" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="book_name" class="form-label">Book Name</label>
                <input type="text" class="form-control" id="book_name" name="book_name" required>
                <div class="invalid-feedback">Please enter the book name.</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
                <div class="invalid-feedback">Please enter a description.</div>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity Available</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
                <div class="invalid-feedback">Please enter the quantity available.</div>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                <div class="invalid-feedback">Please enter the price.</div>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
