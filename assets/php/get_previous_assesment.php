<?php
include('../../session.php');
include('../connection/connection.php');
header('Content-Type: application/json');

/**
 * Expected POST param:
 * type = gad7 | phq9 | ftnd | psqi | pss10 | audit | parq
 */

$type = $_POST['type'] ?? '';

/**
 * Assessment type → table mapping
 */
$assessmentMap = [
    'gad7'  => 'gad_7',
    'phq9'  => 'phq_9',
    'ftnd'  => 'fagerstrom_test',
    'psqi'  => 'psqi_assessment',
    'pss10' => 'pss_test',
    'audit' => 'audit_test',
    'parq'  => 'parq_form'
];

if (!isset($assessmentMap[$type])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid assessment type']);
    exit;
}

if (!isset($_SESSION['name'])) {
    http_response_code(401);
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

$table = $assessmentMap[$type];
$patientName = $_SESSION['name'];

/**
 * Fetch assessments for the logged-in user only
 */
$sql = "
    SELECT
        id,
        patient_name,
        total_score,
        severity,
        contact_number,
        created_at AS exam_date
    FROM {$table}
    WHERE patient_name = :patient_name
    ORDER BY created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':patient_name', $patientName);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
