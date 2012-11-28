<?php

class Plugin_CheckUser extends Zend_Controller_Plugin_Abstract {

	
	/**
	 * @name : isUserNotLoggedGoToLogin
	 * @author : Olivier Biset - be.wan
	 * @date : 2012-07-02
	 * @return : redirect to panel login if user session is not declared
	 */
//	static public function isUserNotLoggedGoToLogin(){
//		
//		$userSession = new Zend_Session_Namespace('userSession');
//		if($userSession->username == null){
//			$redirect = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
//    		$redirect->gotoUrl('login/index/login')->redirectAndExit();
//		}
//	}
	
	
	/**
	 * @name : isUserLogged
	 * @author : Olivier Biset - be.wan
	 * @date : 2012-07-02
	 * @return : if user is in session return TRUE, else FALSE
	 */
//	static public function isUserLogged(){
//            
//            $userSession = new Zend_Session_Namespace('userSession');
//		
//		if($userSession->username != null)
//			return true;
//		else
//			return false;
//	}
	
	/**
	 * @name : setRights
	 * @author : Olivier Biset - be.wan
	 * @date : 2012-07-02
	 * @return : $acl ressources, roles, order-allow and order-deny
	 */
	static public function setRights($userID){
		
		$acl = new Zend_Acl();
		// add default role user
		$acl->addRole(new Zend_Acl_Role("user"));
		
		$permission = new Permission();
		
		// add all ressources from permission
		$permissionsNames = $permission->getPermissionsListNames();
		foreach($permissionsNames as $permName){
			$acl->addResource(new Zend_Acl_Resource($permName['name']));
		}
		// deny all for everybody
		$acl->deny(null, null);
		
		// allow user for each permission he have access
		$permissions = $permission->getUserPermission($userID);
		foreach($permissions as $perm){
			$acl->allow("user", $perm['name']);
		}
		
		return $acl;
	}
	
	
	/**
	 * @name : hasRights
	 * @param : $ressource
	 * @author : Olivier Biset - be.wan
	 * @date : 2012-07-02
	 * @return : TRUE if user is allowed to access ressource, else FALSE
	 */
	static public function hasRight($resource){
		
            
		$userSession = new Zend_Session_Namespace('user');
		$acl = new Zend_Acl();
		$acl = $userSession->acl;
		//Zend_Debug::dump($userSession->acl);
                //Zend_Debug::dump($userSession->username);exit;
		if(!$acl->isAllowed("user", "$resource"))
			return false;
		else
			return true;
		
	}
        
        static public function redirect(){
            
            $r = array();
            $r['m'] = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
            $r['c'] = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
            $r['a'] = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
            
            
            $right = strtoupper($r['m']);
            
            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
            $redirector->gotoUrl('login/index/no-right/right/'.$right);
        }
        
        
        
        
        
        
	
}