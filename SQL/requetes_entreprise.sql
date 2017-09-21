mysql -u root -p

-- voir toutes les DB
show databases;

-- supprimer un DB
drop databases nom_de_la_BD;

-- se connecter à la BD jeudi;
use jeudi;

-- voir toutes les BD de la BD
show tables;

-- créer un BD;
create database nom_de_la_BD;

-- selectionner tout
select * from employes;

-- afficher les employes + salaire
select prenom, nom, salaire from employes;

-- afficher ts les services de l'entreprise (et non le service de chaque employe)
select distinct service from employes;

-- afficher les employes de service informatique
select prenom, nom, service from employes where service='informatique';

-- afficher les employes qui ne sont pas de service informatique
select prenom, nom, service from employes where service<>'informatique'; -- ou '<>'

-- afficher les employes qui gagne un salaire > à 200€
select prenom, nom, salaire from employes where salaire>2000;

-- afficher combien d'employes qui gagne un salaire < à 200€
select count(*) from employes where salaire<=2000;
-- ou
select count(*) as somme from employes where salaire<=2000; -- as : alias

-- afficher la masse salariale de mon entreprise
select 12*sum(salaire) from employe;

select prenom from employe where prenom like 'a%'; -- commence par
select prenom from employe where prenom like '%a%'; -- contient
select prenom from employe where prenom like '%a'; -- fini

-- afficher ts les employes ds l'order de celui qui gagne
select prenom from employes order by salaire desc;

-- afficher les 3 employes qui gagne un salaire
select prenom, salaire from employes order by salaire desc limit 0, 3;

--afficher qui gagne le moins
select prenom, salaire from employes order by salaire asc limit 0, 1;

--afficher qui gagne le moins avec min
select prenom from employes where salaire=(select min(salaire) from employes);

-- afficher ts du service informatique et commercial
select prenom, nom, service from employes where service='informatique' or service='commercial';
select prenom, nom, service from employes where service in ('informatique', 'commercial');

-- afficher ts hors du service informatique et commercial
select prenom, nom, service from employes where service!='informatique' and service!='commercial';
select prenom, nom, service from employes where service not in ('informatique', 'commercial');

-- afficher le nb de femmes
select count(*) from employes where sexe='f';

-- afficher le nb d'employe par sexe
select sexe, count(*) from employes group by sexe;
-- afficher le nb d'employe des services informatique et commercial
select service, count(*) from employes group by service having service='informatique' or service='commercial';

----------------------------
-- insertion
--------------------------
INSERT into employes(prenom, nom, service, sexe, salaire, date_embauche) VALUES ('Yakine', 'Hamida', 'informatique', 'm', 5000, curdate());

----------------------------
-- modification
--------------------------
-- modification de tout
update employes set salaire = 3000;

-- modification de Julien
update employes set salaire = 3500 where id_employes=991;  -- prenom='julien';
replace into employes(id_employes, prenom, nom, service, salaire, date_embauche, sexe) VALUES (991, 'Yakine', 'Hamida', 'informatique', 'm', 6000, curdate());


update employes set service = 'marketing', salaire=3200 where id_employes=547;


    ----------------------------
--    suppression
    --------------------------
delete from employes where id_employes=991;


------
