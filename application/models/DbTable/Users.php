<?php

/**
 * DbTable_Users
 * 
 * Работа с пользователями
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class DbTable_Users extends Zend_Db_Table_Abstract 
{
    /**
     * Имя таблицы
     * @var string 
     */  
    protected $_name = 'users';

    /**
     * Внести пользователя в базу данных
     *
     * @return true
     */
    public function insert($userData) 
    {
        // Создаем объект фильтра
        $filterTranslit = new App_Filter_Translit();
        
        // Производим транслитерацию имени
        $userData['name_translit'] = $filterTranslit->filter($userData);

        // Приводим дату к формату Mysql
        if ($userData['date_birth'] != '') {
            $dateBirth = new Zend_Date($userData['date_birth'], 'dd.MM.yyyy');
            $userData['date_birth'] = $dateBirth->toString('yyyy-MM-dd');        	
        }
        else {
            $userData['date_birth'] = null;
        }

        // Приводим к значению null если поле не было заполнено
        if ($userData['age'] == 0) {
            $userData['age'] = null;
        }
        
        // Приводим к значению null если поле не было заполнено
        if ($userData['about'] == '') {
            $userData['about'] = null;
        }    
                
        // Вызываем родительский метод вставки в базу данных
        parent::insert($userData);

        return true;
    }
}