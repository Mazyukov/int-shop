<?php

/**
 * Form_Register
 *
 * Форма регистрации
 *
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class Form_Sotrudnichestvo extends App_Form
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
        $this->setAction($helperUrl->url(array(), 'sotr_sotrudnichestvo'));

        // Указываем метод формы
        $this->setMethod('post');

        // Задаем атрибут class для формы
        $this->setAttrib('class', 'register');



        // Text элемент "Имя". Проверяется на алфавитные символы и цифры, а также на длину
        // Валидатор Alnum использует установленную локаль для определения алфавита символов.
        $name = new Zend_Form_Element_Text('name', array(
            'required'    => true,
            'label'       => 'Имя:',
            'maxlength'   => '30',
            'value'       => '',
            'validators'  => array(
                array('Alnum', true, array(true)),
                array('StringLength', true, array(0, 30))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($name);


        // Textarea элемент "О себе"
        $about = new Zend_Form_Element_Textarea('about', array(
            'label'       => 'О себе:',
            'rows'        => '5',
            'cols'        => '45',
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($about);

        // Переопределяем сообщение об ошибке для валидатора NotEmpty
        $validatorNotEmpty = new Zend_Validate_NotEmpty();

        // Кнопка Submit
        $submit = new Zend_Form_Element_Submit('submit', array(
            'label'       => 'Зарегистрироваться',
        ));

        $submit->setDecorators(array('ViewHelper'));

        $this->addElement($submit);

        // Кнопка Reset, возвращает форму в начальное состояние
        $reset = new Zend_Form_Element_Reset('reset', array(
            'label'       => 'Очистить',
        ));

        // Перезаписываем декораторы, что-бы выставить две кнопки в ряд
        $reset->setDecorators(array('ViewHelper'));
        $this->addElement($reset);


        // Группа полей связанных с личной информацией
        $this->addDisplayGroup(
            array('name', 'about'), 'privateDataGroup',
            array(
                'legend' => 'Личная информация'
            )
        );


        // Группа полей кнопок
        $this->addDisplayGroup(
            array('agreeRules', 'submit', 'reset'), 'buttonsGroup'
        );

    }
}