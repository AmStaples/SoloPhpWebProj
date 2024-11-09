<?php
namespace genre;
//to be used later
function get_media_by_category($category_id) {
    global $db;
    $query = 'SELECT * FROM media
              WHERE media.categoryID = :category_id
              ORDER BY mediaID';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $media = $statement->fetchAll();
    $statement->closeCursor();
    return $media;
}
//allows you to grab a product to update it
function get_product($genre_id) {
    global $db;
    $query = 'SELECT * FROM genre
              WHERE GenreID = :genre_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_id', $genre_id);
    $statement->execute();
    $media = $statement->fetch();
    $statement->closeCursor();
    return $media;
}
//allows you to delete a movie/game/book
function delete_media($genre_id) {
    global $db;
    $query = 'DELETE FROM genre
              WHERE GenreID = :genre_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_id', $genre_id);
    $statement->execute();
    $statement->closeCursor();
}
//allows you to add a movie/game/book
function add_product($genre_id, $name) {
    global $db;
    $query = 'INSERT INTO media
                 (GenreID, GenreName)
              VALUES
                 (:genre_id, :name_)';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_id', $genre_id);
    $statement->bindValue(':name_', $name);
    $statement->execute();
    $statement->closeCursor();
}
?>