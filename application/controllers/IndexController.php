<?php

class IndexController extends Zend_Controller_Action {

  public function init() {
    $this->_helper->layout()->setLayout('hero-layout');
  }

  public function indexAction() {
    
  }

  public function common() {

    $this->getHelper('layout')->disableLayout();
    $this->_helper->redirector('list');
    $this->redirecturl = "configuration/user/list/";
    $this->_redirect($this->redirecturl);
    $this->_helper->viewRenderer->setNoRender(TRUE);
    $id = $this->getRequest()->getParam("id_user");

    $translate = Zend_Registry::get('Zend_Translate'); //check in bootstrap if it was set as 'Zend_Translate'
    $translate->translate("home");
  }

  public function languageAction() {

    $this->_helper->viewRenderer->setNoRender(TRUE);
    $language = $this->getRequest()->getParam("lang");

    $translate = new Zend_Translate(
                    array(
                        "adapter" => "Zend_Translate_Adapter_Csv",
                        "content" => APPLICATION_PATH . "/configs/" . $language . ".csv"
                    )
    );
    $userSession = new Zend_Session_Namespace("user");
    $userSession->language = $language;
    Zend_Registry::set('Zend_Translate', $translate);
    $this->_redirect('/');
  }

}

