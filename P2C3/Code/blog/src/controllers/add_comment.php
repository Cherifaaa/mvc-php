<?php

require_once('src/model/comment.php');

function addComment(string $postId, array $input) {

    if (!empty($input['author']) && !empty($input['comment'])) {
        $author = $input['author'];
        $comment = $input['comment'];
    } else {
        throw new Exception('Les données du formulaire sont invalides.');
    }

    $success = createComment($postId, $author, $comment);

    if (!$success) {
        throw new Exception('Impossible d\'ajouter le commentaire.');
    } else {

        header('Location: index.php?action=post&id=' . $postId);
    }
}
