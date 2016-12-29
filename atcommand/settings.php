<?php

// Settings! YAY!

// ================================================ //
//                 DATABASE SETTINGS  ):            //
// ================================================ //

// IP address or domain of MySQL Server.
$mysql_host = "MYSQL HOST";

// Username to use to login to MySQL server.
$mysql_user = "MYSQL USER";

// Password to use to login to MySQL server.
$mysql_pass = "MYSQL PASS";

// Database (schema) name to use on MySQL server.
$mysql_name = "commands";

// ================================================ //
//                   FUN SETTINGS  :D               //
// ================================================ //

// Your atcommand_athen.conf file.
// Leave this option commented out for the default "atcommand_athen.conf" file.
// Option 1: Copy and paste it into this folder.
//	With this option, the script checks that the command exists and that the level of the command is not too high.
// Option 2: Replace "atcommand_athena.conf" with false. (So that there are no quotes anymore.)
//	With this option, the script only checks that the symbol (usually @ or #) is correct.
//$atcommand_file = "atcommand_athena.conf";

// Maximum level of command that is allowed to be executed
$max_level = 60;

// The symbol that your atcommands start with, usually @, but can be changed in atcommand_athena.conf. If you have a
// different symbol in atcommand_athena.conf than you do here, the one in atcommand_athena.conf takes presidence.
$command_symbol = "@";

// The symbol that your charcommands start with, usually #.
$charcommand_symbol =	"#";

// You can set this to false if you want to disable the remote commands page.
$online = true;

?>
