<?php
    $dsn = 'mysql:host=localhost;dbname=top2000;charset=utf8';
    $username = 'root';
    $password = 'root';

    try {
        $connection = new PDO($dsn, $username, $password);
        $statement = $connection->prepare('SELECT `top2000id`, `position`, `title`, `artist`, `year`, `playtime` FROM `2016` WHERE ((`title` LIKE :title) AND (`artist` LIKE :artist) AND (`year` LIKE :year) AND ((`position` >= :offset) AND (`position` <= :limit))) ORDER BY `position`;');

        $songs = array();
        $title = (isset($_GET['title']) ? ('%' . $_GET['title'] . '%') : '%');
        $artist = (isset($_GET['artist']) ? ('%' . $_GET['artist'] . '%') : '%');
        $year = (isset($_GET['year']) ? ('%' . $_GET['year'] . '%') : '%');
        $offset = (isset($_GET['offset']) && is_numeric($_GET['offset']) ? $_GET['offset'] : 1);
        $limit = (isset($_GET['limit']) && is_numeric($_GET['limit']) ? $_GET['limit'] : 125);

        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':artist', $artist, PDO::PARAM_STR);
        $statement->bindParam(':year', $year, PDO::PARAM_STR);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        foreach($statement->fetchAll() as $song) {
            $songs[sizeof($songs)] = array(
                'id' => $song['top2000id'],
                'position' => $song['position'],
                'title' => $song['title'],
                'artist' => $song['artist'],
                'year' => $song['year'],
                'playtime' => $song['playtime']
            );
        }

        print(json_encode($songs));
    } catch(PDOException $exception) {
        print('Connection Failed: ' . $exception->getMessage());
    }
?>
