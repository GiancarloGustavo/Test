<?php


include 'db.php';

$user_id = $_POST['user_id_t'];

$stmt = $pdo->prepare("UPDATE users SET is_delete = 1 WHERE id = ?");
$stmt->execute([$user_id]);

header("Location: index.php?temporary=1");
exit();