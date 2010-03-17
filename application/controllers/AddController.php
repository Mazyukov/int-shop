<?php

/**
 * AuthController
 *
 * Работа с авторизацией, аутентификацией, и прочими схожими действиями
 *
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class AddController extends Zend_Controller_Action
{

    /**
     * Регистрация пользователя
     */
    public function articlesAction()
    {
        // Инициализируем форму регистрации
        $formArticles = new Form_Articles();

        // Проверяем типа запроса, если POST значит пришли данные формы
        if ($this->_request->isPost()) {

            // Проверяем на валидность поля формы
            if ($formArticles->isValid($this->_getAllParams())) {

                // Инициализируем объект отвечающий за таблицу пользователей
                $tableArticles = new DbTable_Articles();

                // Формируем масив для вставки в базу данных
                // Пароль преобразовываем в sha1 хеш добавляя "соль" для безопасности
                $articlesData = array(
                    'pages_id'         => $formArticles->getValue('pages_id'),
                    'title'          => $formArticles->getValue('title'),
                );

                // Вставляем данные в базу данных
                $tableArticles->insert($articlesData);

                // Задаем сообщение о успешной регистрации
                $this->_helper->FlashMessenger->setNamespace('messages')->addMessage('Поздравляем с успешной регистрацией');
                // Перенаправление на главную страницу
                $this->_helper->redirector->gotoRoute(array(), 'default');

            }
        }

        // Передаем форму в скрипт вида
        $this->view->formArticles = $formArticles;

    }

}
