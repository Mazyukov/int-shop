<?php

/**
 * ArticlesController
 *
 * Работа с статьями
 *
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class ArticlesController extends Zend_Controller_Action
{
    /**
     * Список статей
     */
    public function indexAction()
    {
        $tableArticles = new DbTable_Articles();
        $articles = $tableArticles->getArticles();
        $this->view->articles = $articles;
    }

    /**
     * Выбранная статья
     */
    public function viewAction()
    {
        // Получение параметра пришедшего от пользователя
        $articleId = $this->_getParam('articleId');

        // Создание объекта модели, благодаря autoload нам нет необходимости подключать класс через require
        $tableArticles = new DbTable_Articles();

        // Выполнения метода модели по получению информации о статье
        $article = $tableArticles->getArticles($articleId);

        // Определение переменных для вида
        $this->view->article = $article;
    }
}
