<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";
foreach (glob("Framework/*.php") as $filename)
{
    require_once $filename;
}
foreach (glob("Controller/*.php") as $filename)
{
    require_once $filename;
}

require_once "Model/ModelInterface.php";
require_once "Model/Model.php";
require_once "Model/User.php";

session_start();
?>
<html>
<head>
    <title>
        Test App
    </title>
</head>
<body>
<?php

\TestApp\DbConnection::getInstance()->connect($db_host, $db_name, $db_user, $db_password);

if(isset($_SESSION["error"])) {?>
<div class="error-message"><?php echo $_SESSION["error"]; ?></div>
<?php unset($_SESSION["error"]);}

echo(\TestApp\Router::routeTo($_SERVER['REQUEST_URI']));
?>
</body>
</html>