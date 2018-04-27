<?php
//Include Meta
require ('resources/includes/head.php');

//Include Header
require ('resources/views/header.php');

navigation($header);

//MVC - Model View Controller
echo '<div class="content">';
echo $content;
echo '</div>';

//Inlcude Footer
require ('resources/views/footer.php');
?>