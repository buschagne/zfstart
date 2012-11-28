<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author user
 */
class Services_User {

    /**
     * Authenticate user 
     * Basically setting Zend_Auth::getInstance()->hasIdentity()
     * @param string $username
     * @param string $password
     */
    public function authenticateUser($username, $password) {
        
        $adapter = new Common_Auth_Adapter($username, $password);
        Zend_Auth::getInstance()->authenticate($adapter);
        
    }

    /**
     * Set user session variables used in the application
     * $session->username
     * $session->is_super_admin
     * $session->language
     * $session->id_user
     * $session->acl rights
     * $session->user_db
     * 
     * @param string $username
     */
    public function setUserSessionVariables($username) {
        
        $q = new User();
        $user = $q->getUserDb($username);//getUSerDb is confusing - function returns the user object  

        $session = new Zend_Session_Namespace("user");
        $session->username = $user->username;

        $session->is_super_admin = Plugin_Authcheck::isSuperAdmin($session->username); //to plugin service
        $session->language = $user->language;
        $session->id_user = $user->id_user;

        $checkPluginUser = Plugin_CheckUser::setRights($session->id_user); //to plugin service
        $session->acl = $checkPluginUser;
        $session->user_db = $user->db_name;
    }

    /**
     * service to logout a user by destroying a Zend_Session
     * @param type $usersession
     */
    public function logout($usersession) {

        if (isset($usersession)) {
            Zend_Auth::getInstance()->clearIdentity();
            Zend_Session::destroy();
        }
    }

}

?>
