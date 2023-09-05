<?php 
    $posts = $result["data"]["posts"];
    $topic =$result["data"]["topic"];
   
?>
<div class="LiensPathForum">

    <a href="index.php?ctrl=forum&action=listCategories">Liste catrogories</a> 
    <p>> </p> 
    <a href="index.php?ctrl=forum&action=listCategorieTopics&id=<?=$topic->getCategorie()->getId()?>">
    <?= $topic->getCategorie()->getNom()?></a>
    <p>> </p>
    <p><?= $topic->getTitre()?></p>

</div>


<?php $x=1;
if($posts ){
 foreach($posts as $post){ ?>
    <div class="flex" >

        <p><?=  htmlspecialchars_decode($post->getText())  ?></p> 
        <a style="color:red ;" href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">Supprimer ce post</a>
        <button onclick=" if( document.querySelector('.FormTopic<?=$x?>').classList.contains('FormActive') ){
        document.querySelector('.FormTopic<?=$x?>').classList.remove('FormActive')} else {
        document.querySelector('.FormTopic<?=$x?>').classList.add('FormActive') }">modifier</button>

    </div>

    <form class="FormTopic FormTopic<?=$x?>"method="post" action="index.php?ctrl=forum&action=editPost&id=<?= $post->getId() ?>">

        <p><label>texte</label>
        <input class="post" value="<?= $post->getText() ?>" type="text" name="text" required></p>
        <input  class="SubmitEditTopic" type="submit" name="submit" value="submit">

    </form>
   
<?php  $x+=1; }
}
else { echo " il n'y aucun post dans ce topic ";} 
if ($topic->getFermer()==0){ ?>

<form method="post" action="index.php?ctrl=forum&action=nvPost&id=<?= $topic->getId() ?>">
<p><label>Text</label>
    <input type="text" name="text" required></p>

    <input  type="submit" name="submit" value="submit">
</form>
<?php } else { ?> <p>Ce Topic est Verrouiller impossible d'ajouter des posts </p><?php }