<?php

define("MODE_BYVAR", 1);
define("MODE_BYREPLACE", 2);

class View {

    protected $_file;
    protected $_data = array();
    protected $mode = MODE_BYVAR;

    /*
      public function __construct($file)
      {
      $this->_file = SYS_DIR.'/view/'.$file;
      }
     */

    public function __construct($view, $mode = MODE_BYVAR) {
        $this->_file = SYS_DIR . '/modules/' . $view . ".php";
        $this->mode = $mode;
    }

    public function set($key, $value) {

        $this->_data[$key] = $value;
    }

    public function get($key) {
        return $this->_data[$key];
    }
    
    public function generateRender(){
        if (!file_exists($this->_file)) {
            throw new Exception("Template " . $this->_file . " doesn't exist.");
        }
        if($this->mode == MODE_BYVAR){
            extract($this->_data);
            ob_start();
            include($this->_file);
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
        }else{
            $c = file_get_contents($this->_file);
            foreach($this->_data as $k=>$v){
                $c = str_replace("[[".$k."]]", $v, $c);
            }
            return $c;
        }
    }
    
    public function render(){
        echo $this->generateRender();
    }
    public function getrender(){
        return $this->generateRender();
    }

    /*
    public function render() {

        if (!file_exists($this->_file)) {
            throw new Exception("Template " . $this->_file . " doesn't exist.");
        }

        extract($this->_data);
        ob_start();
        include($this->_file);
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

    public function getrender() {
        if (!file_exists($this->_file)) {
            throw new Exception("Template " . $this->_file . " doesn't exist.");
        }

        extract($this->_data);
        ob_start();
        include($this->_file);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
*/
}
