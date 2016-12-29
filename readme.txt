REMOTE ATCOMMAND RELEASE v1

::INFORMATION ABOUT THIS RELEASE::

This script is to run atcommands from a web interface. Currently you can use any command that doesn't send information back to the client. For instance, @whodrops won't work, because it shows information. @kill on the otherhand works just fine. This script is basically made for using commands such as @ban and @banfor, so that you can ban a username while you're not near your computer / a computer with Ragnarok. Hope you enjoy our release.

::HOW TO INSTALL 'REMOTE AT COMMAND'::

*NOTE: THIS SCRIPT IS ONLY FOR SQL BASED EATHENA SERVERS*

1. Execute commands.sql under the 'setup' folder to create the commands database, and the commands table.

2. Add commands.txt under the 'setup' folder to your npc folder, or your favorite sub-directory there-of.

3. Add 'npc: npc/commands.txt' to your scripts_custom.conf

4. Restart your server (The server needs to be restarted because this script uses the OnInit: call, and that requires the server to reboot.

5. Add the 'atcommand' folder to your website. Add HTACCESS to this, and don't give anyone you don't want executing commands on your server the username/password.

6. Modify the variables in settings.php to reflect your mysql database server. Defaults under the other settings should work just fine for normal useage. Though you may choose to raise or lower the variable for the GM level in which the commands may be used. A list of the commands and their levels are available in the atcommand_athena.conf file. Or by typing @commands (The charcommand_athena.conf file is currently in there, but doesn't actually do anything)

::KNOWN BUGS / LIMITATIONS::

1. This script currently displays '[Debug]: mapindex_id2name: Requested name for non-existant map index [0] in cache.' in the map-server console everytime the script runs a command. This currently doesn't affect anything, so I guess it's not a big deal.

2. You can't currently use #charcommands, that will come in the next release.

::CREDITS::

This script was coded by Kaoskorruption (PHP) and Ruroniarc (NPC) for the eAthena community.