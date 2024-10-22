<?php

function getComments(string $postId) {
    $database = dbConnect();
    $statement = $database->prepare(
        "SELECT author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date
        FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );
    $statement->execute([$postId]);

    $comments = [];
    while ($row = $statement->fetch()) {
        $comment = [
            'author' => $row['author'],
            'french_creation_date' => $row['french_creation_date'],
            'comment' => $row['comment'],
        ];
        $comments[] = $comment;
    }

    return $comments;
}


function createComment(string $postId, string $author, string $comment) {
    $database = dbConnect();
    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$postId, $author, $comment]);

    return ($affectedLines > 0);
}
