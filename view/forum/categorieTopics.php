<?php
$topics = $result["data"]['topics'];
$categorie= $result["data"]["nomCategorie"];
$AllCategories=$result["data"]["AllCategories"];
$tab=[];
foreach($AllCategories as $Allcategorie){
$tab[$Allcategorie->getId()] = $Allcategorie->getNom();
}

?>
<h1>categorie : <?= $categorie->getNom() ?></h1>
<?php
$x=1;
if( $topics ){
    foreach($topics as $topic ){
        
        ?>
        <div class="flex">
            <a href="index.php?ctrl=forum&action=listTopicPosts&id=<?=$topic->getId()?>">
            Topic <?= $x." : ". $topic->getTitre()?></a> <br>
            <a style="color:red ;" href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer </a>
            <button onclick=" if( document.querySelector('.FormTopic<?=$x?>').classList.contains('FormActive') ){
                document.querySelector('.FormTopic<?=$x?>').classList.remove('FormActive')}else  {
            document.querySelector('.FormTopic<?=$x?>').classList.add('FormActive') }">modifier</button>

        
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
<?php } ?>

<form method="post" action="index.php?ctrl=forum&action=nvTopic&id=<?= $categorie->getId() ?>">
    <p><label>Titre du topic</label>
    <input type="text" name="titre" required></p>

    <p><label>Premier message</label>
    <input type="text" name="message" required></p>

    <input  type="submit" name="submit" value="submit">
</form>