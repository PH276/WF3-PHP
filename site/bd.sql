CREATE TABLE `commande` (
    `id_commande` int(3) NOT NULL,
    `id_membre` int(3) NOT NULL,
    `montant` int(3) NOT NULL,
    `date_enregistrement` datetime NOT NULL,
    `etat` enum('en cours de traitement', 'envoyé', 'livré')
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE  `details_commande` (
    `id_details_commande` int(3) NOT NULL,
    `id_commande` int(3) NOT NULL,
    `id_produit` int(3) NOT NULL,
    `quantite` int(3) NOT NULL,
    `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `membre` (
    `id_membre` int(3) NOT NULL,
    `pseudo` varchar(20) NOT NULL,
    `mdp` varchar(130) NOT NULL,
    `nom` varchar(20) NOT NULL,
    `prenom` varchar(20) NOT NULL,
    `email` varchar(50) NOT NULL,
    `civilite` enum('m', 'f'),
    `ville` varchar(50) NOT NULL,
    `code_postal` int(5) NOT NULL,
    `adresse` varchar(50) NOT NULL,
    `statut` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `produit` (
    `id_produit` int(3) NOT NULL,
    `reference` varchar(20) NOT NULL,
    `categorie` varchar(20) NOT NULL,
    `titre` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `couleur` varchar(20) NOT NULL,
    `taille` varchar(5) NOT NULL,
    `public` enum('m', 'f', 'mixte'),
    `photo` varchar(250) NOT NULL,
    `prix` double NOT NULL,
    `stock` int(3) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
