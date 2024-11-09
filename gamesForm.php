<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link ref="stylesheet" href="./WebProject.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>    
  </head>
  <body>
    


    <?php 
    $IDPresent = true;
    //AS - Checking if we have a game id to see if we are adding a new entry or editing an exisiting one.
    $game_ID = filter_input(INPUT_POST, 'game_ID');
    if ($game_ID == NULL) {
      $gameID = filter_input(INPUT_GET, 'game_ID');
      if ($game_ID == NULL) {
        $IDPresent = false;
      }
    }
    //AS - Store the target row data inside a variable for use
    if ($IDPresent == true) {
      $target = games\get_game($game_ID);
    }
    ?>
    <h1><?php if ($IDPresent == true) { 
      echo "Update";
    } else echo "Add"; ?> game</h1>
    <!-- // games Forms -->
    <form action="index.php" method="post">

    <label for="gameName">game:</label>
    <input type="text" id="gameName" 
    name="gameName" value="<?php 
        if ($IDPresent == true) {
          echo $target['GameName'];
        };?>">
        <br>

    <label for="ReleaseYear">Year: </label>
    <input type="text" id="ReleaseYear"
    name="ReleaseYear" value="<?php 
        if ($IDPresent == true) {
          echo $target['ReleaseYear'];
        };?>"><br>

    <label for="Developer">Developer: </label>
    <input type="text" id="Developer"
    name="Developer" value="<?php 
        if ($IDPresent == true) {
          echo $target['Developer'];
        };?>"><br>

    <label for="Publisher"> Publisher:  </label>
    <input type="text" id="Publisher"
    name="Publisher" value="<?php 
        if ($IDPresent == true) {
          echo $target['Publisher'];
        };?>"><br>

    <label for="gameGenre"> Genre: </label>
    <input type="text" id="gameGenre"
    name= "gameGenre" value="<?php 
        if ($IDPresent == true) {
          echo $target['GameGenre'];
        };?>"><br>

    <label for="Rating"> Rating: </label>
    <input type="text" id="Rating" name="Rating" value="<?php
    if ($IDPresent == true) {echo $target['Rating'];};?>"><br>

    <input type="hidden" name="action" value="<?php 
    if ($IDPresent == true) { 
      echo "update_game";
    } else echo "add_game";?>">

    <?php 
    if ($IDPresent == true) {
      echo "<input type=\"hidden\" name=\"gameID\" value=" . $game_ID
       . "\">";
    }
    ?>
    <input type="submit" value="Confirm">
    
    </form>
  </body>
</html>
