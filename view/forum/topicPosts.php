<?php 
    $posts = $result["data"]["posts"];
    $topic =$result["data"]["topic"];
   
?>
<h1> topic > <?= $topic->getTitre()?></h1>


<?php if($posts ){
 foreach($posts as $post){ ?>
<p><?= $post->getText() ?></p> 
<a style="color:red ;" href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">Supprimer ce post</a>
<?php }}
else { echo " il n'y aucun post dans ce topic ";} ?>

<form method="post" action="index.php?ctrl=forum&action=nvPost&id=<?= $topic->getId() ?>">
<p><label>Text</label>
    <input type="text" name="text" required></p>

    <input  type="submit" name="submit" value="submit">
</form>
