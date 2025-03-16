<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'online_shopping';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'];

    if (!empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO comments (text) VALUES (?)");
        $stmt->bind_param("s", $comment);

        if ($stmt->execute()) {
            echo "<script>alert('Comment added successfully.'); window.location.href='aboutus.html#comment';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='aboutus.html#comment';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please enter a comment.'); window.location.href='aboutus.html#comment';</script>";
    }
}

$conn->close();
?>