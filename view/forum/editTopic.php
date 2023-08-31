<?php 
$topic = $result["data"]['topic'];

?>
<form method="post" value =" " action="index.php?ctrl=forum&action=nvTopic&id=<?= $categorie->getId() ?>">
    <p><label>Titre du topic</label>
    <input type="text" name="titre" required></p>

    <p><label>Premier message</label>
    <input type="text" name="message" required></p>

    <input  type="submit" name="submit" value="submit">
</form> 