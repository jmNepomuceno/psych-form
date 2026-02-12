<?php
include('../connection/connection.php');
header('Content-Type: application/json');

try {
    // ====== COLLECT POST DATA ======
    $patient_name   = $_POST['patient_name'] ?? '';
    $age_sex        = $_POST['age_sex'] ?? '';
    $exam_date      = $_POST['exam_date'] ?? null;
    $severity = $_POST['severity'] ?? '';
    $contact_number = $_POST['contact_number'] ?? null;
    $contact_number_emer = $_POST['contact_number_emer'] ?? null;


    $q1 = isset($_POST['q1']) ? (int)$_POST['q1'] : 0;
    $q2 = isset($_POST['q2']) ? (int)$_POST['q2'] : 0;
    $q3 = isset($_POST['q3']) ? (int)$_POST['q3'] : 0;
    $q4 = isset($_POST['q4']) ? (int)$_POST['q4'] : 0;
    $q5 = isset($_POST['q5']) ? (int)$_POST['q5'] : 0;
    $q6 = isset($_POST['q6']) ? (int)$_POST['q6'] : 0;
    $q7 = isset($_POST['q7']) ? (int)$_POST['q7'] : 0;

    $difficulty      = isset($_POST['difficulty']) ? (int)$_POST['difficulty'] : 0;
    $total_score     = isset($_POST['total_score']) ? (int)$_POST['total_score'] : 0;

    $physician       = $_POST['physician'] ?? '';
    $license_no      = $_POST['license_no'] ?? '';
    $physician_date  = $_POST['physician_date'] ?? null;

    // ====== INSERT QUERY ======
    $sql = "INSERT INTO gad_7 (
                patient_name, age_sex, exam_date,
                q1, q2, q3, q4, q5, q6, q7,
                difficulty, total_score,
                physician, license_no, physician_date, severity, contact_number, emergency_contact
                ) VALUES (
                :patient_name, :age_sex, :exam_date,
                :q1, :q2, :q3, :q4, :q5, :q6, :q7,
                :difficulty, :total_score,
                :physician, :license_no, :physician_date, :severity, :contact_number, :emergency_contact
            )";

    $stmt = $pdo->prepare($sql);

    // ====== BIND PARAMETERS ======
    $stmt->bindParam(':patient_name', $patient_name, PDO::PARAM_STR);
    $stmt->bindParam(':age_sex', $age_sex, PDO::PARAM_STR);
    $stmt->bindParam(':exam_date', $exam_date);
    $stmt->bindParam(':q1', $q1, PDO::PARAM_INT);
    $stmt->bindParam(':q2', $q2, PDO::PARAM_INT);
    $stmt->bindParam(':q3', $q3, PDO::PARAM_INT);
    $stmt->bindParam(':q4', $q4, PDO::PARAM_INT);
    $stmt->bindParam(':q5', $q5, PDO::PARAM_INT);
    $stmt->bindParam(':q6', $q6, PDO::PARAM_INT);
    $stmt->bindParam(':q7', $q7, PDO::PARAM_INT);
    $stmt->bindParam(':difficulty', $difficulty, PDO::PARAM_INT);
    $stmt->bindParam(':total_score', $total_score, PDO::PARAM_INT);
    $stmt->bindParam(':physician', $physician, PDO::PARAM_STR);
    $stmt->bindParam(':license_no', $license_no, PDO::PARAM_STR);
    $stmt->bindParam(':physician_date', $physician_date);
    $stmt->bindParam(':severity', $severity, PDO::PARAM_STR);
    $stmt->bindParam(':contact_number', $contact_number, PDO::PARAM_STR);
    $stmt->bindParam(':emergency_contact', $contact_number_emer, PDO::PARAM_STR);

    // ====== EXECUTE QUERY ======
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'GAD-7 form saved successfully!']);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
