<?php
class Requests extends Zend_Db_Table_Abstract {
    protected $_name = 'requests';

    public function getByhost($hostId) {
        return $this->fetchAll("host_id = $hostId");
    }
} 