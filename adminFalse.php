<?php


include 'db.php';

$user_id = $_POST['user_id_a'];

$stmt = $pdo->prepare("UPDATE users SET is_admin = 0 WHERE id = ?");
$stmt->execute([$user_id]);

header("Location: index.php?UpdateAdmin=1");
exit();