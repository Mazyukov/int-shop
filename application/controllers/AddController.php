<?php

/**
 * AuthController
 *
 * ������ � ������������, ���������������, � ������� ������� ����������
 *
 * @author ��������� ������� aka San ��� http://zendframework.ru
 */
class AddController extends Zend_Controller_Action
{

    /**
     * ����������� ������������
     */
    public function articlesAction()
    {
        // �������������� ����� �����������
        $formArticles = new Form_Articles();

        // ��������� ���� �������, ���� POST ������ ������ ������ �����
        if ($this->_request->isPost()) {

            // ��������� �� ���������� ���� �����
            if ($formArticles->isValid($this->_getAllParams())) {

                // �������������� ������ ���������� �� ������� �������������
                $tableArticles = new DbTable_Articles();

                // ��������� ����� ��� ������� � ���� ������
                // ������ ��������������� � sha1 ��� �������� "����" ��� ������������
                $articlesData = array(
                    'pages_id'         => $formArticles->getValue('pages_id'),
                    'title'          => $formArticles->getValue('title'),
                );

                // ��������� ������ � ���� ������
                $tableArticles->insert($articlesData);

                // ������ ��������� � �������� �����������
                $this->_helper->FlashMessenger->setNamespace('messages')->addMessage('����������� � �������� ������������');
                // ��������������� �� ������� ��������
                $this->_helper->redirector->gotoRoute(array(), 'default');

            }
        }

        // �������� ����� � ������ ����
        $this->view->formArticles = $formArticles;

    }

}
