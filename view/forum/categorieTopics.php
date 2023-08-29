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
        <a href="index.php?ctrl=forum&action=listTopicPosts&id=<?=$topic->getId()?>">
        Topic <?= $x." : ". $topic->getTitre()?></a> <br>

    <?php
    $x+=1;
}}
else {
    
    ?> <p>cette categorie n'a aucun topic</p>
<?php }