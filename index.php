
<?php 

    //AS - Add in all Functions
    require_once('./Models/books.php');
    require_once('./Models/database.php');
    require_once('./Models/games.php');
    require_once('./Models/movies.php');
    require_once('./Models/genre.php');



    //AS - session data to store if you are working with media types or a genre
    $lifetime = (60 * 60 * 24) * 7; //AS - Lasts for a week
    session_set_cookie_params($lifetime, '/');
    session_start();
    if (empty($_SESSION['SortKey'])) {
        $_SESSION['SortKey'] = "None";
    }


    //AS - Grab action for use.
    $action = filter_input(INPUT_POST, 'action');
    if ($action === NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action === NULL) {
            $action = 'show_list';
        }
    }
    //AS - All HTML should come from the controller. There should never be an HTML file.
    switchstart: //label for goto. This is used to help get back to show_list from certain actions
    switch($action) {
        case 'show_list': //AS - Will show different lists based on a cookie.
            if(!empty($_POST['GenreSelector'])) {
                $_SESSION['SortKey'] = $_POST['GenreSelector'];
            }
            if ($_SESSION['SortKey'] == "None") {
                $books = books\get_all_books();
                $movies = movies\get_all_movies();
                $games = games\get_all_games();
                include('list.php');
            } else {
                $books = books\get_books_by_category($_SESSION['SortKey']);
                $movies = movies\get_movies_by_category($_SESSION['SortKey']);
                $games = games\get_games_by_category($_SESSION['SortKey']);
                include('selectedList.php');
            }
            
            break;
        case 'show_book_form':
            include('booksForm.php');
            break;
        case 'show_game_form':
            include('gamesForm.php');
            break;
        case 'show_movie_form':
            include('moviesForm.php');
            break;
        case 'add_book':
            $release = $_POST["ReleaseYear"];
            $name = $_POST["BookName"];
            $author = $_POST["Author"];
            $publisher = $_POST["Publisher"];
            $rating = $_POST["Rating"];
            $genre = $_POST["BookGenre"];
            books\add_book($release, $name, $author, $publisher, $rating, $genre);
            $action = 'show_list';
            goto switchstart; //AS - Discovered goto recently. Handy
            break;
        case 'add_movie':
            $release = $_POST["ReleaseYear"];
            $name = $_POST["movieName"];
            $director = $_POST["Director"];
            $publisher = $_POST["Publisher"];
            $rating = $_POST["Rating"];
            $genre = $_POST["movieGenre"];
            movies\add_movie($release, $name, $director, $publisher, $rating, $genre);
            $action = 'show_list';
            goto switchstart;
        case 'add_game':
            $release = $_POST["ReleaseYear"];
            $name = $_POST["gameName"];
            $developer = $_POST["Developer"];
            $publisher = $_POST["Publisher"];
            $rating = $_POST["Rating"];
            $genre = $_POST["gameGenre"];
            games\add_game($release, $name, $developer, $publisher, $rating, $genre);
            $action = 'show_list';
            goto switchstart;
        case 'delete_book':
            books\delete_book($_POST["book_ID"]);
            $action = 'show_list';
            goto switchstart;
        case 'delete_game':
            games\delete_game($_POST["game_ID"]);
            $action = 'show_list';
            goto switchstart;
        case 'delete_movie':
            movies\delete_movie($_POST["movie_ID"]);
            $action = 'show_list';
            goto switchstart;
        case 'update_book':
            $BookID = $_POST["BookID"];
            $release = $_POST["ReleaseYear"];
            $name = $_POST["BookName"];
            $author = $_POST["Author"];
            $publisher = $_POST["Publisher"];
            $rating = $_POST["Rating"];
            $genre = $_POST["BookGenre"];
            books\update_book($BookID, $release, $name, $author, $publisher, $rating, $genre);
            $action = 'show_list';
            goto switchstart;
        case 'update_movie':
            $MovieID = $_POST["movieID"];
            $release = $_POST["ReleaseYear"];
            $name = $_POST["movieName"];
            $director = $_POST["Director"];
            $publisher = $_POST["Publisher"];
            $rating = $_POST["Rating"];
            $genre = $_POST["movieGenre"];
            movies\update_movie($MovieID, $release, $name, $director, $publisher, $rating, $genre);
            $action = 'show_list';
            goto switchstart;
        case 'update_game':
            $GameID = $_POST["gameID"];
            $release = $_POST["ReleaseYear"];
            $name = $_POST["gameName"];
            $developer = $_POST["Developer"];
            $publisher = $_POST["Publisher"];
            $rating = $_POST["Rating"];
            $genre = $_POST["gameGenre"];
            games\update_game($GameID, $release, $name, $developer, $publisher, $rating, $genre);
            $action = 'show_list';
            goto switchstart;
        default : echo "You have landed at the default case statement. Something went Wrong";

    }
?>