<?php

/**
 * IndexController
 * 
 * Главный контроллер сайта
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class IndexController extends Zend_Controller_Action 
{

    /**
     * Отображает главную страницу
     */
    public function indexAction() 
    {
        $this->view->content = '<h1>I LOVE ZEND FRAMEWORK!</h1>';
    }

    /**
     * Страница из меню
     */    
    public function pageAction() 
    {

        $pageId = $this->_getParam('pageId');

        $tablePages = new DbTable_Pages();
        $page = $tablePages->getPage($pageId);

        $this->view->page = $page;
        
    }

}