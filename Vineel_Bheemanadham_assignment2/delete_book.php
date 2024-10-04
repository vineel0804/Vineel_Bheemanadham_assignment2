<?php
include 'header.php';
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vineel_bookstore_4266";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookName = $_POST['book_name'];

    $stmt = $conn->prepare("DELETE FROM books WHERE BookName=?");
    $stmt->bind_param("s", $bookName);

    
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Book deleted successfully</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }

    $stmt->close();
}


$sql = "SELECT BookName FROM books";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Delete Book</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="book_name" class="form-label">Select Book to Delete</label>
                <select class="form-select" name="book_name" id="book_name" required>
                    <option value="" selected disabled>Choose a book...</option>
                    <?php
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['BookName'] . '">' . $row['BookName'] . '</option>';
                        }
                    } else {
                        echo '<option value="">No books available</option>';
                    }
                    ?>
                </select>
                <div class="invalid-feedback">Please select a book to delete.</div>
            </div>
            <button type="submit" class="btn btn-danger">Delete Book</button>
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
