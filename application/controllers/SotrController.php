<?php

/**
 * AuthController
 *
 * ������ � ������������, ���������������, � ������� ������� ����������
 *
 * @author ��������� ������� aka San ��� http://zendframework.ru
 */
class SotrController extends Zend_Controller_Action
{

    /**
     * ����������� ������������
     */
    public function sotrudnichestvoAction()
    {
        // �������������� ����� �����������
        $formSotrudnichestvo = new Form_Sotrudnichestvo();

        // ��������� ���� �������, ���� POST ������ ������ ������ �����
        if ($this->_request->isPost()) {

            // ��������� �� ���������� ���� �����
            if ($formSotrudnichestvo->isValid($this->_getAllParams())) {

                // �������������� ������ ���������� �� ������� �������������
                $tableSotrudnichestvo = new DbTable_Pages();

                // ��������� ����� ��� ������� � ���� ������
                // ������ ��������������� � sha1 ��� �������� "����" ��� ������������
                $sotrudnichestvoData = array(
                    'title'          => $formSotrudnichestvo->getValue('name'),
                    'text'           => $formSotrudnichestvo->getValue('about'),
                );

                // ��������� ������ � ���� ������
                $tableSotrudnichestvo->insert($sotrudnichestvoData);

                // ������ ��������� � �������� �����������
                $this->_helper->FlashMessenger->setNamespace('messages')->addMessage('����������� � �������� ������������');
                // ��������������� �� ������� ��������
                $this->_helper->redirector->gotoRoute(array(), 'default');

            }
        }

        // �������� ����� � ������ ����
        $this->view->formSotrudnichestvo = $formSotrudnichestvo;

    }

}
