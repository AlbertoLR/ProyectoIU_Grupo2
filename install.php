<?php
$mysqlUserName = 'root';
$mysqlPasswd = 'iu';
$dbFile = "moovett.sql";
$command='mysql -u' .$mysqlUserName .' -p' .$mysqlPasswd . ' < ' .$dbFile;
exec($command,$output=array(),$worked);
switch($worked){
    case 0:
        echo 'Import file <b>' .$dbFile .'</b> successfully imported to database<br />';
        echo 'Database user created: moovett with password moovett<br />';
        echo 'Test user create: admin with password admin<br />';
        echo '<a href="index.php">Proceed to Website</a><br />';
        break;
    case 1:
        echo 'There was an error during import. User already Exists<br />';
        echo 'Database user created: moovett with password moovett<br />';
        echo 'Website user admin create: admin with password admin<br />';
        echo '<a href="index.php">Proceed to Website</a><br />';
        break;
}
?>