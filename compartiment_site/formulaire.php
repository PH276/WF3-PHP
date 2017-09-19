<?php
include('inc/header.inc.php');
include('inc/nav.inc.php');
?>
<main> <!-- Main : Contenu principal de la page-->
    <h2>Formulaire</h2>
    <section class="formulaire">
        <form method="post" action="url de destination" enctype="multipart/form-data">
            <label for="pseudo">Pseudo *</label>
            <input type="text" id="pseudo" name="pseudo" required><br>

            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom"><br>

            <label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp"><br>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email"><br>

            <label>Date de naissance</label>
            <select >
                <?php
                for ($i=1;$i<=31;$i++){
                    if ($i<10){
                        echo '<option>0'. $i .'</option>';
                    } else{
                        echo '<option>'. $i .'</option>';
                    }
                }
                 ?>
            </select>
            <select >
                <option>Janvier</option>
            </select>
            <select >
                <?php
                $i =date ('Y') - 18;
                while ($i>=1950){
                    echo '<option>'.$i--.'</option>';
                }
                ?>
            </select>


            <label for="cv">CV</label>
            <input type="file" id="cv" name="cv"><br>

            <p>Quels sont vos fruits préférés ?</p>
            <label for="orange">Orange</label>
            <input type="checkbox" id="orange" value="orange" checked>
            <label for="fraise">Fraise</label>
            <input type="checkbox" id="fraise" value="fraise">
            <label for="mangue">Mangue</label>
            <input type="checkbox" id="mangue" value="mangue"><br>

            <label for="cp">Code postal</label>
            <input type="text" id="cp" name="cp" max-length="5" pattern="[0-9]{5}" title="5 chiffres entre 0 et 9"><br>

            <label for="message">Message</label>
            <textarea id="message" rows="6" cols="30"></textarea><br>

            <input type="submit" name="Envoyer" value="Envoyer">
            <input type="reset" name="Annuler" value="Annuler">





        </form>
    </section>
</main>

<a href="#logo"><button type="button"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button></a>


<aside><!--Aside : Contenu secondaire -->

</aside>
<section> <!-- Section : Zone de contenu : titre, texte, regroupement thématique-->
    <div> <!-- Div : Zone supplémentaire de contenu-->

    </div>
    <span> <!-- Span : Zone supplémentaire de contenu-->

    </span>
    <article> <!-- Article : Zone supplémentaire de contenu-->

    </article>
</section>
</main>
<section>
    <a href="#logo"><button type="button"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button></a>
</section>
<?php
include('inc/footer.inc.php');
?>
