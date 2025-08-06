<?php

include 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $bio = trim(htmlspecialchars($_POST['bio']));

    if(empty($name) || empty($email)){
        echo "Le nom ou l'email ne doit pas être vide.";
    }elseif(empty($bio)){
        $bio = "No bio Found for " . $name;
        $stmt = $pdo->prepare("INSERT INTO users (name, email, bio) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $bio]);

        header("Location: index.php?action=success");
        exit;
    }else{
        $stmt = $pdo->prepare("INSERT INTO users (name, email, bio) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $bio]);

        header("Location: index.php?action=success");
        exit;
    }
}