<?php
require 'resources/includes/db_conn.php';

$message = '';

// Funktion som modifierar strängar så att tecken som inte tillhör ASCII samt mellanslag byts ut.
// Funktionen skulle kunna placeras i ett bibliotek för att sedan inkluderas vid behov.
function slugify($slug, $strict = false) {
    $slug = html_entity_decode($slug, ENT_QUOTES, 'UTF-8');
    // replace non letter or digits by -
    $slug = preg_replace('~[^\\pL\d.]+~u', '_', $slug);

    // trim
    $slug = trim($slug, '_');
    setlocale(LC_CTYPE, 'en_GB.utf8');
    // transliterate
    if (function_exists('iconv')) {
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
    }
    // lowercase
    $slug = strtolower($slug);
    // remove unwanted characters
    $slug = preg_replace('~[^-\w.]+~', '', $slug);
    if (empty($slug)) {
        return 'empty_$';
    }
    if ($strict) {
        $slug = str_replace(".", "_", $slug);
    }
    return $slug;
}

if ($pdo) {

    //Gör en array av alla användare i databasen. 
    $sql = 'SELECT ID, Username FROM Users ORDER BY Username';
    $users = array();
    foreach ($pdo->query($sql) as $row) {
        $users += array(
            $row['ID'] => $row['Username']
        );
    }

    /**********************************************************/
    /*********************** C-UPPGIFT 3 **********************/
    /* Våra variabler $headline & $text tar emot information **/
    /** utan att kontrollera informationen före den skickas ***/
    /******************* till vår databas. ********************/
    /** För betyget C så kräver jag att ni säkerställer att ***/
    /** våra användare inte kan skicka med någon skadlig kod **/
    /********** genom variablerna $headline & $text. **********/
    /**********************************************************/

    //Den här koden gör så att man skickar in ett ilägg till databasen ifall det är något skrivet där.
    if (isset($_POST['submit'])) {
        $user = $_POST['author']; //Användarens username.
        $headline = $_POST['title']; //titeln på inlägget.
        $headline = trim($headline);

        $slug = slugify($headline); //Gör om headlinen till en slug som dyker upp i URL:en. 

        $text = $_POST['message']; //Texten i inlägget.

        $sql = 'INSERT INTO Posts (User_ID, Slug, Headline, Text) VALUES ("'.$user.'", "'.$slug.'", "'.$headline.'", "'.$text.'")';
        
        if($pdo->query($sql)) {
            $message = 'Du har lyckats lägga upp ett inlägg';
        }

        else {
            $message = 'Du har inte lyckats lägga upp ett inlägg';
        }

    }
}
else {
    print_r($pdo->errorInfo());
}

 ?>
