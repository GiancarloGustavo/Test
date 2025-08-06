
<?php
include 'db.php';
include 'users.php';

$stmt = $pdo->prepare("SELECT * FROM users ORDER BY created_at DESC");
$stmt->execute();
$users = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les utilisateurs du site</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if(isset($_GET['action'])) : ?>
        <p class="no-user"><?= "Utilisateur inséré avec succès!" ?></p>
        <script>
            const hidden = document.querySelector('.no-user');
            setTimeout(() => {
                hidden.style.display = 'none';
            }, 5000);
        </script>
    <?php elseif(isset($_GET['temporary'])): ?>
        <p class="no-user"><?= "Utilisateur supprimé temporairement!" ?></p>
        <script>
            const hid = document.querySelector('.no-user');
            setTimeout(() => {
                hid.style.display = 'none';
            }, 5000);
        </script>
    <?php elseif(isset($_GET['UpdateTemporary'])): ?>
        <p class="no-user"><?= "Cet utilisateur a été réintialisé!" ?></p>
        <script>
            const hidd = document.querySelector('.no-user');
            setTimeout(() => {
                hidd.style.display = 'none';
            }, 5000);
        </script>
    <?php elseif(isset($_GET['admin'])): ?>
        <p class="no-user"><?= "Cet utilisateur fait parti des membres maintenant!" ?></p>
        <script>
            const hiddd = document.querySelector('.no-user');
            setTimeout(() => {
                hiddd.style.display = 'none';
            }, 5000);
        </script>
    <?php elseif(isset($_GET['UpdateAdmin'])): ?>
        <p class="no-user"><?= "Cet utilisateur ne fait plus parti des membres desormais!" ?></p>
        <script>
            const h = document.querySelector('.no-user');
            setTimeout(() => {
                h.style.display = 'none';
            }, 5000);
        </script>
    <?php elseif(isset($_GET['update'])): ?>
        <p class="no-user"><?= "Profile mis à jour avec succès!" ?></p>
        <script>
            const up = document.querySelector('.no-user');
            setTimeout(() => {
                up.style.display = 'none';
            }, 5000);
        </script>
    <?php elseif(isset($_GET['delete'])): ?>
        <p class="user-no"><?= "Profile supprimer avec succès!" ?></p>
        <script>
            const d = document.querySelector('.user-no');
            setTimeout(() => {
                d.style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?>

    <div class="container">
        <!-- Isit la se pou antre yon itilizatè -->

        <form action="save_user.php" method="post" class="insert">
            <label for="name">Entrez le nom* :</label>
            <input type="text" name="name" id="name" placeholder="Entrez le nom içi...">
            <label for="email">Entrez l'email* :</label> 
            <input type="email" name="email" id="email" placeholder="Entrez l'email içi..." > 
            <label for="bio">Entrez la bio : </label>
            <textarea name="bio" id="bio" placeholder="entrez la bio içi..." ></textarea>
            <button type="submit" class="save">Enregistrez</button>
        </form>

        <!-- Sa se bouton kap pèmèt ou fè form nan parèt pouw ka inserer yon itilizate -->

        <div class="showForm">
            <button class="show" onclick="toggleForm();">Afficher les champs</button>
        </div>
        <!-- Isi a se espas nap fè parèt tout itilizatè yo -->

        <div class="users">
            <?php if(empty($users)) : ?>
                <p class="no-user">Il n'y a pas encore d'utilisateur inscrit.</p>
            <?php else : ?>
                <?php foreach($users as $user): ?>
                    <div class="user-item <?= $user['is_delete'] == 1 ? 'temp' : '' ?> <?= $user['is_admin'] == 1 ? 'admin' : '' ?>">
                        <p>Nom d'utilisateur : <b><?= $user['name'] ?></b></p>
                        <p>Email : <b><?= $user['email'] ?></b></p>
                        <p class="bio">Bio <br /> <em><?= nl2br($user['bio']) ?></em></p>
                        <p>Date d'inscription : <small><?= $user['created_at']  ?></small></p>
                        <p><small>ID de l'utilisateur : <?= $user['id'] ?></small></p>

                        <?php if($user['is_delete'] == 1): ?>
                            <p style="text-decoration: underline;"><?= 'Cet utilisateur a supprimé son compte' ?></p>
                        <?php endif; ?>

                        <!-- sa fe form ki pèmèt ou supprimer yon utilisateur -->

                        <?php if($user['is_admin'] == 0): ?>
                            <form action="delete.php" method="post" onsubmit="return confirm('Êtes-vous sûr de votre choix?');">
                                <input type="hidden" name="user_id" id="user_id" value="<?= $user['id'] ?>">
                                <button type="submit" class="delete">Supprimer</button>
                            </form>
                        <?php endif; ?>

                        <?php if($user['is_admin'] == 0): ?>
                            <?php if($user['is_delete'] == 1): ?>
                                <form action="updateT.php" method="post" onsubmit="return confirm('Êtes-vous sûr de votre choix?');">
                                    <input type="hidden" name="user_id_t" id="user_id_t" value="<?= $user['id'] ?>">
                                    <button type="submit" class="update">Réinitialiser</button>
                                </form>
                            <?php else : ?>
                                <form action="deleteT.php" method="post" onsubmit="return confirm('Êtes-vous sûr de votre choix?');">
                                    <input type="hidden" name="user_id_t" id="user_id_t" value="<?= $user['id'] ?>">
                                    <button type="submit" class="delete">Supprimer temporairement</button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if($user['is_delete'] == 0): ?>
                            <?php if($user['is_admin'] == 1): ?>
                                <form action="adminFalse.php" method="post" onsubmit="return confirm('Êtes-vous sûr de votre choix?');">
                                    <input type="hidden" name="user_id_a" id="user_id_a" value="<?= $user['id'] ?>">
                                    <button type="submit" class="delete">Retire des membres</button>
                                </form>
                            <?php else : ?>
                                <form action="adminTrue.php" method="post" onsubmit="return confirm('Êtes-vous sûr de votre choix?');">
                                    <input type="hidden" name="user_id_a" id="user_id_a" value="<?= $user['id'] ?>">
                                    <button type="submit" class="update">Devenir membre</button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>

                        <button type="submit" class="update" onclick="showUpdateForm(this);">Mettre à jour le profile</button>

                        <form action="update.php" class="update-div" method="post">
                            <input type="hidden" name="user_id_u" value="<?= $user['id'] ?>">
                            <label for="username">Changer le nom : </label>
                            <input type="text" name="username" id="username" value="<?= $user['name'] ?>" />
                            <label for="email_user">Changer l'email : </label>
                            <input type="email" name="email_user" id="email_user" value="<?= $user['email'] ?>">
                            <label for="bio_user">Changer la bio : </label>
                            <textarea name="bio_user" id="bio_user"><?=  nl2br($user['bio']) ?></textarea>
                            <button type="submit" class="update">Mettre à jour</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>