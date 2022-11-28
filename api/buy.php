<?php include '../app.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $logger->Log("Buying fruit with id: " . $_GET['id']);
    $db->BuyFruit($_GET['id']);
    exit(header("Location: /"));
} else {
    return false;
}
?>