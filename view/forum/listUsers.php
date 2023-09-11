<?php 
$users = $result["data"]['user'];

foreach($users as $user){
?>
<a href="index.php?ctrl=security&action=profile&id=<?= $user->getId() ?>"><?= $user->getPseudo() ?></a>
<a style ="color:red ;" href="index.php?ctrl=security&action=deleteUser&id=<?= $user->getId() ?>">supprimer</a>
<br>


<?php } ?>