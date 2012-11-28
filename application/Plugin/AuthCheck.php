<?php

class Plugin_Authcheck extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {


        if (Zend_Auth::getInstance()->hasIdentity()) {

            /**
             * get session
             * check if user is super admin
             * check if user has rights based on the Zend Front Controller 
             */
            $userSession = new Zend_Session_Namespace("user");
            $userSession->is_super_admin = Plugin_Authcheck::isSuperAdmin($userSession->username);
            
        /**
         * The table user with column field "is_super_user" is not used anymore
         * It is replaced with user_has_permission table
         *    
         */
            //Plugin_Authcheck::hasright();

            //obtain the user_db_name value
            $user_db = $userSession->user_db;

            if ($user_db) {
                $conn2 = Doctrine_Manager::connection('mysql://root:user@localhost/' . $user_db, 'app_db');
                $conn2->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, true);
                $conn2->execute("SET CHARACTER SET utf8");
                $conn2->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);
            }
        } else {

            if ($_POST && !isset($_POST['password'])) {
               
                echo '<script type="text/javascript">parent.$.fancybox.close(),self.parent.location.reload();</script>';
                exit;
            }
            
            if ($request->getModuleName() !== "login") {

                $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
                $redirector->gotoUrl('login/index/login');
            }
        }
    }

    static public function isSuperAdmin($username) {
        //Obtain the user_is_super_admin value
        $q = new User();
        $user = $q->getUserDb($username);

        if ($user->is_super_admin == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *  This function using table user with column field "is_super_user" is not used anymore
     *  It is replaced with user_has_permission table functionality
     */
    static public function hasright() {

        $moduleName = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();


        $userSession = new Zend_Session_Namespace("user");
        if ($moduleName == "configuration" && $userSession->is_super_admin == false) {

            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
            $redirector->gotoUrl('task/distribution/list');
        }
    }

    static public function setLanguage() {
        
    }

}

?>
