<?php
$categories = $result["data"]['categories'];
?>
<h1>liste categories</h1>
<?php

foreach($categories as $categorie ){
    ?>
        <a href="index.php?ctrl=forum&action=listCategorieTopics&id=<?=$categorie->getId()?>">
        <?=$categorie->getNom()?></a><br>
    <?php

}


  
