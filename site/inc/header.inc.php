<!Doctype html>
<html>
<head>
    <title>Mon Site - <?= $page ?></title>
    <link rel="stylesheet" href="<?= RACINE_SITE ?>css/style.css"/>
</head>
<body>
    <header>
        <div class="conteneur">
            <span>
                <a href="<?= RACINE_SITE ?>index.php" title="Mon Site">MonSite.com</a>
            </span>
            <nav>
                <?php if (userConnecte()) : ?>
                    <a class="<?= ($page=='profil')?'active':'' ?>" href="<?= RACINE_SITE ?>profil.php">Profil</a>
                    <a href="<?= RACINE_SITE ?>connexion.php?action=deconnexion">Déconnexion</a>
                <?php else : ?>
                    <a class="<?= ($page=='inscription')?'active':'' ?>" href="<?= RACINE_SITE ?>inscription.php">Inscription</a>
                    <a class="<?= ($page=='connexion')?'active':'' ?>" href="<?= RACINE_SITE ?>connexion.php">Connexion</a>
                <?php endif; ?>
                <a class="<?= ($page=='boutique')?'active':'' ?>" href="<?= RACINE_SITE ?>boutique.php">Boutique</a>
                <a class="<?= ($page=='panier')?'active':'' ?>" href="<?= RACINE_SITE ?>panier.php">Panier</a>

                <?php if (userAdmin()) : ?>
                    <a class="<?= ($page=='gboutique')?'active':'' ?>" href="<?= RACINE_SITE ?>backoffice/gestion_Boutique.php">Gestion Boutique</a>
                    <a class="<?= ($page=='gmembres')?'active':'' ?>" href="<?= RACINE_SITE ?>backoffice/gestion_membres.php">Gestion Membres</a>
                    <a class="<?= ($page=='gcommandes')?'active':'' ?>" href="<?= RACINE_SITE ?>backoffice/gestion_commandes.php">Gestion Commandes</a>

                <?php endif; ?>


            </nav>
        </div>
    </header>
    <section>
        <div class="conteneur">
