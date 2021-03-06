<?php

/**
 * Файл формирования маршрутов. Происходит инициализация объекта маршрутизации и задание правил маршрутизации
 *
 * @author Александр Махомет aka San для http://zendframework.ru
 */

$router = new Zend_Controller_Router_Rewrite();

$router->addRoute('articles',
     new Zend_Controller_Router_Route('articles/:articleId', array('controller' => 'articles', 'action' => 'view'))
);

$router->addRoute('pages',
     new Zend_Controller_Router_Route('pages/:pageId', array('controller' => 'index', 'action' => 'page'))
);

$router->addRoute('auth_register',
     new Zend_Controller_Router_Route_Static('register', array('controller' => 'auth', 'action' => 'register'))
);

$router->addRoute('add_articles',
     new Zend_Controller_Router_Route_Static('articles', array('controller' => 'add', 'action' => 'articles'))
);

$router->addRoute('sotr_sotrudnichestvo',
     new Zend_Controller_Router_Route_Static('sotrudnichestvo', array('controller' => 'sotr', 'action' => 'sotrudnichestvo'))
);