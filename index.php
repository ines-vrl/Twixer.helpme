<?php
require "config.php";

// Afficher les tweets du plus récent au plus ancien
$requete = $database->prepare("SELECT * FROM tweets INNER JOIN users ON tweets.user_id = users.id ORDER BY created_at DESC");
$requete->execute();
$tweets = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Acceuil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="segway">
        <h1>SEGWAY</h1>
    </div>


    <!-- Formulaire de recherche -->
    <div class="recherche-title">
        <h3>Rechercher des blogs</h3>
    </div>
    <div class="recherche-form">
        <form method="get" action="search.php">
            <input type="text" name="term" placeholder="Tapez quelque chose...">
            <button class="search-btn" type="submit">Rechercher</button>
        </form>
    </div>


    <nav>
        <ul>
            <div class="ul-nav">
                <li><a href="#">Accueil</a></li>
                <li><a href="./profil.php">Profil</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Inscription/Connexion</a></li>
            </div>
        </ul>
        </nav>

<!-- Formulaire pour créer un nouveau twix -->
<h2>Créer un nouveau blog</h2>
<form method="post" action="add_tweet.php">
    <textarea name="content" placeholder="Quoi de neuf ?"></textarea>
    <input type="hidden" name="user_id" value="1">
    <button class="submit-btn" type="submit">Envoyer</button>
</form>

    <!-- Affichage des tweets -->
    <div class="tweets">
        <?php foreach ($tweets as $tweet): ?>
            <div class="tweet">
                <p class="content"><?= $tweet['content'] ?></p>
                <p class="user">Posté par : <?= $tweet['username'] . " " ?> <img src="/projet/images/'<?= $tweet['photo'] ?>"
                 alt="Photo de l'utilisateur"> le <?= $tweet['created_at']; ?></p>
                <form method="post" action="delete_tweet.php">
                    <input type="hidden" name="tweet_id" value="<?= $tweet['tweet_id'] ?>">
                    <button type="submit" class="delete-btn">Supprimer</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <aside>
            <div class="discussion">
                <h3>Blogs stars</h3>
                <p>JohnDoe : Riri va avoir un 2eme gosse ??</h4>
                <p>EmiliyParis : Mais elle a pas accouché genre hier ?XD</p>
                <p>ZekeLuther : @EmilyParis mdrrrr</p>
                <p>TessTurner : Michael B Jordan est juste trop bo</p>
            </div>
        </aside>


        <footer>
            <div class="contact">
                <p>Nous contacter</p>
            </div>
            
            <ul class="ulfooter">
                <li><button class="facebook" type="button"><a href="https://fr-fr.facebook.com">Facebook</a></button></li>
                <li><button class="instagram" type="button"><a href="https://www.instagram.com">Instagram</a></button></li>
                <li><button class="twitter" type="button"><a href="https://twitter.com">Twitter</a></button></li>
                <li><button class="linkedin" type="button"><a href="https://fr.linkedin.com">LinkedIn</a></button></li>
            </ul>
        </footer>

</body>
</html>
