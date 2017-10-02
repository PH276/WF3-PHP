CREATE TABLE `abonne` (
	id_abonne INT(3),
	prenom VARCHAR(25)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `abonne`
  ADD PRIMARY KEY (`id_abonne`);

ALTER TABLE `abonne`
  MODIFY `id_abonne` int(3) NOT NULL AUTO_INCREMENT;

CREATE TABLE `livre` (
	id_livre INT(3),
	auteur VARCHAR(25),
	titre VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `livre`
  ADD PRIMARY KEY (`id_livre`);

ALTER TABLE `livre`
  MODIFY `id_livre` int(3) NOT NULL AUTO_INCREMENT;

CREATE TABLE `emprunt` (
	id_emprunt INT(3),
	id_livre INT(3),
	id_abonne INT(3),
	date_sortie DATE,
	date_rendu DATE DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id_emprunt`);

ALTER TABLE `emprunt`
  MODIFY `id_emprunt` int(3) NOT NULL AUTO_INCREMENT,
  ADD KEY `id_livre` (`id_livre`),
  ADD KEY `id_abonne` (`id_abonne`);


