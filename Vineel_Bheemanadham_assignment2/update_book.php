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

    
    $stmt = $conn->prepare("UPDATE books SET Description=?, QuantityAvailable=?, Price=? WHERE BookName=?");
    $stmt->bind_param("siis", $description, $quantityAvailable, $price, $bookName);

    
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Book updated successfully</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }

    $stmt->close();
}


$sql = "SELECT BookName FROM books";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Update Book</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="book_name" class="form-label">Select Book to Update</label>
                <select class="form-select" name="book_name" required>
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
                <div class="invalid-feedback">Please select a book to update.</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity Available</label>
                <input type="number" class="form-control" name="quantity" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
