<?php include '../app.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logger->Log("Adding fruit");
    $db->AddFruit($_POST['name'], $_POST['amount']);
    header("Location: /");
    exit();
} else {
    return false;
}
?>