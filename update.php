<?php

include 'db.php';

$name = $_POST['username'];
$bio = $_POST['bio_user'];
$email = $_POST['email_user'];
$user_id = $_POST['user_id_u'];

$stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, bio = ? WHERE id = ?");
$stmt->execute([$name, $email, $bio, $user_id]);

header("Location: index.php?update=1");
exit;