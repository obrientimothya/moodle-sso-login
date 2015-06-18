<?php
/**
 * Accepts a requested username and password to pass to the MoodleSSO class for authentication.
 *
 * @author Timothy OBrien <obrien.timothy.a@gmail.com>
 * @license GNU General Public License Version 3 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version 0.1.0 June 2015
 */

require_once('config/config.php');
require_once('lib/MoodleSSO.class.php');

$MoodleSSO = new MoodleSSO();

isset($_REQUEST["username"]) ? $username = "".$_REQUEST['username'] : $username = "";
isset($_REQUEST["password"]) ? $password = "".$_REQUEST['password'] : $password = "";

header('Content-Type: application/json');
echo $MoodleSSO->authenticate($username, $password);