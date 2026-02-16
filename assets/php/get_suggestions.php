<?php
include('../connection/connection.php');
header('Content-Type: application/json');

try {
    // Fetch all suggestions from the table
    $sql = "SELECT concernID, bioID, fullName, subject, message, adminResponse, status, dateSubmitted
            FROM user_concerns
            WHERE concernType = 'Suggestion'
            ORDER BY dateSubmitted DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $suggestions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($suggestions);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
