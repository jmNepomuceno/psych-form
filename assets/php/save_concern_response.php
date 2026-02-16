<?php
include('../connection/connection.php');
header('Content-Type: application/json');

try {
    $concernID = isset($_POST['concernID']) ? (int)$_POST['concernID'] : 0;
    $response  = $_POST['adminResponse'] ?? '';

    if ($concernID <= 0 || empty($response)) {
        echo json_encode(['success'=>false,'message'=>'Missing data.']);
        exit;
    }

    $sql = "UPDATE user_concerns 
            SET adminResponse = :adminResponse,
                status = 'Responded',
                updated_at = CURRENT_TIMESTAMP
            WHERE concernID = :concernID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':adminResponse',$response,PDO::PARAM_STR);
    $stmt->bindParam(':concernID',$concernID,PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(['success'=>true,'message'=>'Response saved successfully.']);

} catch(PDOException $e){
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
