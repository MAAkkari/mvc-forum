<?php
$user = $result["data"]['user'];
$topics = $result["data"]['topics'];
$posts = $result["data"]['posts'];




?>

<p>pseudo : <?= $user->getPseudo() ?></p>
<p>inscrit depuis le : <?= $user->getDateInscription() ?></p>
<?php if ( isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION["user"]->getId() == $user->getId()) {?>
    <p>email : <?= $user->getEmail() ?></p>
<?php }?>

<h3>dernier topics de <?= $user->getPseudo() ?></h3>


<div class="flexVertical ">
<?php if ( $topics != null ){ $x=1;
    foreach($topics as $topic){ 
       ?>
    <div class="flex">
        <a href="index.php?ctrl=forum&action=listTopicPosts&id=<?=$topic->getId()?>">
        <?= $topic->getTitre() ?> </a>
        <p> crée le <?= $topic->getDateCreation() ?> , <?php
        if ($topic->getDateModif() != null ){ ?> 
        modifer le : <?= $topic->getDateModif() ?>
        <?php } ?> 
        </p>
    </div>
<?php $x+=1; 
if ($x >= 5) {
        break; 
    }} }else {?><p>Cet utilisateur n'a publicer aucun topic :c</p> <?php } ?>
</div>
<h3>dernier posts <?= $user->getPseudo() ?></h3>

<div class="flexVertical ">
<?php 
if ( $posts != null ){$y=1;

    foreach($posts as $post){ ?>
    
    <a href="index.php?ctrl=forum&action=listTopicPosts&id=<?=$post->getTopic()->getId()?>">
    <?= htmlspecialchars_decode($post->getText()) ?></a>
<?php $y+=1; 
if ($y >= 5) {
        break;
    }} }else{ ?><p>cet utilisateur n'a publier aucun post :c</p><?php } 

