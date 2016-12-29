<?php

/*
 * eAthena Remote Command v1.0
 *
 * eAthena Remote Command is distributed is FREE PUBLIC SOFTWARE
 * meaning that you are free to modify and distribute it
 * as long as you do not charge any sum of money. Please
 * do not take the initial credit away from kaoskorruption
 * for the PHP portion of this script.
 *
 * For more information contact chris@cjroth.com.
 *
 */

error_reporting ( 0 );

// If a user sends a command...
if ( !empty ( $_GET["command"] ) ) {

	// Defaults (incase you get drunk and delete the settings)
	$atcommand_file = "default/atcommand_athena.conf";
	$max_level = 60;
	$command_symbol = "@";
	$charcommand_symbol = "#";
	$online = true;

	// Load some shiznit
	require "mysql.php";
	require "safesql.php";
	require "load_atcommand.php";
	require "settings.php";

	if ( $online != true ) {
		echo "Remote commands have been disabled.";
		exit ( );
	}

	// Clean up the command
	$command = trim ( $_GET["command"] );
	$command = stripslashes ( $command );
	$command = strip_tags ( $command );

	// Get the user's IP address
	$ip = $_SERVER["REMOTE_ADDR"];

	if ( $command == $command_symbol . "info" ) {
		echo "This is a script that allows you to run atcommands and charcommands from a web browser. You may use any command that doesn't send information back to the client. For instance, @who doesn't work, because it shows information. @kill, on the other hand, works fine. This script is basically made for using commands such as @ban so that you can ban a user even if you're not near a working Ragnarok client. Hope you enjoy our release.<br><br>This script was coded by kaoskorruption (PHP) and Ruroniarc (NPC) for the eAthena community.";
		exit ( );
	}

	// If the user says @help
	if ( $command == $command_symbol . "help" ) {
		echo "A warrior pidgeon has been dispatched to help you... he says use @commands to get a list of commands.";
		exit ( );
	}

	// If the user says @command or @commands
	// Only works if atcommand_athena.conf was loaded
	if ( $atcommand_file != false ) {
		if (  $command == $command_symbol . "command" || $command == $command_symbol . "commands" ) {
			$commandlist = command_list ( );
			foreach ( $commandlist as $line => $level ) {

				// Don't show the command if the it is above the maximum level
				if ( $level <= $max_level ) {
					echo "<br>" . $command_symbol . $line;
				}
			}
			exit ( );
		}
	}

	// Check that command is valid
	if ( $atcommand_file == false ) {

		// Using only the symbol
		$okay = symbol_check ( $command );
	} else {

		// Using an "atcommand_athena.conf" file
		$okay = command_check ( $command, $max_level );
	}

	// If the command was okay...
	if ( $okay ) {

		// Connect to the database
		$db = new mysql;
		$db->host = $mysql_host;
		$db->user = $mysql_user;
		$db->pass = $mysql_pass;
		$db->name = $mysql_name;
		$db->connect ( );

		// Put the command in the database
		$query = safesql ( "INSERT INTO `commands` (`command`, `ip`) VALUES ('%s', '%s');", array ( $command, $ip ) );
		$query = mysql_query ( $query );
		echo mysql_error ( );

		// Disconnect from the database
		$db->disconnect ( );

		// Send the command back to the user so they know it worked
		echo "<font color=\"#FF0000\">$ip: </font>" . $command;
	} else {

		// Tell the user the command sucked
		echo "Your command was invalid, and therefore intercepted by a large, blue octopus. Use @commands for a list of commands.";
	}
	exit ( );

// If the user is a douchebag and presses enter without entering a command...
} elseif ( isset ( $_GET["command"] ) ) {
	exit ( );
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>eAthena Remote <?php include "settings.php"; echo @$command_symbol; ?>Command</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php $image = rand ( 1, 3 ); echo '<body onLoad="document.getElementById(\'command\').focus();" style="background:url(bg/' . $image . '.jpg) no-repeat;">'; ?>
<div class="header">eAthena Remote <font color="#708090"><?php include "settings.php"; echo @$command_symbol; ?></font>Command<br><div class="credits">A remote admin tool for eAthena. PHP by <font color="#FFFFFF" title="kaoskorruption at gmail dot com">kaoskorruption</font>, NPC by <font color="#FFFFFF" title="erik dot dahlinghaus at gmail dot com">Ruroniarc</font>.</div></div>
<script>
function keylistener ( e ) {
	if ( e.keyCode == 13 ) {
		sendcommand(document.getElementById('command').value);
		document.getElementById ( 'command' ).value = '';
	}
}

function sendcommand ( command ) {
	if ( command.length < 1 ) {
		return;
	}
	var xmlhttp = false;
	/*@cc_on @*/
	/*@if ( @_jscript_version >= 5 )
	try {
		xmlhttp = new ActiveXObject ( 'Msxml2.XMLHTTP' );
	} catch ( e ) {
		try { xmlhttp = new ActiveXObject ( 'Microsoft.XMLHTTP' ); } catch ( E ) { xmlhttp = false; }
	}
	@end @*/
	if ( !xmlhttp ) {
		xmlhttp=new XMLHttpRequest ( );
	}
	xmlhttp.open('GET','index.php?command='+command, true);
	xmlhttp.onreadystatechange = function ( ) {
        if ( xmlhttp.readyState == 4 ) {
		document.getElementById ( 'chatbox' ).innerHTML = document.getElementById ( 'chatbox' ).innerHTML + '<br>' + xmlhttp.responseText;
		document.getElementById ( 'chatbox' ).scrollTop = document.getElementById ( 'chatbox' ).scrollHeight;
	}
}
xmlhttp.send ( null );
}
</script>
<div class="chatbox" id="chatbox"></div>
<div class="footer"><?php echo $_SERVER["REMOTE_ADDR"]; ?><font style="text-decoration:blink;">:</font> <input type="text" id="command" class="input" onkeydown="keylistener(event);"></div>
</body>
</html>
