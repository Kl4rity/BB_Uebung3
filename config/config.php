<?php
error_reporting(E_ALL);

include "controller/ListController.php";
include "services/Database.php";
include "models/ListModel.php";
include "views/JsonView.php";

define ("DBHost", "localhost");
define ("DBName", "uebung3");
define ("DBUser", "root");
define ("DBPass", "");