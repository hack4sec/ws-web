<?php
class Hosts extends Zend_Db_Table_Abstract {
    protected $_name = 'hosts';
    public function getList($projectId) {
        return $this->fetchAll("project_id = " . (int)$projectId, "name ASC")->toArray();
    }
} 