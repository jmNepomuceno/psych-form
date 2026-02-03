<?php
    include('../connection/connection.php');
    header('Content-Type: application/json');

    $id = $_GET['id'] ?? 0;

    $sql = "SELECT * FROM audit_test WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
?>