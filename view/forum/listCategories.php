<?php
$categories = $result["data"]['categories'];
?>
<h1 class="titre_page">liste categories</h1>
<div >
<?php
    $x=1;
    foreach($categories as $id=>$categorie ){
        
        ?>  <div class="categorie_affichage"  >
                <p><?= $x ?></p>
                <a href="index.php?ctrl=forum&action=listCategorieTopics&id=<?=$id?>">
                <?=$categorie[0]["nom"]?></a><br>
                <p>posts : <?= $categorie[0]["nbPosts"]?> </p>
                <p>topics :<?= $categorie[0]["nbTopics"]?> </p> 
                <p>dernier topic crée le : <?= $categorie[0]["lastPostDate"]?> </p>
            </div>
        <?php
    $x+=1;
    } ?> 

</div>


  
