<?php
$topic = $result['topics'];
$categorie = $topics->getCategorie();
?>

<form method="post" action="index.php?ctrl=forum&action=editTopic&id=<?= $topic->getId() ?>">
    <p><label>Titre du topic</label>
    <input type="text" name="titre" required></p>

    <p><label>Premier message</label>
    <input type="text" name="message" required></p>

    <input  type="submit" name="submit" value="submit">
</form>