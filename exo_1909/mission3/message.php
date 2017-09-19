<ul>
    <a href="?nationalite=français"><li>France</li></a>
    <a href="?nationalite=italien"><li>Italie</li></a>
    <a href="?nationalite=espagnol"><li>Espagne</li></a>
    <a href="?nationalite=anglais"><li>Angleterre</li></a>
</ul>
<br>
<hr>
<br>

<?php echo ((isset($_GET['nationalite']))?"Vous êtes ".$_GET['nationalite'].' ?':''); ?>
