<?php

require('src/model.php'); 


if (isset($_GET['id']) && $_GET['id'] > 0) {
    $identifier = $_GET['id'];

  
    $post = getPost($identifier);
    $comments = getComments($identifier);

   
    require('templates/post.php');
} else {
   
    echo 'Erreur : aucun identifiant de billet envoyé';
    die;
}
$post = getPost($identifier);
$comments = getComments($identifier);
require('templates/post.php');
