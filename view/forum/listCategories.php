<?php
$categories = $result["data"]['categories'];
?>
<h1>liste categories</h1>
<?php

foreach($categories as $id=>$categorie ){
    
    ?>  <div class="categorie_affichage"  >
            <a href="index.php?ctrl=forum&action=listCategorieTopics&id=<?=$id?>">
            <?=$categorie[0]["nom"]?></a><br>
            <p>posts : <?= $categorie[0]["nbPosts"]?> </p>
            <p>topics :<?= $categorie[0]["nbTopics"]?> </p> 
            <p>dernier topic crée le : <?= $categorie[0]["lastPostDate"]?> </p>
        </div>
    <?php

}


  
