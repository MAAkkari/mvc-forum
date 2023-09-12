<?php
$categories = $result["data"]['categories'];
$totalTopics = $result["data"]['totalTopics'];
?>


<div class="all_categories">
    <h1 class="titre_page">liste categories ></h1>
<?php
    $x=1;
    foreach($categories as $id=>$categorie ){
        $popularity= ($categorie[0]["nbTopics"] / $totalTopics) *100;
        
        ?>  <div class="categorie_affichage">
                

                <div class="titre_nbr_categorie">
                    <p class="categorie_nbr"><?=($x<10)? '0'.$x:$x ?></p>
                    <a class="categorie_titre" href="index.php?ctrl=forum&action=listCategorieTopics&id=<?=$id?>">
                    <?=$categorie[0]["nom"]?></a><br>
                </div>

                <div class="nbp_nbt_categorie">
                    <div class="nbp_categorie">
                        <p>POSTS</p>
                        <h4><?= ($categorie[0]["nbPosts"] < 10) ? '00' . $categorie[0]["nbPosts"] : ($categorie[0]["nbPosts"] < 100 ? '0' . $categorie[0]["nbPosts"] : $categorie[0]["nbPosts"]) ?></h4>
                    </div>

                    <div class="nbp_categorie">
                        <p>TOPICS</p> 
                        <h4><?= ($categorie[0]["nbTopics"] < 10) ? '00' . $categorie[0]["nbTopics"] : ($categorie[0]["nbTopics"] < 100 ? '0' . $categorie[0]["nbTopics"] : $categorie[0]["nbTopics"]) ?></h4>
                    </div>

                    <div class="activité_categorie">
                        <p>DERNIER POST</p>
                        <p><?= $categorie[0]["lastPostDate"]?> </p>
                    </div>
                    
                    <div class="popularité_categorie">
                        <p>POPULARITE</p>
                        <div class="black_line"><div class="orange_line" style="width:<?= $popularity ?>%"></div></div>
                    </div>

                </div>

                

                
            </div>
        <?php
    $x+=1;
    } ?> 

</div>


  
