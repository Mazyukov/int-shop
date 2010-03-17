<?php

/**
 * App_Form_Element_Email
 * 
 * Элемент формы - электронная почта
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class App_Form_Element_Email extends Zend_Form_Element_Text 
{
    /**
     * Инициализация элемента
     * 
     * return void
     */  
    public function init()
    {
        $this->setLabel('Электронная почта:');
        $this->setAttrib('maxlength', 80);
        $this->addValidator('EmailAddress', true);
        $this->addValidator('NoDbRecordExists', true, array('users', 'email'));
        $this->addFilter('StringTrim');
    }
}