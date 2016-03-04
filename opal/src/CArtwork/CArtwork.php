<?php

class CArtwork extends CDatabase {

  private $works;
  private $work;
  private $type;
  private $editmode;
  private $edititem;
  private $item;

  public function __construct($options) {
  
  parent::__construct($options);
  
  $this->editmode = isset($_GET['edit']) ? $_GET['edit']: null;
  $this->edititem = isset($_GET['id']) && isset($this->editmode) ? $_GET['id']: null;
  $this->item = isset($_GET['id']) ? $_GET['id']: null;
  
  $this->type = isset($_GET['type']) ? $_GET['type']: null;
  
  }
 
 
 public function WorkMenu() {
 
 $html = "<a href='works.php'>alla</a> <a href='works.php?type=drawing'>teckningar</a> <a href='works.php?type=painting'>målningar</a> <a href='works.php?type=installation'>installation</a>";
 return $html;
 }
 
 
  public function GetAllWorks() {
  
  $sql = "SELECT * FROM artwork WHERE public=1 ORDER BY year DESC";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->works = $res;
  
  }
  
  public function GetWork($id) {
  
  $sql = "SELECT * FROM artwork WHERE workid=?";
  $params = array($id);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  
  $this->works = $res;
  
  }
  
  public function GetDrawings() {
  
  $sql = "SELECT * FROM artwork WHERE public=1 AND (technique='blyerts' OR technique='tuschteckning') ORDER BY year DESC";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->works = $res;
  
  }
  
  public function GetPaintings() {
  
  $sql = "SELECT * FROM artwork WHERE public=1 AND (technique='akvarell' OR technique='olja' OR technique='tuschlavering') ORDER BY year DESC";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->works = $res;
  
  }
  
    public function GetInstallations() {
  
  $sql = "SELECT * FROM artwork WHERE public=1 AND (technique='installation') ORDER BY year DESC";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->works = $res;
  
  }
  
  public function ShowAll() {
  
  $html = "";
  $type = "all";
  if (!empty($this->type)) {
  $type = $this->type;
  }
  
  switch ($type) { 
  
  case "single":
  $this->GetWork($this->item);
  break;
  
  case "drawing":
  $this->GetDrawings();
  break;
  
  case "painting":
  $this->GetPaintings();
  break;
  
  case "installation":
  $this->GetInstallations();
  break;
  
  default:
  $this->GetAllWorks();	
  break;

  }
  
    foreach($this->works as $work) {
    
      $html .= "<figure><a href='works.php?type=single&id={$work->workid}'><img src='img.php?src=work/{$work->workimage}'></a><figcaption>{$work->worktitle} {$work->year}</figcaption></figure>";
    }

  return $html;
  }
  
  public function AdminWork() {
  
    $html = "";
  if ($this->userrole=='admin') {
    $this->GetAllWorks();
  }
   if (!empty($this->works)) {
   $html .= "<h2>Verk</h2>";
   foreach($this->works as $content) {
   
    $html .= "<p><a href='works.php?type=single&edit&id={$content->workid}'>{$content->worktitle}</a></p>";
   
   }
   
   }
  
  return $html;
  
  }

  
  
}