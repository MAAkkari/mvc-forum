<?php 
    $posts = $result["data"]["posts"];
    $topic =$result["data"]["topic"];
   
?>
<h1> topic > <?= $topic->getTitre()?></h1>


<?php if($posts ){
 foreach($posts as $post){ ?>
<p><?= $post->getText() ?></p> 
<?php }}
else { echo " il n'y aucun post dans ce topic ";} ?>

<form action=""></form>

