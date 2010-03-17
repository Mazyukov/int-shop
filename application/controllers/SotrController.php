<?php

/**
 * AuthController
 *
 * Работа с авторизацией, аутентификацией, и прочими схожими действиями
 *
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class SotrController extends Zend_Controller_Action
{

    /**
     * Регистрация пользователя
     */
    public function sotrudnichestvoAction()
    {
        // Инициализируем форму регистрации
        $formSotrudnichestvo = new Form_Sotrudnichestvo();

        // Проверяем типа запроса, если POST значит пришли данные формы
        if ($this->_request->isPost()) {

            // Проверяем на валидность поля формы
            if ($formSotrudnichestvo->isValid($this->_getAllParams())) {

                // Инициализируем объект отвечающий за таблицу пользователей
                $tableSotrudnichestvo = new DbTable_Pages();

                // Формируем масив для вставки в базу данных
                // Пароль преобразовываем в sha1 хеш добавляя "соль" для безопасности
                $sotrudnichestvoData = array(
                    'title'          => $formSotrudnichestvo->getValue('name'),
                    'text'           => $formSotrudnichestvo->getValue('about'),
                );

                // Вставляем данные в базу данных
                $tableSotrudnichestvo->insert($sotrudnichestvoData);

                // Задаем сообщение о успешной регистрации
                $this->_helper->FlashMessenger->setNamespace('messages')->addMessage('Поздравляем с успешной регистрацией');
                // Перенаправление на главную страницу
                $this->_helper->redirector->gotoRoute(array(), 'default');

            }
        }

        // Передаем форму в скрипт вида
        $this->view->formSotrudnichestvo = $formSotrudnichestvo;

    }

}
