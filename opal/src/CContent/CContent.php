<?php

class CContent extends CDatabase {

  private $page;
  private $content;
  private $type;
  private $editmode;
  private $edititem;
  private $loggedin;
  private $userrole;

  public function __construct($options) {
  
  parent::__construct($options);
  
  $this->editmode = isset($_GET['edit']) ? $_GET['edit']: null;
  $this->edititem = isset($_GET['id']) && isset($this->editmode) ? $_GET['id']: null;
  
  $this->loggedin = isset($_SESSION['user']) ? true : false;
  $this->userrole = isset($_SESSION['user']) ? $_SESSION['user']->userrole : null;
  
  }
 
 
   public function GetContent() {
  
  $sql = "SELECT * FROM content";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->content = $res;
  
  }
 
 
 
  public function GetPage($page) {
  
  $sql = "SELECT * FROM content WHERE public=1 AND url=?";
  $params = array($page);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  
  $this->page = $res['0'];
  
  }
  
  
  public function ShowPage($page) {
  
  $html = "";
  $this->GetPage($page);
  
  if (!empty($this->page)) {
  
  if (isset($this->edititem)) {
    $html .= "<form>";
    $html .= "<input type='hidden' name='contentid' value='{$this->page->contentid}'>";
    $html .= "<label>Titel: </label><br><input type='text' name='contenttitle' size='70' value='{$this->page->contenttitle}'>";
    $html .= "<br><label>Innehåll: </label><br><textarea cols='90' rows='12' name='contenttext' >{$this->page->contenttext}</textarea>";
    $html .= "</form>";
  }
  else {
    $html .= "<h1>{$this->page->contenttitle}</h1>";
    $html .= "{$this->page->contenttext}";
  }
  }
  
  return $html;
  
  }
  
  
  public function AdminContent() {
  
  $html = "";
  if ($this->userrole=='admin') {
    $this->GetContent();
  }
   if (!empty($this->content)) {
   $html .= "<h2>Sidinnehåll</h2>";
   foreach($this->content as $content) {
   
    $html .= "<p><a href='{$content->url}.php?edit&id={$content->contentid}'>{$content->contenttitle}</a></p>";
   
   }
   
   }
  
  return $html;
  }
 
  
}