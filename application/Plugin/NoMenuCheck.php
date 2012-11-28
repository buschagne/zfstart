<?php

class Plugin_NoMenuCheck extends Zend_Controller_Plugin_Abstract{
	
	public function preDispatch(Zend_Controller_Request_Abstract $request){
		
		$layout = Zend_Layout::getMvcInstance();
		$view = $layout->getView();
                if(Zend_Controller_Front::getInstance()->getRequest()->getParam('fancyBoxIFrame') == 'yes'){

                    $view->inlineScript()->appendScript("
				
                        $(document).ready(function() {
                            $('.sidebar-menu').hide();
                            $('.brand-zone').hide();
                            $('.navbar').hide();

                            $('.container-fluid').css({'margin-top' : 0});
                            $('.panel').css({'width' : '110%', 'margin-left' : '-100px', 'margin-top':'-35px'});
                        });
				
                    ");
		
		}
	}
}