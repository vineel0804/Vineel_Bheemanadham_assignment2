<?php
include 'header.php';
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vineel_bookstore_4266";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Book List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Description</th>
                    <th>Quantity Available</th>
                    <th>Price</th>
                    <th>Product Added By</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['BookID']}</td>
                            <td>{$row['BookName']}</td>
                            <td>{$row['Description']}</td>
                            <td>{$row['QuantityAvailable']}</td>
                            <td>{$row['Price']}</td>
                            <td>{$row['ProductAddedBy']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
