<?php

/**
 * App_Validate_EqualInputs
 * 
 * Валидатор проверяет совпадение двух полей.
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */

class App_Validate_EqualInputs extends Zend_Validate_Abstract {
    
    /**
     * Метка ошибки
     * @var const 
     */
    const NOT_EQUAL = 'stringsNotEqual';
    
    /**
     * Текст ошибки
     * @var array 
     */
    protected $_messageTemplates = array(
        self::NOT_EQUAL => 'Strings are not equal'
    );
    
    /**
     * Название поля, с которым сравниваем
     * @var string 
     */
    protected $_contextKey;
    
    /**
     * Конструктор валидатора
     *
     * @param string $key Название поля, с которым сравниваем
     */
    public function __construct($key) {
        $this->_contextKey = $key;
    }
    
    
    /**
     * 
     * Сравнение полей
     * 
     * Сравнение значения $value с $context[ $this->_contextKey ]
     * 
     * @param string $value значение которое поддается валидации
     */
    public function isValid($value, $context = null) {
        
        $value = (string) $value;

        if (is_array($context)) {
            if (isset($context[$this->_contextKey]) && ($value === $context[$this->_contextKey])) {
                return true;
            }
        }
        else if (is_string($context) && ($value === $context))  {
            return true;
        }
    
        $this->_error(self::NOT_EQUAL);
        
        return false;
    }
}