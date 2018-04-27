<?php 
$host = 'localhost';
$dbname = 'blogg';
$user = 'admin';
$password = 'sqlkevin';

$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$pdo = new PDO($dsn, $user, $password, $attr);

$sql = '';
$search = 'true';

if ($search) {
    $sql = 'SELECT p.ID, p.Slug, p.Headline, u.Username, p.Creation_time, p.Text FROM Posts AS p JOIN Users AS u ON u.ID = p.User_ID ORDER BY Creation_time DESC';
}

if($pdo) {
    
    $model = array();
    foreach($pdo->query($sql) as $row) {
        $model += array(
            $row['ID'] => array(
                'slug' => $row['Slug'],
                'title' => $row['Headline'],
                'author' => $row['Username'],
                'date' => $row['Creation_time'],
                'text' => $row['Text']
            )
        );
    }
} 
else {
print_r($pdo->errorInfo());
}

?>