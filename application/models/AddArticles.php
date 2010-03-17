<?php


class DbTable_AddArticles extends App_Form
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
        $this->setAction($helperUrl->url(array(), 'articles_addarticles'));

        // Указываем метод формы
        $this->setMethod('post');

        // Задаем атрибут class для формы
        $this->setAttrib('class', 'addarticles');

        $pages_id = new Zend_Form_Element_Text('pages_id', array(
            'label'       => 'Id страницы:',
            'rows'        => '1',
            'cols'        => '10',
            'validators'  => array(
                array('StringLength', true, array(0, 2))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($pages_id);

        // Text элемент "Имя". Проверяется на алфавитные символы и цифры, а также на длину
        // Валидатор Alnum использует установленную локаль для определения алфавита символов.
        $title = new Zend_Form_Element_Text('title', array(
            'required'    => true,
            'label'       => 'Категория:',
            'maxlength'   => '30',
            'validators'  => array(
                array('Alnum', true, array(true)),
                array('StringLength', true, array(0, 30))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($title);

        $title->setName('title');


        // Textarea элемент "О себе"
        $text = new Zend_Form_Element_Textarea('text', array(
            'label'       => 'Текст:',
            'rows'        => '5',
            'cols'        => '45',
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($text);

        // Элемент CAPTCHA, защита от спама
        $captcha = new Zend_Form_Element_Captcha('captcha', array(
            'label' => "Введите символы:",
            'captcha' => array(
                'captcha'   => 'Image', // Тип CAPTCHA
                'wordLen'   => 4,       // Количество генерируемых символов
                'width'     => 260,     // Ширина изображения
                'timeout'   => 120,     // Время жизни сессии хранящей символы
                'expiration'=> 300,     // Время жизни изображения в файловой системе
                'font'      => Zend_Registry::get('config')->path->rootPublic . 'fonts/arial.ttf', // Путь к шрифту
                'imgDir'    => Zend_Registry::get('config')->path->rootPublic . 'images/captcha/', // Путь к изобр.
                'imgUrl'    => Zend_Registry::get('config')->url->base . '/images/captcha/', // Адрес папки с изображениями
                'gcFreq'    => 1        // Частота вызова сборщика мусора
            ),
        ));

        $this->addElement($captcha);

        // Переопределяем сообщение об ошибке для валидатора NotEmpty
        $validatorNotEmpty = new Zend_Validate_NotEmpty();
        $validatorNotEmpty->setMessages(array(
            Zend_Validate_NotEmpty::IS_EMPTY  => 'agreeRules'));

        // Checkbox элемент "Согласен с правилами".
        $agreeRules = new Zend_Form_Element_Checkbox('agreeRules', array(
            'required'    => true,
            'label'       => 'Обещаю следовать правилам и любить отечество:',
            'filters'     => array('Int'),
            'validators'  => array($validatorNotEmpty),
        ));

        $this->addElement($agreeRules);

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

        // Группируем элементы

        // Группа полей связанных с авторизационными данными
        $this->addDisplayGroup(
            array('pages_id', 'title', 'text'), 'addArticlesGroup',
            array(
                'legend' => 'Добавление категории'
            )
        );



        // Группа полей кнопок
        $this->addDisplayGroup(
            array('agreeRules', 'submit', 'reset'), 'buttonsGroup'
        );

    }
}