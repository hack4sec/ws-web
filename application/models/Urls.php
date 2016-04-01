<?php
class Urls extends Zend_Db_Table_Abstract {
    protected $_name = 'urls';

    public function getByUrl($url) {
        $urlParams = "$url?%";
        return $this->fetchAll(
            "url = {$this->getAdapter()->quote($url)} OR url LIKE {$this->getAdapter()->quote($urlParams)}"
        )->toArray();
    }
} 