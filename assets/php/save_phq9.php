<?php
include('../connection/connection.php');
header('Content-Type: application/json');

try {
    // ====== COLLECT POST DATA ======
    $patient_name   = $_POST['patient_name'] ?? '';
    $age_sex        = $_POST['age_sex'] ?? '';
    $exam_date      = $_POST['exam_date'] ?? null;

    $q1 = isset($_POST['q1']) ? (int)$_POST['q1'] : 0;
    $q2 = isset($_POST['q2']) ? (int)$_POST['q2'] : 0;
    $q3 = isset($_POST['q3']) ? (int)$_POST['q3'] : 0;
    $q4 = isset($_POST['q4']) ? (int)$_POST['q4'] : 0;
    $q5 = isset($_POST['q5']) ? (int)$_POST['q5'] : 0;
    $q6 = isset($_POST['q6']) ? (int)$_POST['q6'] : 0;
    $q7 = isset($_POST['q7']) ? (int)$_POST['q7'] : 0;
    $q8 = isset($_POST['q8']) ? (int)$_POST['q8'] : 0;
    $q9 = isset($_POST['q9']) ? (int)$_POST['q9'] : 0;

    $difficulty      = isset($_POST['difficulty']) ? (int)$_POST['difficulty'] : 0;
    $total_score     = isset($_POST['total_score']) ? (int)$_POST['total_score'] : 0;

    $physician       = $_POST['physician'] ?? '';
    $license_no      = $_POST['license_no'] ?? '';
    $physician_date  = $_POST['physician_date'] ?? null;

    // ====== INSERT QUERY ======
    $sql = "INSERT INTO phq_9 (
                patient_name, age_sex, exam_date,
                q1, q2, q3, q4, q5, q6, q7, q8, q9,
                difficulty, total_score,
                physician, license_no, physician_date
            ) VALUES (
                :patient_name, :age_sex, :exam_date,
                :q1, :q2, :q3, :q4, :q5, :q6, :q7, :q8, :q9,
                :difficulty, :total_score,
                :physician, :license_no, :physician_date
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
    $stmt->bindParam(':q8', $q8, PDO::PARAM_INT);
    $stmt->bindParam(':q9', $q9, PDO::PARAM_INT);
    $stmt->bindParam(':difficulty', $difficulty, PDO::PARAM_INT);
    $stmt->bindParam(':total_score', $total_score, PDO::PARAM_INT);
    $stmt->bindParam(':physician', $physician, PDO::PARAM_STR);
    $stmt->bindParam(':license_no', $license_no, PDO::PARAM_STR);
    $stmt->bindParam(':physician_date', $physician_date);

    // ====== EXECUTE QUERY ======
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'PHQ-9 form saved successfully!']);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
