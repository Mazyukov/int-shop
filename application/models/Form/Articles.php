<?php

/**
 * Form_Register
 *
 * Форма регистрации
 *
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class Form_Articles extends App_Form
{
    /**
     * Создание формы
     */
    public function init()
    {
        // Вызываем родительский метод
        parent::init();

        // Указываем action формы
        $helperUrl = new Zend_View_Helper_Url();
        $this->setAction($helperUrl->url(array(), 'add_articles'));

        // Указываем метод формы
        $this->setMethod('post');

        // Задаем атрибут class для формы
        $this->setAttrib('class', 'register');



        $pages_id = new Zend_Form_Element_Text('pages_id', array(
            'required'    => true,
            'label'       => 'Pages id:',
            'maxlength'   => '2',
            'validators'  => array(
                array('StringLength', true, array(0, 2))
             ),
            'filters'     => array('Int'),
        ));

        $this->addElement($pages_id);


       $title = new Zend_Form_Element_Text('title', array(
            'required'    => true,
            'label'       => 'Category:',
            'maxlength'   => '50',
            'validators'  => array(
                array('Alnum', true, array(true)),
                array('StringLength', true, array(0, 50))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($title);


        // Переопределяем сообщение об ошибке для валидатора NotEmpty
        $validatorNotEmpty = new Zend_Validate_NotEmpty();


        // Кнопка Submit
        $submit = new Zend_Form_Element_Submit('submit', array(
            'label'       => 'Dobavit`',
        ));

        $submit->setDecorators(array('ViewHelper'));

        $this->addElement($submit);

        // Кнопка Reset, возвращает форму в начальное состояние
        $reset = new Zend_Form_Element_Reset('reset', array(
            'label'       => 'Reset',
        ));

        // Перезаписываем декораторы, что-бы выставить две кнопки в ряд
        $reset->setDecorators(array('ViewHelper'));
        $this->addElement($reset);

        // Группируем элементы

        // Группа полей связанных с авторизационными данными
        $this->addDisplayGroup(
            array('pages_id', 'title', 'text'), 'addDataGroup',
            array(
                'legend' => 'Add category'
            )
        );



        // Группа полей кнопок
        $this->addDisplayGroup(
            array('agreeRules', 'submit', 'reset'), 'buttonsGroup'
        );

    }
}