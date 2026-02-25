<?php
session_start();
require 'connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "category deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Something went wrong.";
    }

    $stmt->close();
} else {
    $_SESSION['error_message'] = "Invalid request.";
}

header("Location: category.php");
exit();
?>
