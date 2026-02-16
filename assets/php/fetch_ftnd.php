<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$sql = "SELECT id, patient_name, total_score, created_at, severity, contact_number, emergency_contact
        FROM fagerstrom_test
        ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));