<?php
include('../connection/connection.php');
header('Content-Type: application/json');

try {
    // ====== PATIENT INFO ======
    $patient_name   = $_POST['patient_name'] ?? '';
    $age_sex        = $_POST['age_sex'] ?? '';
    $exam_date      = $_POST['exam_date'] ?? null;

    // ====== SECTION 1 (Q1-Q5) ======
    $q1 = $_POST['q1'] ?? null; // TIME input as string 'HH:MM'
    $q2 = isset($_POST['q2']) ? (int)$_POST['q2'] : null;
    $q3 = $_POST['q3'] ?? null;
    $q4 = isset($_POST['q4']) ? (float)$_POST['q4'] : null;
    $q5 = isset($_POST['q5']) ? (float)$_POST['q5'] : null;

    // ====== SECTION 2 (Q6a-Q6j radios) ======
    $q6a = isset($_POST['q6a']) ? (int)$_POST['q6a'] : null;
    $q6b = isset($_POST['q6b']) ? (int)$_POST['q6b'] : null;
    $q6c = isset($_POST['q6c']) ? (int)$_POST['q6c'] : null;
    $q6d = isset($_POST['q6d']) ? (int)$_POST['q6d'] : null;
    $q6e = isset($_POST['q6e']) ? (int)$_POST['q6e'] : null;
    $q6f = isset($_POST['q6f']) ? (int)$_POST['q6f'] : null;
    $q6g = isset($_POST['q6g']) ? (int)$_POST['q6g'] : null;
    $q6h = isset($_POST['q6h']) ? (int)$_POST['q6h'] : null;
    $q6i = isset($_POST['q6i']) ? (int)$_POST['q6i'] : null;
    $q6j = isset($_POST['q6j']) ? (int)$_POST['q6j'] : null;
    $q6j_other = $_POST['q6j_other'] ?? null;

    // ====== SECTION 3 (Q7-Q8 selects) ======
    $q7 = isset($_POST['q7']) ? (int)$_POST['q7'] : null;
    $q8 = isset($_POST['q8']) ? (int)$_POST['q8'] : null;

    // ====== SECTION 4 (Q9 radio) ======
    $q9 = isset($_POST['q9']) ? (int)$_POST['q9'] : null;

    // ====== SCORES & CONTACT ======
    $total_score    = isset($_POST['total_score']) ? (int)$_POST['total_score'] : null;
    $severity       = $_POST['severity'] ?? '';
    $contact_number = $_POST['contact_number'] ?? null;
    $contact_number_emer = $_POST['contact_number_emer'] ?? null;

    // ====== INSERT QUERY ======
    $sql = "INSERT INTO psqi_assessment (
                patient_name, age_sex, exam_date,
                q1, q2, q3, q4, q5,
                q6a, q6b, q6c, q6d, q6e, q6f, q6g, q6h, q6i, q6j, q6j_other,
                q7, q8,
                q9,
                total_score, severity, contact_number, emergency_contact
            ) VALUES (
                :patient_name, :age_sex, :exam_date,
                :q1, :q2, :q3, :q4, :q5,
                :q6a, :q6b, :q6c, :q6d, :q6e, :q6f, :q6g, :q6h, :q6i, :q6j, :q6j_other,
                :q7, :q8,
                :q9,
                :total_score, :severity, :contact_number, :emergency_contact
            )";

    $stmt = $pdo->prepare($sql);

    // Bind params
    $stmt->bindParam(':patient_name', $patient_name, PDO::PARAM_STR);
    $stmt->bindParam(':age_sex', $age_sex, PDO::PARAM_STR);
    $stmt->bindParam(':exam_date', $exam_date);
    
    $stmt->bindParam(':q1', $q1);
    $stmt->bindParam(':q2', $q2, PDO::PARAM_INT);
    $stmt->bindParam(':q3', $q3);
    $stmt->bindParam(':q4', $q4);
    $stmt->bindParam(':q5', $q5);

    $stmt->bindParam(':q6a', $q6a, PDO::PARAM_INT);
    $stmt->bindParam(':q6b', $q6b, PDO::PARAM_INT);
    $stmt->bindParam(':q6c', $q6c, PDO::PARAM_INT);
    $stmt->bindParam(':q6d', $q6d, PDO::PARAM_INT);
    $stmt->bindParam(':q6e', $q6e, PDO::PARAM_INT);
    $stmt->bindParam(':q6f', $q6f, PDO::PARAM_INT);
    $stmt->bindParam(':q6g', $q6g, PDO::PARAM_INT);
    $stmt->bindParam(':q6h', $q6h, PDO::PARAM_INT);
    $stmt->bindParam(':q6i', $q6i, PDO::PARAM_INT);
    $stmt->bindParam(':q6j', $q6j, PDO::PARAM_INT);
    $stmt->bindParam(':q6j_other', $q6j_other, PDO::PARAM_STR);

    $stmt->bindParam(':q7', $q7, PDO::PARAM_INT);
    $stmt->bindParam(':q8', $q8, PDO::PARAM_INT);
    $stmt->bindParam(':q9', $q9, PDO::PARAM_INT);

    $stmt->bindParam(':total_score', $total_score, PDO::PARAM_INT);
    $stmt->bindParam(':severity', $severity, PDO::PARAM_STR);
    $stmt->bindParam(':contact_number', $contact_number, PDO::PARAM_STR);
    $stmt->bindParam(':emergency_contact', $contact_number_emer, PDO::PARAM_STR);

    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'PSQI form saved successfully!']);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
