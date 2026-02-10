<?php
include('../connection/connection.php');
header('Content-Type: application/json');

/**
 * Expected GET param:
 * ?type=gad7 | phq9 | ftnd | psqi | pss10 | audit | parq
 */

$type = $_POST['type'] ?? '';

/**
 * Whitelist assessment types
 * key   => table_name
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

if (!array_key_exists($type, $assessmentMap)) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Invalid assessment type'
    ]);
    exit;
}

$table = $assessmentMap[$type];

$sql = "
    SELECT 
        id,
        patient_name,
        total_score,
        severity,
        created_at AS exam_date
    FROM {$table}
    ORDER BY created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
