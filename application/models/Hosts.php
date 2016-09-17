<?php
/**
 * @package WebScout
 * @see for EN http://hack4sec.pro/wiki/index.php/WebScout_en
 * @see for RU http://hack4sec.pro/wiki/index.php/WebScout
 * @license MIT
 * @copyright (c) Anton Kuzmin <http://anton-kuzmin.ru> (ru) <http://anton-kuzmin.pro> (en)
 * @author Anton Kuzmin
 */
class Hosts extends Zend_Db_Table_Abstract {
    protected $_name = 'hosts';
    public function getList($projectId) {
        return $this->fetchAll("project_id = " . (int)$projectId, "name ASC")->toArray();
    }
} 