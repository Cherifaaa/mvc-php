<?php

require_once('src/lib/database.php');
require_once('src/model/post.php');
require_once('src/model/comment.php');

function post(string $identifier) {
    $connection = new DatabaseConnection();
    $postRepository = new PostRepository(); 
    $postRepository->connection = $connection; 
    $post = $postRepository->getPost($identifier);
    $comments = getComments($identifier);

   
    require('templates/post.php');
}

