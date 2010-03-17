<?php

/**
 * Form_Register
 *
 * ����� �����������
 *
 * @author ��������� ������� aka San ��� http://zendframework.ru
 */
class Form_Sotrudnichestvo extends App_Form
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
        $this->setAction($helperUrl->url(array(), 'sotr_sotrudnichestvo'));

        // ��������� ����� �����
        $this->setMethod('post');

        // ������ ������� class ��� �����
        $this->setAttrib('class', 'register');



        // Text ������� "���". ����������� �� ���������� ������� � �����, � ����� �� �����
        // ��������� Alnum ���������� ������������� ������ ��� ����������� �������� ��������.
        $name = new Zend_Form_Element_Text('name', array(
            'required'    => true,
            'label'       => '���:',
            'maxlength'   => '30',
            'value'       => '',
            'validators'  => array(
                array('Alnum', true, array(true)),
                array('StringLength', true, array(0, 30))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($name);


        // Textarea ������� "� ����"
        $about = new Zend_Form_Element_Textarea('about', array(
            'label'       => '� ����:',
            'rows'        => '5',
            'cols'        => '45',
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        ));

        $this->addElement($about);

        // �������������� ��������� �� ������ ��� ���������� NotEmpty
        $validatorNotEmpty = new Zend_Validate_NotEmpty();

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


        // ������ ����� ��������� � ������ �����������
        $this->addDisplayGroup(
            array('name', 'about'), 'privateDataGroup',
            array(
                'legend' => '������ ����������'
            )
        );


        // ������ ����� ������
        $this->addDisplayGroup(
            array('agreeRules', 'submit', 'reset'), 'buttonsGroup'
        );

    }
}