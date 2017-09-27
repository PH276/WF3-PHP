<!Doctype html>
<html>
<head>
    <title>Mon Site</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <header>
        <div class="conteneur">
            <span>
                <a href="" title="Mon Site">MonSite.com</a>
            </span>
            <nav>
                <?php if (userConnecte()) : ?>
                    <a href="profil.php">Profil</a>
                    <a href="connxeion.php?action=deconnexion">Déconnexion</a>
                <?php else : ?>
                    <a href="inscription.php">Inscription</a>
                    <a href="connexion.php">Connexion</a>
                <?php endif; ?>
                <a href="boutique.php">Boutique</a>
                <a href="panier.php">Panier</a>
            </nav>
        </div>
    </header>
    <section>
        <div class="conteneur">
