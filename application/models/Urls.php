<?php
/**
 * @package WebScout
 * @see for EN http://hack4sec.pro/wiki/index.php/WebScout_en
 * @see for RU http://hack4sec.pro/wiki/index.php/WebScout
 * @license MIT
 * @copyright (c) Anton Kuzmin <http://anton-kuzmin.ru> (ru) <http://anton-kuzmin.pro> (en)
 * @author Anton Kuzmin
 */
class Urls extends Zend_Db_Table_Abstract {
    protected $_name = 'urls';

    public function getByUrl($url) {
        $urlParams = "$url?%";
        return $this->fetchAll(
            "url = {$this->getAdapter()->quote($url)} OR url LIKE {$this->getAdapter()->quote($urlParams)}"
        )->toArray();
    }
} 