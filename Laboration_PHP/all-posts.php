<?php
// Content
echo '<h2>Alla blogginlägg</h2>' . $error;
?>
<!-- Formulär för att söka efter inlägg -->
<form class="search" method="post">
    <input type="text" placeholder="Search..." name="what">
    <button type="submit" name="search"><i class="fa fa-search"></i></button>
</form>

<?php

//Här skrivs innehållet ut ifrån databasen.
foreach ($model as $key => $value) {
    echo '<div class="post">';
    echo '<h3>' . $model[$key]['title'] . '</h3>';
    echo '<p class="author">Författare: ' . $model[$key]['author'] .'</p>';
    echo '<p class="date">Datum: ' . $model[$key]['date'] .'</p>';
    echo '<p class="Text">' . $model[$key]['text'].  '<a href="index.php?page=blogg&post=' . $model[$key]['slug'].'">Läs mer</a></p>'; //Här är då knappen som leder en till själva inlägget. Knappen leder automatisk till rätt inlägg tack vare slug.
    echo '</div>';
}
?>
