<?php
/**
 * @author Warren C. Wang <warren.wang@teachstone.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package auth_loginlogoutredirect
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    // It must be included from a Moodle page.
}

require_once($CFG->libdir.'/authlib.php');

class auth_plugin_loginlogoutredirect extends auth_plugin_base {

  const COMPONENT_NAME = 'auth_loginlogoutredirect';

  /**
   * Constructor.
   */
  public function __construct() {
    $this->authtype = 'loginlogoutredirect';
    $this->config = get_config(self::COMPONENT_NAME);
  }

  /*
   * Must override or an error is printed.
   * @return boolean False means login was not a success.
   */
  function user_login($username, $password) {
    return false;
  }

  /**
   * Prints a form for configuring this authentication plugin.
   *
   * This function is called from admin/auth.php, and outputs a full page with
   * a form for configuring this plugin.
   * 
   **/
  function config_form($config, $err, $userfields) {
    include 'config.html';
  }

  /**
   * Processes and stores configuration data for this authentication plugin.
   *
   * @param stdClass $config
   * @return bool success
   */
  function process_config($config) {
    // Set to defaults if undefined.
    if (!isset($config->loginredirect)) {
      $config->loginredirect = '';
    }
    if (!isset($config->logoutredirect)) {
      $config->logoutredirect = '';
    }

    // Save settings.
    set_config('loginredirect', $config->loginredirect, self::COMPONENT_NAME);
    set_config('logoutredirect', $config->logoutredirect, self::COMPONENT_NAME);

    return true;
  }

  /**
   * Post authentication hook.
   * This method is called from authenticate_user_login() for all enabled auth plugins.
   *
   * @param object $user user object, later used for $USER
   * @param string $username (with system magic quotes)
   * @param string $password plain text password (with system magic quotes)
   */
  function user_authenticated_hook(&$user, $username, $password) {
    global $SESSION;

    if (isset($this->config->loginredirect) && $this->config->loginredirect) {
      $desturl = $this->config->loginredirect;

      if (true || !isset($SESSION->wantsurl)) {
        $SESSION->wantsurl = $desturl;
      } else {
        error_log("Not redirecting to '$desturl': came from other page '$SESSION->wantsurl'");
      }
    } else {
      error_log("'Login Redirect' not set in plugin settings. Abort...");
    }

    return true;
  }

  /**
   * Hook for overriding behaviour of logout page.
   * This method is called from login/logout.php page for all enabled auth plugins.
   *
   * @global object
   * @global string
   */
  function logoutpage_hook() {
    global $redirect;

    if (isset($this->config->logoutredirect) && $this->config->logoutredirect) {
      $redirect = $this->config->logoutredirect;
    } else {
      error_log("'Logout Redirect' not set in plugin settings. Abort...");
    }
  }
}

?>
