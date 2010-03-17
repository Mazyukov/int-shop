<?php

/**
 * Form_Register
 *
 * Форма регистрации
 *
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class Form_Register extends App_Form
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
        $this->setAction($helperUrl->url(array(), 'auth_register'));

        // Указываем метод формы
        $this->setMethod('post');

        // Задаем атрибут class для формы
        $this->setAttrib('class', 'register');

        // Используемый собственный элемент App_Form_Element_Email
        $email = new App_Form_Element_Email('email', array(
            'required'    => true,
        ));

        // Добавление элемента в форму
        $this->addElement($email);

        // Password элемент "Пароль". Значение проверяется валидатором App_Validate_Password
        $password = new Zend_Form_Element_Password('password', array(
            'required'    => true,
            'label'       => 'Пароль:',
            'maxlength'   => '30',
            'validators'  => array('Password'),
        ));

        $this->addElement($password);

        // Элемент "Подтверждение пароля".
        // Проверяется на совпадение с полем "Пароль" валидатором App_Validate_EqualInputs
        $passwordApprove = new Zend_Form_Element_Password('password_approve', array(
            'required'    => true,
            'label'       => 'Подтвердите пароль:',
            'maxlength'   => '30',
            'validators'  => array(array('EqualInputs', true, array('password'))),
        ));

        $this->addElement($passwordApprove);

        // Text элемент "Имя". Проверяется на алфавитные символы и цифры, а также на длину
        // Валидатор Alnum использует установленную локаль для определения алфавита символов.
        $name = new Zend_Form_Element_Text('name', array(
            'required'    => true,
            'label'       => 'Имя:',
            'maxlength'   => '30',
            'validators'  => array(
                array('Alnum', true, array(true)),
                array('StringLength', true, array(0, 30))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($name);

        $name->setName('name');
        // Radio элемент "Пол".
        $sex = new Zend_Form_Element_Radio('sex', array(
            'label'       => 'Пол:',
            'multiOptions'=> array('m' => 'Муж', 'f' => 'Жен'),
            'validators'  => array(array('InArray', true, array(array('m', 'f'), true)))
        ));

        // Задаем разделитель пробел, для того что бы радио кнопки располагались в ряд
        $sex->setSeparator('&nbsp;');

        $this->addElement($sex);

        // Элемент "Дата рождения". Элемент содержит нестандартный декоратор - javascript календарь
        $dateBirth = new Zend_Form_Element_Text('date_birth', array(
            'label'       => 'Дата рождения:',
            'maxlength'   => '10',
            'validators'  => array(array('Date', true, array('dd.MM.yyyy'))),
            'filters'     => array('StringTrim'),
        ));

        // Удаляем все существующие декораторы, назначенные по умолчанию
        $dateBirth->clearDecorators();

        // Назначаем новые, включая наш декоратор Calendar
        // Это необходимо для того что бы изображение календаря размещалось сразу за полем ввода
        $dateBirth
            ->addDecorator('ViewHelper')
            ->addDecorator('Calendar')
            ->addDecorator('Errors')
            ->addDecorator('HtmlTag', array('tag' => 'dd'))
            ->addDecorator('Label', array('tag' => 'dt'));

        $this->addElement($dateBirth);

        // Select элемент "Возраст".
        $age = new Zend_Form_Element_Select('age', array(
            'label'       => 'Возраст:',
            'multiOptions'=> array('', '11 - 20', '21 - 30', '31 - 40'),
            'filters'     => array('Int'),
        ));

        $this->addElement($age);

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
            array('email', 'password', 'password_approve'), 'authDataGroup',
            array(
                'legend' => 'Авторизационные данные'
            )
        );

        // Группа полей связанных с личной информацией
        $this->addDisplayGroup(
            array('name', 'last_name', 'sex', 'date_birth', 'age', 'about'), 'privateDataGroup',
            array(
                'legend' => 'Личная информация'
            )
        );

        // Защита от спама
        $this->addDisplayGroup(
            array('captcha'), 'captchaGroup',
            array(
                'legend' => 'Будьте человеком!'
            )
        );

        // Группа полей кнопок
        $this->addDisplayGroup(
            array('agreeRules', 'submit', 'reset'), 'buttonsGroup'
        );

    }
}