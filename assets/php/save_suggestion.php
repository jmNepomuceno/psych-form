<?php
include('../connection/connection.php');
header('Content-Type: application/json');

try {

    // ===== Suggestion Fields =====
    $bioID      = isset($_POST['bioID']) ? (int)$_POST['bioID'] : 0;
    $fullName   = $_POST['fullName'] ?? '';
    $subject    = $_POST['subject'] ?? '';
    $message    = $_POST['message'] ?? '';
    $dateSubmitted = date('Y-m-d'); // auto current date

    // ===== Validation =====
    if ($bioID <= 0 || empty($fullName) || empty($subject) || empty($message)) {
        echo json_encode([
            'success' => false,
            'message' => 'All fields are required.'
        ]);
        exit;
    }

    // ===== SQL Insert =====
    $sql = "INSERT INTO user_concerns (
                bioID,
                fullName,
                concernType,
                subject,
                message,
                dateSubmitted,
                status
            ) VALUES (
                :bioID,
                :fullName,
                'Suggestion',
                :subject,
                :message,
                :dateSubmitted,
                'Pending'
            )";

    $stmt = $pdo->prepare($sql);

    // ===== Bind Parameters =====
    $stmt->bindParam(':bioID', $bioID, PDO::PARAM_INT);
    $stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
    $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->bindParam(':dateSubmitted', $dateSubmitted);

    $stmt->execute();

    echo json_encode([
        'success' => true,
        'message' => 'Suggestion submitted successfully!'
    ]);

} catch (PDOException $e) {

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
