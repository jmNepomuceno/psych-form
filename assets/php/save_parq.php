<?php
include('../connection/connection.php');
header('Content-Type: application/json');

try {
    // ===== Patient Info =====
    $patient_name   = $_POST['patient_name'] ?? '';
    $age_sex        = $_POST['age_sex'] ?? '';
    $exam_date      = $_POST['exam_date'] ?? null;

    // ===== PAR-Q Questions =====
    $q1  = $_POST['q1']  ?? 'no';
    $q2  = $_POST['q2']  ?? 'no';
    $q3  = $_POST['q3']  ?? 'no';
    $q4  = $_POST['q4']  ?? 'no';
    $q4_condition  = $_POST['q4_condition'] ?? '';
    $q5  = $_POST['q5']  ?? 'no';
    $q5_medications = $_POST['q5_medications'] ?? '';
    $q6  = $_POST['q6']  ?? 'no';
    $q6_condition  = $_POST['q6_condition'] ?? '';
    $q7  = $_POST['q7']  ?? 'no';

    // ===== Follow-Up Questions =====
    $q1_ = $_POST['q1_'] ?? 'no';
    $q1a = $_POST['q1a'] ?? 'no';
    $q1b = $_POST['q1b'] ?? 'no';
    $q1c = $_POST['q1c'] ?? 'no';

    $q2_ = $_POST['q2_'] ?? 'no';
    $q2a = $_POST['q2a'] ?? 'no';
    $q2b = $_POST['q2b'] ?? 'no';

    $q3_ = $_POST['q3_'] ?? 'no';
    $q3a = $_POST['q3a'] ?? 'no';
    $q3b = $_POST['q3b'] ?? 'no';
    $q3c = $_POST['q3c'] ?? 'no';
    $q3d = $_POST['q3d'] ?? 'no';

    $q4_ = $_POST['q4_'] ?? 'no';
    $q4a = $_POST['q4a'] ?? 'no';
    $q4b = $_POST['q4b'] ?? 'no';

    $q5_ = $_POST['q5_'] ?? 'no';
    $q5a = $_POST['q5a'] ?? 'no';
    $q5b = $_POST['q5b'] ?? 'no';
    $q5c = $_POST['q5c'] ?? 'no';
    $q5d = $_POST['q5d'] ?? 'no';
    $q5e = $_POST['q5e'] ?? 'no';

    $q6_ = $_POST['q6_'] ?? 'no';
    $q6a = $_POST['q6a'] ?? 'no';
    $q6b = $_POST['q6b'] ?? 'no';

    $q7_ = $_POST['q7_'] ?? 'no';
    $q7a = $_POST['q7a'] ?? 'no';
    $q7b = $_POST['q7b'] ?? 'no';
    $q7c = $_POST['q7c'] ?? 'no';
    $q7d = $_POST['q7d'] ?? 'no';

    $q8_ = $_POST['q8_'] ?? 'no';
    $q8a = $_POST['q8a'] ?? 'no';
    $q8b = $_POST['q8b'] ?? 'no';
    $q8c = $_POST['q8c'] ?? 'no';

    $q9_ = $_POST['q9_'] ?? 'no';
    $q9a = $_POST['q9a'] ?? 'no';
    $q9b = $_POST['q9b'] ?? 'no';
    $q9c = $_POST['q9c'] ?? 'no';

    $q10_ = $_POST['q10_'] ?? 'no';
    $q10a = $_POST['q10a'] ?? 'no';
    $q10b = $_POST['q10b'] ?? 'no';
    $q10c = $_POST['q10c'] ?? 'no';

    // ===== SQL Insert =====
    $sql = "INSERT INTO parq_form (
                patient_name, age_sex, exam_date,
                q1, q2, q3, q4, q4_condition, q5, q5_medications, q6, q6_condition, q7,
                q1_, q1a, q1b, q1c,
                q2_, q2a, q2b,
                q3_, q3a, q3b, q3c, q3d,
                q4_, q4a, q4b,
                q5_, q5a, q5b, q5c, q5d, q5e,
                q6_, q6a, q6b,
                q7_, q7a, q7b, q7c, q7d,
                q8_, q8a, q8b, q8c,
                q9_, q9a, q9b, q9c,
                q10_, q10a, q10b, q10c,
                result, created_at
            ) VALUES (
                :patient_name, :age_sex, :exam_date,
                :q1, :q2, :q3, :q4, :q4_condition, :q5, :q5_medications, :q6, :q6_condition, :q7,
                :q1_, :q1a, :q1b, :q1c,
                :q2_, :q2a, :q2b,
                :q3_, :q3a, :q3b, :q3c, :q3d,
                :q4_, :q4a, :q4b,
                :q5_, :q5a, :q5b, :q5c, :q5d, :q5e,
                :q6_, :q6a, :q6b,
                :q7_, :q7a, :q7b, :q7c, :q7d,
                :q8_, :q8a, :q8b, :q8c,
                :q9_, :q9a, :q9b, :q9c,
                :q10_, :q10a, :q10b, :q10c,
                :result, NOW()
            )";

    $stmt = $pdo->prepare($sql);

    // ===== Bind Parameters =====
    $stmt->bindParam(':patient_name', $patient_name, PDO::PARAM_STR);
    $stmt->bindParam(':age_sex', $age_sex, PDO::PARAM_STR);
    $stmt->bindParam(':exam_date', $exam_date);
    $stmt->bindParam(':q1', $q1, PDO::PARAM_STR);
    $stmt->bindParam(':q2', $q2, PDO::PARAM_STR);
    $stmt->bindParam(':q3', $q3, PDO::PARAM_STR);
    $stmt->bindParam(':q4', $q4, PDO::PARAM_STR);
    $stmt->bindParam(':q4_condition', $q4_condition, PDO::PARAM_STR);
    $stmt->bindParam(':q5', $q5, PDO::PARAM_STR);
    $stmt->bindParam(':q5_medications', $q5_medications, PDO::PARAM_STR);
    $stmt->bindParam(':q6', $q6, PDO::PARAM_STR);
    $stmt->bindParam(':q6_condition', $q6_condition, PDO::PARAM_STR);
    $stmt->bindParam(':q7', $q7, PDO::PARAM_STR);

    // Bind Follow-Up Questions
    $stmt->bindParam(':q1_', $q1_, PDO::PARAM_STR);
    $stmt->bindParam(':q1a', $q1a, PDO::PARAM_STR);
    $stmt->bindParam(':q1b', $q1b, PDO::PARAM_STR);
    $stmt->bindParam(':q1c', $q1c, PDO::PARAM_STR);

    $stmt->bindParam(':q2_', $q2_, PDO::PARAM_STR);
    $stmt->bindParam(':q2a', $q2a, PDO::PARAM_STR);
    $stmt->bindParam(':q2b', $q2b, PDO::PARAM_STR);

    $stmt->bindParam(':q3_', $q3_, PDO::PARAM_STR);
    $stmt->bindParam(':q3a', $q3a, PDO::PARAM_STR);
    $stmt->bindParam(':q3b', $q3b, PDO::PARAM_STR);
    $stmt->bindParam(':q3c', $q3c, PDO::PARAM_STR);
    $stmt->bindParam(':q3d', $q3d, PDO::PARAM_STR);

    $stmt->bindParam(':q4_', $q4_, PDO::PARAM_STR);
    $stmt->bindParam(':q4a', $q4a, PDO::PARAM_STR);
    $stmt->bindParam(':q4b', $q4b, PDO::PARAM_STR);

    $stmt->bindParam(':q5_', $q5_, PDO::PARAM_STR);
    $stmt->bindParam(':q5a', $q5a, PDO::PARAM_STR);
    $stmt->bindParam(':q5b', $q5b, PDO::PARAM_STR);
    $stmt->bindParam(':q5c', $q5c, PDO::PARAM_STR);
    $stmt->bindParam(':q5d', $q5d, PDO::PARAM_STR);
    $stmt->bindParam(':q5e', $q5e, PDO::PARAM_STR);

    $stmt->bindParam(':q6_', $q6_, PDO::PARAM_STR);
    $stmt->bindParam(':q6a', $q6a, PDO::PARAM_STR);
    $stmt->bindParam(':q6b', $q6b, PDO::PARAM_STR);

    $stmt->bindParam(':q7_', $q7_, PDO::PARAM_STR);
    $stmt->bindParam(':q7a', $q7a, PDO::PARAM_STR);
    $stmt->bindParam(':q7b', $q7b, PDO::PARAM_STR);
    $stmt->bindParam(':q7c', $q7c, PDO::PARAM_STR);
    $stmt->bindParam(':q7d', $q7d, PDO::PARAM_STR);

    $stmt->bindParam(':q8_', $q8_, PDO::PARAM_STR);
    $stmt->bindParam(':q8a', $q8a, PDO::PARAM_STR);
    $stmt->bindParam(':q8b', $q8b, PDO::PARAM_STR);
    $stmt->bindParam(':q8c', $q8c, PDO::PARAM_STR);

    $stmt->bindParam(':q9_', $q9_, PDO::PARAM_STR);
    $stmt->bindParam(':q9a', $q9a, PDO::PARAM_STR);
    $stmt->bindParam(':q9b', $q9b, PDO::PARAM_STR);
    $stmt->bindParam(':q9c', $q9c, PDO::PARAM_STR);

    $stmt->bindParam(':q10_', $q10_, PDO::PARAM_STR);
    $stmt->bindParam(':q10a', $q10a, PDO::PARAM_STR);
    $stmt->bindParam(':q10b', $q10b, PDO::PARAM_STR);
    $stmt->bindParam(':q10c', $q10c, PDO::PARAM_STR);

    // Bind result value
    $result = $_POST['result'] ?? '';  // Assuming result is sent in the request
    $stmt->bindParam(':result', $result, PDO::PARAM_STR);

    // Execute
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'PAR-Q form saved successfully!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
