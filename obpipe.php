<?php
/*
 * For documentation about the class please read the file obpipe.doc
 */
 
class OBPipe {
  protected $obList;
  protected $active;
  protected $skipFlush;
  protected $globalBuffer;
  
  function __construct() {
    $this->skipFlush = false;
    $this->globalBuffer = '';
    $this->active = false;
    $this->obList = array();
    ob_start(array($this, 'Output'));
  }
  
  function __destruct() {
  }

  public function kill() {
    ob_end_clean();
  }
  
  public function activate($name) {
    $this->getBuffer();
    $this->active = $name;
    if(!isset($this->obList[$name])) {
      $this->obList[$name] = '';
    }
  }
  
  public function current() {
    return $this->active;  
  }
  
  public function clean($name) {
    if($name === false) {
      $this->globalBuffer = '';
    } else {
      $this->obList[$name] = '';
    }
  }
  
  public function remove($name) {
    if($name === false) {
      $this->globalBuffer = '';
    } elseif(isset($this->obList[$name])) {
      unset($this->obList[$name]);
    }
  }
  
  protected function getBuffer() {
    $content = ob_get_contents();
    $this->skipFlush = true;
    ob_clean();
    $this->skipFlush = false;
    if($this->active === false) {
      $this->globalBuffer .= $content;
    } elseif(isset($this->obList[$this->active])) {
      $this->obList[$this->active] .= $content;
    } else {
      $this->obList[$this->active] = $content;
    }
  }
  
  public function flush($name) {
    $this->getBuffer();
    if($name == false) {
      $result = $this->globalBuffer;
      $this->globalBuffer = '';
    } elseif(isset($this->obList[$name])) {
      $result = $this->obList[$name];
      $this->obList[$name] = '';
    } else {
      $result = false;
    }
    return $result;
  }
  
  public function get($name) {
    $this->getBuffer();
    if($name === false) {
      return $this->globalBuffer;
    } elseif(isset($this->obList[$name])) {
      return $this->obList[$name];
    }
    return false;
  }
  
  public function length($name) {
    if($name === false) {
      return strlen($this->globalBuffer);
    } elseif(isset($this->obList[$name])) {
      return strlen($this->obList[$name]);
    }
    return false;
  }

  public function Output($result, $clear = false) {
    if($this->skipFlush !== true) {
      $result = '';
      $content = ob_get_contents();
      if($this->active === false) {
        $this->globalBuffer .= $content;
      } elseif(isset($this->obList[$this->active])) {
        $this->obList[$this->active] .= $content;
      } else {
        $this->obList[$this->active] = $content;
      }
      $result .= $this->globalBuffer;
      $this->globalBuffer = '';
      foreach($this->obList as $key => $value) {
        $result .= $value;
        $this->obList[$key] = '';
      }
    }
    return $result;
  }
  
  public function getNames() {
    return array_keys($this->obList);
  }

  public function setNames($names) {
    if(!is_array($names)) {
      return false;
    }
    $newList = array();
    foreach($names as $name) {
      if($name !== false) {
        if(isset($this->obList[$name])) {
          $newList[$name] = $this->obList[$name];
        } else {
          $newList[$name] = '';
        }
      }
    }
    $this->obList = $newList;
    return array_keys($this->obList);
  }
  
}

class SOBPipe {
  protected static $instance = null;
  
  public static function Init() {
    if(self::$instance == null) {
      self::$instance = new OBPipe();
    }
    return self::$instance;
  }
  
  public static function activate($name) {
    self::Init()->activate($name);
  }
  
  public static function current() {
    return self::Init()->current();
  }
  
  public static function clean($name) {
    self::Init()->clean($name);
  }
  
  public static function remove($name) {
    self::Init()->remove($name);
  }
  
  public static function flush($name) {
    return self::Init()->flush($name);
  }
  
  public static function get($name) {
    return self::Init()->get($name);
  }
  
  public static function length($name) {
    return self::Init()->length($name);
  }
  
  public static function Output($result) {
    return self::Init()->Output($result, true);
  }
  
  public static function getNames() {
    return self::Init()->getNames();
  }

  public static function setNames($names) {
    return self::Init()->setNames($names);
  }

  public static function kill() {
    self::Init()->kill();
    self::$instance = null;
  }
  
}

?>