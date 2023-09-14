<?php
$topics = $result["data"]['topics'];
$categorie= $result["data"]["nomCategorie"];
$AllCategories=$result["data"]["AllCategories"];
$tab=[];
foreach($AllCategories as $Allcategorie){
$tab[$Allcategorie->getId()] = $Allcategorie->getNom();
}

?>




<div class="all_categories">
<h1 class="titre_page"><a href="index.php?ctrl=forum&action=listCategories"> Categories </a> >
<a href="index.php?ctrl=forum&action=listCategorieTopics&id=<?=$categorie->getId()?>"><?= $categorie->getNom() ?></a> > </h1> 
<?php
    $x=1;
    if( $topics ){
        foreach($topics as $topic ){
        
        
        ?>  
        
        <div class="categorie_affichage" style="display:flex;">
                <div class="titre_nbr_categorie">
                    <p class="categorie_nbr"><?=($x<10)? '0'.$x:$x ?></p>
                    <a  class="categorie_titre2" href="index.php?ctrl=forum&action=listTopicPosts&id=<?=$topic->getId()?>">
                    <?= $topic->getTitre() ?></a>
                </div>

                <div class="nbp_nbt_categorie">
                    

                    <div class="activité_categorie">
                        <p>CREE </p>
                        <p> <?=$topic->getDateCreation() ?> </p>
                    </div>

                    <div class="activité_categorie">
                        <p>MODIFIER</p>
                        <?php if ($topic->getDateModif()  != null ) {?>
                            <p><?=$topic->getDateModif()?></p>
                        <?php }else { ?> 
                            <p>Jamais</p>
                        <?php } ?>
                    </div>
                    
                    <div class="popularité_categorie">
                    <?php if ( $topic->getUser() != null ) { ?>
                        <a class="topic_creator" href="index.php?ctrl=security&action=profile&id=<?=$topic->getUser()->getId() ?>"><?=$topic->getUser() ?> </a>
                    <?php } else { ?><p class="topic_creator"><?= "( utilisateur Supprimer )" ?> </p> <?php } ?>
                    </div>

                    
                        <div class="edit_supp">
                            <?php  if (isset($_SESSION["user"]) && $topic->MadeBy($_SESSION["user"]) ) {?> 
                            <!-- boutton supprimer  -->
                            <a class="supp_btn" href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>"><i class="fa-solid fa-trash"></i> </a>

                            <!-- button qui affiche le form de modification  -->
                            <button class="edit_btn" onclick=" if( document.querySelector('.FormTopic<?=$x?>').classList.contains('FormActive') ){
                            document.querySelector('.FormTopic<?=$x?>').classList.remove('FormActive')}else  {
                            document.querySelector('.FormTopic<?=$x?>').classList.add('FormActive') }"><i class="fa-solid fa-pen-to-square"></i></button>
                        </div>

                        <!-- boutton verouiller -->
                        <a href="index.php?ctrl=forum&action=lock&id=<?=$topic->getId()?>"> 
                        <?php if( $topic->getFermer() == 1) {?>
                            <i class="fa-solid fa-lock"></i> <?php }
                        else {?><i class="fa-solid fa-unlock"></i> <?php } ?>   
                        </a> 
                 
                    
                        <?php } else { ?> 
                        <p> <?php if( $topic->getFermer() == 1) {?>
                                <i class="fa-solid fa-lock"></i> </div> <?php }
                            else {?> </div> <?php } ?> </p>
                        <?php } ?>


                    

                </div>
           </div>

            <form class="FormTopic FormTopic<?=$x?>"method="post" action="index.php?ctrl=forum&action=editTopic&id=<?= $topic->getId() ?>">
            <p><label>Titre du topic</label>
            <input value="<?= $topic->getTitre() ?>" type="text" name="titre" required></p>
            <p><label>verouiller ?</label>
                <select name="fermer" >
                    <option selected value=0>non</option>
                    <option value=1>oui</option> 
                </select>
            </p>
            <label >categorie</label>
            <select name="categorie">
                <?php foreach ($tab as $id=>$nom){
                    if ($categorie->getId() != $id){?>
                    <option value="<?= $id ?>"><?= $nom ?></option>
                <?php } else {?> 
                    <option selected value="<?= $id ?>"><?= $nom ?></option>
                    <?php } }?>
            </select>  
            <input  id="SubmitEditTopic" type="submit" name="submit" value="submit">

            </form>
            <?php
            $x+=1;

    
    } } else {
    
        ?> <p>cette categorie n'a aucun topic</p>
    <?php } ?> 

</div>
<?php

if(App\Session::getUser()){?>


<form class="FormNewTopic" method="post" action="index.php?ctrl=forum&action=nvTopic&id=<?= $categorie->getId() ?>">
    <label>TITRE</label>
    <input placeholder="Titre du Topic" type="text" name="titre" required>
    <label>TEXTE</label>
<div class="div_form">
    <textarea  name="message" required></textarea>

    <input class="submit_categorie" type="submit" name="submit" value="submit">
</div>
</form>
<?php
} else { ?> 
    <p class="p_disconnected">
        <a href="index.php?ctrl=security&action=login">Connecter</a>
        ou 
        <a href="index.php?ctrl=security&action=register"> Inscriver</a>
        vous pour ajouter un post !

    </p> <?php }

