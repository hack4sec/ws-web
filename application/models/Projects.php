<?php
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