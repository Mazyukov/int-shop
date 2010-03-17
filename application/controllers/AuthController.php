<?php

/**
 * AuthController
 * 
 * Работа с авторизацией, аутентификацией, и прочими схожими действиями
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class AuthController extends Zend_Controller_Action 
{

    /**
     * Регистрация пользователя
     */    
    public function registerAction() 
    {
        // Инициализируем форму регистрации
        $formRegister = new Form_Register();
        
        // Проверяем типа запроса, если POST значит пришли данные формы
        if ($this->_request->isPost()) {
            
            // Проверяем на валидность поля формы
            if ($formRegister->isValid($this->_getAllParams())) {
                
                // Инициализируем объект отвечающий за таблицу пользователей
                $tableUsers = new DbTable_Users();
                
                // Формируем масив для вставки в базу данных
                // Пароль преобразовываем в sha1 хеш добавляя "соль" для безопасности
                $userData = array(
                    'email'         => $formRegister->getValue('email'),
                    'password'      => sha1($formRegister->getValue('password') . 'jdh37dgvs'),
                    'name'          => $formRegister->getValue('name'),
                    'sex'           => $formRegister->getValue('sex'),
                    'date_birth'    => $formRegister->getValue('date_birth'),
                    'age'           => $formRegister->getValue('age'),
                    'about'         => $formRegister->getValue('about'),
                );
                
                // Вставляем данные в базу данных
                $tableUsers->insert($userData);
    
                // Задаем сообщение о успешной регистрации
                $this->_helper->FlashMessenger->setNamespace('messages')->addMessage('Поздравляем с успешной регистрацией');
                // Перенаправление на главную страницу
                $this->_helper->redirector->gotoRoute(array(), 'default');
                
            }
        }
        
        // Передаем форму в скрипт вида
        $this->view->formRegister = $formRegister;
       
    }
    
}
