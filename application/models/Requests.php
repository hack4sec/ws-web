<?php
/**
 * @package WebScout
 * @see for EN http://hack4sec.pro/wiki/index.php/WebScout_en
 * @see for RU http://hack4sec.pro/wiki/index.php/WebScout
 * @license MIT
 * @copyright (c) Anton Kuzmin <http://anton-kuzmin.ru> (ru) <http://anton-kuzmin.pro> (en)
 * @author Anton Kuzmin
 */
class Requests extends Zend_Db_Table_Abstract {
    protected $_name = 'requests';

    public function getByhost($hostId) {
        return $this->fetchAll("host_id = $hostId");
    }
} 