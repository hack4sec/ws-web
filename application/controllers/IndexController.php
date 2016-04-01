<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        #$Projects = new Projects();
        #$this->view->projects = $Projects->getList();
        $this->forward('projects');
    }

    public function sitemapLevelAction() {
        $UrlsBase = new UrlsBase();
        $this->getHelper('json')->sendJson(
            $UrlsBase->getChilds(
                $this->_getParam('host_id'),
                $this->_getParam('parent_id')
            )
        );
    }

    public function branchInfoAction() {
        $UrlsBase = new UrlsBase();
        $this->getHelper('json')->sendJson(
            $UrlsBase->branchInfo(
                $this->_getParam('id'),
                $this->_getParam('host_id')
            )
        );
    }

    public function projectsAction() {
        $Projects = new Projects();
        $this->view->projects = $Projects->getList();
    }

    public function hostsAction() {
        $Hosts = new Hosts();
        $this->view->hosts = $Hosts->getList($this->_getParam('project'));
    }

    public function hostAction() {
        $Hosts = new Hosts();
        $this->view->host = $Hosts->find($this->_getParam('host'))->current()->toArray();

        $HostsInfo = new HostsInfo();
        $this->view->hostInfo = $HostsInfo->getInfo($this->_getParam('host'));

        $Requests = new Requests();
        $this->view->requests = $Requests->getByhost($this->_getParam('host'));
    }
}

