<?php
include('../connection/connection.php');
header('Content-Type: application/json');

try {
    $sql = "SELECT concernID, bioID, fullName, subject, message, adminResponse, status, dateSubmitted
            FROM user_concerns
            WHERE concernType = 'Concern'
            ORDER BY dateSubmitted DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $concerns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($concerns);

} catch(PDOException $e){
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
