<?php  


//username
define('MYSQL_USER','root');

//password
define('MYSQL_PASSWORD','code5959');
define('MYSQL_HOST','localhost');
define('MSQL_DATABASE','blog');

$pdoOptions=array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
); 

$pdo=new PDO(
    'mysql:host=' .MYSQL_HOST.';dbname='.MSQL_DATABASE,
    MYSQL_USER,MYSQL_PASSWORD,
    $pdoOptions
);





 


?>