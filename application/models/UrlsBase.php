<?php
/**
 * @package WebScout
 * @see for EN http://hack4sec.pro/wiki/index.php/WebScout_en
 * @see for RU http://hack4sec.pro/wiki/index.php/WebScout
 * @license MIT
 * @copyright (c) Anton Kuzmin <http://anton-kuzmin.ru> (ru) <http://anton-kuzmin.pro> (en)
 * @author Anton Kuzmin
 */
class UrlsBase extends Zend_Db_Table_Abstract {
    protected $_name = 'urls_base';

    public function getChilds($hostId, $parentId) {
        $hostId = (int)$hostId;
        $parentId = (int)$parentId;
        $childs = $this->fetchAll(
            "parent_id = {$parentId} AND host_id = {$hostId}",
            "name ASC"
        )->toArray();

        foreach ($childs as $k => $v) {
            $childs[$k]['have_childs'] = (int)$this->_haveChilds($v['id']);
        }
        return $childs;
    }

    private function _haveChilds($id) {
        $select = $this->select()->from($this->_name, new Zend_Db_Expr('COUNT(id) > 0'))->where("parent_id = " . (int)$id);
        return $this->getAdapter()->fetchOne($select);
    }

    public function branchInfo($id, $hostId) {
        $id = (int)$id;
        $info = [];

        // URL
        $branchParts = [];
        $needId = $id;
        while (True) {
            $branchPart = $this->find($needId)->current()->toArray();
            $branchParts[] = $branchPart['name'];
            if (!$branchPart['parent_id']) {
                break;
            }
            $needId = $branchPart['parent_id'];
        }
        $url = implode("/", array_reverse($branchParts));
        if (strpos($branchParts[0], '.') === false) {
            $url .= "/"; #TODO может тут слеш добавлять если есть ещё родительские записи? Типа директория с точкой в имени
        }
        while (substr_count($url, "//")) {
            $url = str_replace("//", "/", $url);
        }
        $info['url'] = $url;

        // Params
        $info['params'] = $this->getAdapter()->fetchCol("SELECT name FROM urls_base_params WHERE parent_id = $id");

        // URLs
        $Urls = new Urls;
        $info['urls'] = $Urls->getByUrl($url);

        return $info;
    }
} 