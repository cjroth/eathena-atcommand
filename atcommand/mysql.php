<?php

class mysql {

	function connect ( ) {
		if ( $this->connection = mysql_connect ( $this->host, $this->user, $this->pass ) ) {
			mysql_select_db ( $this->name );
			return true;
		}
		return false;
	}

	function disconnect ( ) {
		mysql_close ( $this->connection );
	}

}

?>
