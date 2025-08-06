<?php

include 'db.php';

$user_id = $_POST['user_id'];

echo $user_id;

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$user_id]);

header("Location: index.php?delete=1");
exit;

