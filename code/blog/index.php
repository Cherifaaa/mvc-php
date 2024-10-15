<?php
try {
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'password');
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}


$statement = $database->query(
    "SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr 
    FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
);

$posts = [];
while ($row = $statement->fetch()) {
    $post = [
        'title' => $row['titre'],
        'french_creation_date' => $row['date_creation_fr'],
        'content' => $row['contenu'],
    ];
    $posts[] = $post;
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Le blog de l'AVBN</title>
    <link href="style.css" rel="stylesheet" />
</head>
<body>
    <h1>Le super blog de l'AVBN !</h1>
    <p>Derniers billets du blog :</p>

    <?php foreach ($posts as $post): ?>
        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']); ?>
                <em>le <?= $post['frenchCreationDate']; ?></em>
            </h3>
            <p>
                <?php
                echo nl2br(htmlspecialchars($post['content'])); 
                ?>
                <br />
                <em><a href="#">Commentaires</a></em>
            </p>
        </div>
    <?php endforeach; ?>
</body>
</html>
