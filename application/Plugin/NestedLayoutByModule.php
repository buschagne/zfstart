<?php

class Plugin_NestedLayoutByModule extends Zend_Controller_Plugin_Abstract
{
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request){
    	// Get current layout
		$front = Zend_Controller_Front::getInstance();
        $layout = $front->getParam('bootstrap')->getResource('layout');
		
        // Set new layout with module directory
        $layoutPath = $front->getModuleDirectory() . '/layout/';
		
        $nestedLayout = new Zend_Layout();
        $nestedLayout->setLayoutPath($layoutPath);
        
        // If module's layout file exists : Send to layout
        if(file_exists($nestedLayout->getLayoutPath() . $nestedLayout->getLayout() . ".phtml"))
        $layout->nestedLayout = $nestedLayout;
    }
}