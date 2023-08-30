<?php
$topics = $result["data"]['topics'];
$categorie= $result["data"]["nomCategorie"];

?>
<h1>categorie : <?= $categorie->getNom() ?></h1>
<?php
$x=1;
if( $topics ){
foreach($topics as $topic ){
    
    ?>
    <div style="display:flex;">
        <a href="index.php?ctrl=forum&action=listTopicPosts&id=<?=$topic->getId()?>">
        Topic <?= $x." : ". $topic->getTitre()?></a> <br>
        <a style="color:red ;" href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer ce topic</a>
    </div>
    
    <?php
    $x+=1;
}}
else {
    
    ?> <p>cette categorie n'a aucun topic</p>
<?php } ?>

<form method="post" action="index.php?ctrl=forum&action=nvTopic&id=<?= $categorie->getId() ?>">
    <p><label>Titre du topic</label>
    <input type="text" name="titre" required></p>

    <p><label>Premier message</label>
    <input type="text" name="message" required></p>

    <input  type="submit" name="submit" value="submit">
</form>