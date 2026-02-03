<?php
include('../connection/connection.php');
header('Content-Type: application/json');

$sql = "
    SELECT 
        id,
        patient_name,
        age_sex,
        result,
        created_at
    FROM parq_form
    ORDER BY created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
