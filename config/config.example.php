<?php
/**
 * -- EXAMPLE -- Configuration variables for the MoodleSSO class
 *
 * In production, make a copy of this file to the application's /config/config.php
 * Then, modify the values to match your environment.
 */

define("MOODLESSO_LDAP_URL", "ldap://myldapserver.example.com");
define("MOODLESSO_LDAP_PORT", 389);
define("MOODLESSO_LDAP_BASE_DN", "DC=example,DC=com");
define("MOODLESSO_LDAP_USERNAME_APPEND", "@example.com");
define("MOODLESSO_SSO_URL", "https://mymoodleserver.example.com/auth/login2sso/sso_attempt.php");
define("MOODLESSO_SECRET", "MySecretKeyInMoodle");
define("MOODLESSO_STATUS", "s");