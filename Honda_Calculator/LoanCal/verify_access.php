<?php
include "db.php";

if (!isset($_POST['access_code'])) {
    echo "FAIL";
    exit;
}

$code = trim($_POST['access_code']);

$stmt = $conn->prepare("SELECT access_id FROM access WHERE access_code = ? LIMIT 1");
$stmt->bind_param("s", $code);
$stmt->execute();
$result = $stmt->get_result();

session_start();

if ($result && $result->num_rows > 0) {
    $_SESSION['access_granted'] = true;
    echo "OK";
} else {
    echo "FAIL";
}

exit;
?>