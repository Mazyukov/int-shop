<?php

/**
 * App_Controller_Plugin_FlashMessenger
 * 
 * Плагин, проверяет наличие сообщений о успешных результатах и в случае если они есть, создает именованый сегмент
 * для их вывода в макете
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class App_Controller_Plugin_FlashMessenger extends Zend_Controller_Plugin_Abstract
{
    
   /**
    * Перехват события postDispatch
    * 
    */
    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
        // Инициализируем помощник FlashMessenger и получаем сообщения
        $actionHelperFlashMessenger = new Zend_Controller_Action_Helper_FlashMessenger();
        $messagesSuccess = $actionHelperFlashMessenger->setNamespace('messages')->getMessages();

        // Если сообщений нет, или процес диспетчеризации еще продолжается, просто выходим из плагина
        if (empty($messagesSuccess) || !$request->isDispatched()) {
        	return;
        }
        
        // Получаем объект  Zend_Layout
        $layout = Zend_Layout::getMvcInstance();
        // Получаем объект  вида
        $view = $layout->getView();
        // Добавляем переменную для вида
        $view->messages = $messagesSuccess;        

        // Устанавливаем объект вида с новыми переменным и производим рендеринг скрипта вида в сегмент messages
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer
            ->setView($view)
            ->renderScript('messages.tpl', 'messages')
            ;
    }
}