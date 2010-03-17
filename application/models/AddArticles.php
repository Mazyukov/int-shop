<?php


class DbTable_AddArticles extends App_Form
{
    /**
     * �������� �����
     */
    public function init()
    {
        // �������� ������������ �����
        parent::init();

        // ��������� action �����
        $helperUrl = new Zend_View_Helper_Url();
        $this->setAction($helperUrl->url(array(), 'articles_addarticles'));

        // ��������� ����� �����
        $this->setMethod('post');

        // ������ ������� class ��� �����
        $this->setAttrib('class', 'addarticles');

        $pages_id = new Zend_Form_Element_Text('pages_id', array(
            'label'       => 'Id ��������:',
            'rows'        => '1',
            'cols'        => '10',
            'validators'  => array(
                array('StringLength', true, array(0, 2))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($pages_id);

        // Text ������� "���". ����������� �� ���������� ������� � �����, � ����� �� �����
        // ��������� Alnum ���������� ������������� ������ ��� ����������� �������� ��������.
        $title = new Zend_Form_Element_Text('title', array(
            'required'    => true,
            'label'       => '���������:',
            'maxlength'   => '30',
            'validators'  => array(
                array('Alnum', true, array(true)),
                array('StringLength', true, array(0, 30))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($title);

        $title->setName('title');


        // Textarea ������� "� ����"
        $text = new Zend_Form_Element_Textarea('text', array(
            'label'       => '�����:',
            'rows'        => '5',
            'cols'        => '45',
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($text);

        // ������� CAPTCHA, ������ �� �����
        $captcha = new Zend_Form_Element_Captcha('captcha', array(
            'label' => "������� �������:",
            'captcha' => array(
                'captcha'   => 'Image', // ��� CAPTCHA
                'wordLen'   => 4,       // ���������� ������������ ��������
                'width'     => 260,     // ������ �����������
                'timeout'   => 120,     // ����� ����� ������ �������� �������
                'expiration'=> 300,     // ����� ����� ����������� � �������� �������
                'font'      => Zend_Registry::get('config')->path->rootPublic . 'fonts/arial.ttf', // ���� � ������
                'imgDir'    => Zend_Registry::get('config')->path->rootPublic . 'images/captcha/', // ���� � �����.
                'imgUrl'    => Zend_Registry::get('config')->url->base . '/images/captcha/', // ����� ����� � �������������
                'gcFreq'    => 1        // ������� ������ �������� ������
            ),
        ));

        $this->addElement($captcha);

        // �������������� ��������� �� ������ ��� ���������� NotEmpty
        $validatorNotEmpty = new Zend_Validate_NotEmpty();
        $validatorNotEmpty->setMessages(array(
            Zend_Validate_NotEmpty::IS_EMPTY  => 'agreeRules'));

        // Checkbox ������� "�������� � ���������".
        $agreeRules = new Zend_Form_Element_Checkbox('agreeRules', array(
            'required'    => true,
            'label'       => '������ ��������� �������� � ������ ���������:',
            'filters'     => array('Int'),
            'validators'  => array($validatorNotEmpty),
        ));

        $this->addElement($agreeRules);

        // ������ Submit
        $submit = new Zend_Form_Element_Submit('submit', array(
            'label'       => '������������������',
        ));

        $submit->setDecorators(array('ViewHelper'));

        $this->addElement($submit);

        // ������ Reset, ���������� ����� � ��������� ���������
        $reset = new Zend_Form_Element_Reset('reset', array(
            'label'       => '��������',
        ));

        // �������������� ����������, ���-�� ��������� ��� ������ � ���
        $reset->setDecorators(array('ViewHelper'));
        $this->addElement($reset);

        // ���������� ��������

        // ������ ����� ��������� � ���������������� �������
        $this->addDisplayGroup(
            array('pages_id', 'title', 'text'), 'addArticlesGroup',
            array(
                'legend' => '���������� ���������'
            )
        );



        // ������ ����� ������
        $this->addDisplayGroup(
            array('agreeRules', 'submit', 'reset'), 'buttonsGroup'
        );

    }
}