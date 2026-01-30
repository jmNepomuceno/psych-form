<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$sql = "SELECT id, patient_name, total_score, created_at 
        FROM phq_9
        ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
