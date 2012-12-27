<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initDoctrine() {

        $this->getApplication()
                ->getAutoloader()
                ->pushAutoloader(array('Doctrine', 'autoload'));

        $doctrineConfig = $this->getOption('doctrine');
        $conn = Doctrine_Manager::connection($doctrineConfig['dsn'], 'scrum');
        $conn->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, true);
        $conn->execute("SET CHARACTER SET utf8");
        $conn->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);

    //CLI TOOLS

//        if (isset($_SERVER["argv"]) && !empty($_SERVER["argv"])) {
//            $cli = new Doctrine_Cli($doctrineConfig);
//            $cli->run($_SERVER["argv"]);
//        }
    }

    protected function _initUtf8() {
        header('Content-Type: text/html; charset=utf-8');
    }

    protected function _initTranslate() {
        
        $userSession = new Zend_Session_Namespace("user");
        if($userSession->language == false){
            $lang = $this->getOption('lang');
        }else{
            $lang = $userSession->language;
        }
        
        
        
        $translate = new Zend_Translate(
                        array(
                            "adapter" => "Zend_Translate_Adapter_Csv",
                            "content" => APPLICATION_PATH . "/configs/" . $lang . ".csv"
                        )
        );
        Zend_Registry::set('Zend_Translate', $translate);
    }

    protected function _initNavigation() {
        $this->bootstrap("layout");
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'webnav');
        $navigation = new Zend_Navigation($config);

        $view->navigation($navigation);
    }

}

