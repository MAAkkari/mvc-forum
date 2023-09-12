<?php
$topics = $result["data"]['topics'];
$categorie= $result["data"]["nomCategorie"];
$AllCategories=$result["data"]["AllCategories"];
$tab=[];
foreach($AllCategories as $Allcategorie){
$tab[$Allcategorie->getId()] = $Allcategorie->getNom();
}

?>

<p><a href="index.php?ctrl=forum&action=listCategories"> Categories </a> >
 <a href="index.php?ctrl=forum&action=listCategorieTopics&id=<?=$categorie->getId()?>"><?= $categorie->getNom() ?></a> > </p>

<?php
$x=1;
if( $topics ){
    foreach($topics as $topic ){
        
        ?>
        <div class="flex">
            <a href="index.php?ctrl=forum&action=listTopicPosts&id=<?=$topic->getId()?>">
            Topic <?= $x." : ". $topic->getTitre()?></a> <br>
            <p> <?=$topic->getDateCreation() ?> </p>
            <?php if ( $topic->getUser() != null ) { ?>
                <a href="index.php?ctrl=security&action=profile&id=<?=$topic->getUser()->getId() ?>">de: <?=$topic->getUser() ?> </a>
            <?php } else { ?><p>de: <?= "(utilisateur Supprimer)" ?> </p>
            <?php } if ($topic->getDateModif()  != null ) {?>
            <p>modifier le : <?=$topic->getDateModif()?></p>



            <?php } if (isset($_SESSION["user"]) && $topic->MadeBy($_SESSION["user"]) ) {?> <p>
            <a style="color:red ;" href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer </a>
            <button onclick=" if( document.querySelector('.FormTopic<?=$x?>').classList.contains('FormActive') ){
                document.querySelector('.FormTopic<?=$x?>').classList.remove('FormActive')}else  {
            document.querySelector('.FormTopic<?=$x?>').classList.add('FormActive') }">modifié</button>


            

            <a href="index.php?ctrl=forum&action=lock&id=<?=$topic->getId()?>"> 
                    <?php if( $topic->getFermer() == 1) {?>
                        <i class="fa-solid fa-lock"></i> <?php }
                    else {?><i class="fa-solid fa-unlock"></i> <?php } ?>   
            </a> 
            </p>
            <?php } else { ?> 
                <p> <?php if( $topic->getFermer() == 1) {?>
                        <i class="fa-solid fa-lock"></i> <?php }
                    else {?> <?php } ?> </p>
            <?php } ?>

        
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
            <input  class="SubmitEditTopic" type="submit" name="submit" value="submit">

        </form>
        <?php
        $x+=1;
    } 
}
else {
    
    ?> <p>cette categorie n'a aucun topic</p>
<?php } 

if(App\Session::getUser()){?>


<form method="post" action="index.php?ctrl=forum&action=nvTopic&id=<?= $categorie->getId() ?>">
    <p><label>Titre du topic</label>
    <input type="text" name="titre" required></p>

    <p><label>Premier message</label>
    <input type="text" name="message" required></p>

    <input  type="submit" name="submit" value="submit">
</form>
<?php
} else { ?> 
    <p>
        <a href="index.php?ctrl=security&action=login">Connecter</a>
        ou 
        <a href="index.php?ctrl=security&action=register"> Inscriver</a>
        vous pour ajouter un post !

    </p> <?php }