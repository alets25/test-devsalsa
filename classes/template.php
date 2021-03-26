<?php
namespace classes;

class Template
{
    public $pageHome = "";
    public $pageNotFound = "";
    public $pageError = "";
    public $pathTemplate = "";
    public $page;
    private $_setting;

    public function __construct($setting){
        $this->_setting = $setting;
    }

    private function validateStructSettingTemplate(){
        if(array_key_exists("path",$this->_setting) && 
            array_key_exists("pageHome",$this->_setting) && 
            array_key_exists("pageNotFound",$this->_setting) && 
            array_key_exists("pageError",$this->_setting) && 
            array_key_exists("pageExt",$this->_setting)){
            return true;
        }
        return false;
    }

    public function getHome()
    {
        if($this->validateStructSettingTemplate()){
            $this->pageHome = $this->_setting['path'].$this->_setting['pageHome'].'.'.$this->_setting['pageExt'];
        }
        return $this->pageHome;
    }

    public function getNotFound()
    {
        if($this->validateStructSettingTemplate()){
            $this->pageNotFound = $this->_setting['path'].$this->_setting['pageNotFound'].'.'.$this->_setting['pageExt'];
        }
        return $this->pageNotFound;
    }

    public function getError()
    {
        if($this->validateStructSettingTemplate()){
            $this->pageError = $this->_setting['path'].$this->_setting['pageError'].'.'.$this->_setting['pageExt'];
        }
        return $this->pageError;
    }

    public function loadPage($page)
    {
        if($this->validateStructSettingTemplate()){
            $this->page = $this->_setting['path'].$page.'.'.$this->_setting['pageExt'];
        }
        return $this->page;
    }

    public function redirectHome()
    {
        $url = $_SERVER['REQUEST_URI'];
        $home = $this->_setting['pageHome'];
        header("Location:".$url."/index.php?r=$home");
    }
}
