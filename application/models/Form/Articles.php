<?php

/**
 * Form_Register
 *
 * ����� �����������
 *
 * @author ��������� ������� aka San ��� http://zendframework.ru
 */
class Form_Articles extends App_Form
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
        $this->setAction($helperUrl->url(array(), 'add_articles'));

        // ��������� ����� �����
        $this->setMethod('post');

        // ������ ������� class ��� �����
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


        // �������������� ��������� �� ������ ��� ���������� NotEmpty
        $validatorNotEmpty = new Zend_Validate_NotEmpty();


        // ������ Submit
        $submit = new Zend_Form_Element_Submit('submit', array(
            'label'       => 'Dobavit`',
        ));

        $submit->setDecorators(array('ViewHelper'));

        $this->addElement($submit);

        // ������ Reset, ���������� ����� � ��������� ���������
        $reset = new Zend_Form_Element_Reset('reset', array(
            'label'       => 'Reset',
        ));

        // �������������� ����������, ���-�� ��������� ��� ������ � ���
        $reset->setDecorators(array('ViewHelper'));
        $this->addElement($reset);

        // ���������� ��������

        // ������ ����� ��������� � ���������������� �������
        $this->addDisplayGroup(
            array('pages_id', 'title', 'text'), 'addDataGroup',
            array(
                'legend' => 'Add category'
            )
        );



        // ������ ����� ������
        $this->addDisplayGroup(
            array('agreeRules', 'submit', 'reset'), 'buttonsGroup'
        );

    }
}