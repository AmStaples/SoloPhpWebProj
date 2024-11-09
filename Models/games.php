<?php
namespace games;
//AS - Get All function
function get_all_games() {
    global $db;
    $query = 'SELECT * FROM games';
    $statement = $db->prepare($query);
    $statement->execute();
    $media = $statement->fetchAll();
    $statement->closeCursor();
    return $media;
}
//to be used later
function get_games_by_category($GenreName) {
    global $db;
    $query = 'SELECT * FROM games
              WHERE GameGenre = :GenreName';
    $statement = $db->prepare($query);
    $statement->bindValue(':GenreName', $GenreName);
    $statement->execute();
    $media = $statement->fetchAll();
    $statement->closeCursor();
    return $media;
}

//allows you to grab a product to update it //AS - This does not update. it just gets.
function get_game($game_id) {
    global $db;
    $query = 'SELECT * FROM games
              WHERE GameID = :game_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':game_id', $game_id);
    $statement->execute();
    $media = $statement->fetch();
    $statement->closeCursor();
    return $media;
}
//allows you to delete a movie/game/book
function delete_game($game_id) {
    global $db;
    $query = 'DELETE FROM games
              WHERE GameID = :game_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':game_id', $game_id);
    $statement->execute();
    $statement->closeCursor();
}
//allows you to add a movie/game/book //AS - Do not ever let a user edit the ID field.
                                      //I changed this to UPDATE as thats the only thing you should use ID for.
function update_game($game_id, $release, $name, $developer, $publisher, $rating, $genre) {
    global $db;
    $query = 'UPDATE games
              SET GameName = :game_name, ReleaseYear = :release, Rating = :rating, Developer = :developer, Publisher = :publisher, GameGenre = :genre
              WHERE GameID = :game_id';
    
    $statement = $db->prepare($query);
    $statement->bindValue(':game_id', $game_id);
    $statement->bindValue(':release', $release);
    $statement->bindValue(':game_name', $name);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':developer', $developer);
    $statement->bindValue(':publisher', $publisher);
    $statement->bindValue(':genre', $genre);
    $statement->execute();
    $statement->closeCursor();
}

//AS - Took the old add_product and removed the ID field. Leaving the ID field blank will auto generate an ID.
function add_game($release, $name, $developer, $publisher, $rating, $genre) {
    global $db;
    $query = 'INSERT INTO games
                 (GameName, ReleaseYear, Rating, Developer, Publisher, GameGenre)
              VALUES
                 (:game_name, :release, :rating, :developer, :publisher, :genre)';
    $statement = $db->prepare($query);
    $statement->bindValue(':release', $release);
    $statement->bindValue(':game_name', $name);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':developer', $developer);
    $statement->bindValue(':publisher', $publisher);
    $statement->bindValue(':genre', $genre);
    $statement->execute();
    $statement->closeCursor();
}
?>
