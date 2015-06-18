<?php
/**
 * A Class for generating authentication tokens for the Moodle http://moodle.org Learning Management System
 *
 * The Class should be used to generate tokens, based on authenticated local LDAP users,
 * which are passed to the Moodle instance for verification.
 *
 * @author Timothy OBrien <obrien.timothy.a@gmail.com>
 * @license GNU General Public License Version 3 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version 0.1.0 June 2015
 */

/**
 * MoodleSSO class for generating Moodle authentication tokens.
 *
 */
class MoodleSSO{
    /**
     * Attempt to authenticate a user and generate their secure token
     *
     * @param string $username LDAP/Moodle username
     * @param string $password LDAP password
     * @return string JSON string containing a redirect auth URL, or error.
     */
    public function authenticate($username = null, $password = null){
        if(is_null($username) || is_null($password) || empty($username) || empty($password)){
            return $this->jsonMessage('Username or password cannot be blank.');
        }
        $u = $this->getLdapAttributes($username, $password);
        if($u){
            $authURL = $this->getAuthURL($username, $u['email'], $u['given_name'], $u['surname']);
            if(!$authURL){
                return $this->jsonMessage('Error generating secure URL.');
            } else {
                return $this->jsonMessage($authURL, true);
            }
        } else {
            return $this->jsonMessage('Incorrect username or password.');
        }
    }

    /**
     * Return a JSON-formatted error/success string
     *
     * @param string $message Message to return
     * @param boolean $success True if successful (default false)
     * @return string JSON error message
     */
    private function jsonMessage($message = null, $success = false){

        if(!is_null($message)){
            $m['success'] = $success;
            $m['message'] = $message;
        } else {
            $m['success'] = $success;
            $m['message'] = "No status message available.";
        }

        return json_encode($m);
    }

    /**
     * Compile the URL for redirection to upstream Moodle SSO
     *
     * @param string $username Username in Moodle
     * @param string $email Email address in Moodle
     * @param string $given_name First name in Moodle
     * @param string $surname Last name in Moodle
     * @return string|boolean Compiled URL or FALSE on error
     */
    private function getAuthURL($username = null, $email = null, $given_name = null, $surname = null){
        $timestamp = time();
        $t = $this->generateToken($timestamp, $username, $email, $given_name, $surname);
        $url = MOODLESSO_SSO_URL.
            "?email=".urlencode($email).
            "&first=".urlencode($given_name).
            "&last=".urlencode($surname).
            "&status=".urlencode(MOODLESSO_STATUS).
            "&time=$timestamp".
            "&user=".urlencode($username).
            "&mac=$t";
        return $url;
    }

    /**
     * Attempt to bind to LDAP with credentials.
     *
     * @param string $username Username to pass to the LDAP server
     * @param string $password Password to pass to the LDAP server
     *
     * @return array|boolean Array of user attributes. FALSE if error.
     */
    private function getLdapAttributes($username = null, $password = null){
        if (!defined('MOODLESSO_LDAP_URL') || !defined('MOODLESSO_LDAP_PORT') || !defined("MOODLESSO_LDAP_BASE_DN") || is_null($username) || is_null($password)){
            return false;
        }
        $ldap = ldap_connect(MOODLESSO_LDAP_URL, MOODLESSO_LDAP_PORT);
        if($ldap){
            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, false);
            $ldap_bind = @ldap_bind($ldap, $username.MOODLESSO_LDAP_USERNAME_APPEND, $password);
            if($ldap_bind){
                // auth OK, get attributes
                $ldap_search = ldap_search($ldap, MOODLESSO_LDAP_BASE_DN, "(samaccountname=$username)", array('mail','givenName','sn'));
                if($ldap_search){
                    $ldap_attributes = ldap_get_entries($ldap, $ldap_search);
                    if($ldap_attributes['count'] > 0) {
                        $user_attributes = array();
                        $user_attributes['given_name'] = $ldap_attributes[0]['givenname'][0];
                        $user_attributes['surname'] = $ldap_attributes[0]['sn'][0];
                        $user_attributes['email'] = $ldap_attributes[0]['mail'][0];
                    }
                    return $user_attributes;
                }
            }
        }
        // default to false
        return false;
    }

    /**
     * Generates a one-way token using the MOODLESSO_SECRET and user information.
     *
     * @param $timestamp integer Current Unix Timestamp
     * @param $username string Username in Moodle
     * @param $email string Email address in Moodle
     * @param $given_name string First name in Moodle
     * @param $surname string Last name in Moodle
     *
     * @return string|boolean Return the hash string, or FALSE if error.
     */
    private function generateToken($timestamp = null, $username = null, $email = null, $given_name = null, $surname = null){
        $user_data_string = $timestamp.$username.$email.$given_name.$surname.MOODLESSO_STATUS;
        return md5(array_sum(array_map("ord", str_split($user_data_string))).MOODLESSO_SECRET);
    }
}