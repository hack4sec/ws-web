<?php
class HostsInfo extends Zend_Db_Table_Abstract {
    protected $_name = "hosts_info";
    private $_jsonFields = [
        'backups', 'cms', 'dafs_dirs', 'dafs_files', 'encodings', 'nf', 'ns', 'headers', 'sitemap', 'powered_by'
    ];

    public function getInfo($hostId) {
        $result = [];
        if ($info = $this->fetchAll("host_id = $hostId")) {
            $info = $info->toArray();
            foreach ($info as $row) {
                $result[$row['key']] = in_array($row['key'], $this->_jsonFields) ? json_decode($row['value']) : $row['value'];
            }
        }
        return $result;
    }
} 