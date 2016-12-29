<?php

// Function to check that a command is valid based on an "atcommand_athena.conf" file
function command_check ( $command, $level = "60" ) {

	global $atcommand_file, $charcommand_symbol, $atcommand_symbol;

	// Load "atcommand_athen.conf" into an array
	$atcommand = file ( $atcommand_file );

	// Create a new array
	$commands = array ( );

	// Remove comments & such
	foreach ( $atcommand as $eachcommand ) {

		// Remove whitespace from beginning and end of each line
		$eachcommand = trim ( $eachcommand );

		// If the line is not a comment or blank, add it to the new array
		if ( substr ( $eachcommand, 0, 2 ) != "//" && $eachcommand != "" ) {

			// Split the line by the colon
			$eachcommand = explode ( ":", $eachcommand );

			// Remove whitespace
			$eachcommand[0] = trim ( $eachcommand[0] );
			$eachcommand[1] = trim ( $eachcommand[1] );

			// Add it to the array
			$commands[$eachcommand[0]] = $eachcommand[1];
		}
	}

	// Don't include the "import: conf/import/atcommand_conf.txt" line as a command
	if ( isset ( $commands["import"] ) ) {
		unset ( $commands["import"] );
	}

	// Use the command_symbol "atcommand_athena.conf" if there is one
	if ( isset ( $commands["command_symbol"] ) ) {
		$command_symbol = $commands["command_symbol"];
		unset ( $commands["command_symbol"] );
	}

	// If the command does not start with the correct symbol (usually @ or #)...
	if ( substr ( $command, 0, 1 ) != $command_symbol && substr ( $command, 0, 1 ) != $charcommand_symbol ) {
		return false;
	}

	$command = substr ( $command, 1 );
	$command = explode ( " ", $command );
	$command = $command[0];

	// If the command does not exist...
	if ( !isset ( $commands[$command] ) ) {
		return false;

	// If the command is a higher level than allowed...
	} elseif ( $commands[$command] > $level ) {
		return false;

	// If the command is okay...
	} else {
		return true;
	}
}

// Function to check that a command based only by what symbol it begins with, incase you don't want to use an "atcommand_athena.conf" file
function symbol_check ( $command ) {

	global $charcommand_symbol, $atcommand_symbol;

	// If the command does not start with the correct symbol (usually @ or #)...
	if ( substr ( 0, 1, $command ) != $command_symbol && substr ( 0, 1, $command ) != $charcommand_symbol ) {
		return false;
	// If the command is okay...
	} else {
		return true;
	}		
}

// Function to get list of atcommands from "atcommand_athena.conf" file
function command_list ( ) {

	global $atcommand_file, $atcommand_symbol;

	// Load "atcommand_athen.conf" into an array
	$atcommand = file ( $atcommand_file );

	// Create a new array
	$commands = array ( );

	// Remove comments & such
	foreach ( $atcommand as $eachcommand ) {

		// Remove whitespace from beginning and end of each line
		$eachcommand = trim ( $eachcommand );

		// If the line is not a comment or blank, add it to the new array
		if ( substr ( $eachcommand, 0, 2 ) != "//" && $eachcommand != "" ) {

			// Split the line by the colon
			$eachcommand = explode ( ":", $eachcommand );

			// Remove whitespace
			$eachcommand[0] = trim ( $eachcommand[0] );
			$eachcommand[1] = trim ( $eachcommand[1] );

			// Add it to the array
			$commands[$eachcommand[0]] = $eachcommand[1];
		}
	}

	// Don't include the "import: conf/import/atcommand_conf.txt" line as a command
	if ( isset ( $commands["import"] ) ) {
		unset ( $commands["import"] );
	}

	// Use the command_symbol "atcommand_athena.conf" if there is one
	if ( isset ( $commands["command_symbol"] ) ) {
		$command_symbol = $commands["command_symbol"];
		unset ( $commands["command_symbol"] );
	}

	return $commands;
}

?>
