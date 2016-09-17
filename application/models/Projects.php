<?php
/**
 * @package WebScout
 * @see for EN http://hack4sec.pro/wiki/index.php/WebScout_en
 * @see for RU http://hack4sec.pro/wiki/index.php/WebScout
 * @license MIT
 * @copyright (c) Anton Kuzmin <http://anton-kuzmin.ru> (ru) <http://anton-kuzmin.pro> (en)
 * @author Anton Kuzmin
 */
class Projects extends Zend_Db_Table_Abstract {
    protected $_name = 'projects';

    public function getList() {
        $Hosts = new Hosts();

        $projects = $this->fetchAll()->toArray();
        foreach ($projects as $k => $v) {
            $projects[$k]['hosts'] = $Hosts->getList($v['id']);
        }

        return $projects;
    }
} 