<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
if ( $topics ){
foreach($topics as $topic ){
    ?>
  <a  href="index.php?ctrl=forum&action=listTopicPosts&id=<?=$topic->getId()?>">
  <?=$topic->getTitre()?></a>
    <?php
}

}else { echo " il n'y aucun topic dans la base de donnée ";}
  
