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
 
 public function SelectedWorkType($type) {
 
 $html = ($type == $this->type) ? "class='selected-worktype'" : "";
 return $html;
 
 }
 
 public function WorkMenu() {
 
 $html = "<div class='workmenu'><a href='works.php?type=drawing' ".$this->SelectedWorkType('drawing').">Teckningar</a> <a href='works.php?type=inkwashes' ".$this->SelectedWorkType('inkwashes').">Tuschmålningar</a> <a href='works.php?type=watercolor' ".$this->SelectedWorkType('watercolor').">Akvareller</a> <a href='works.php?type=installation' ".$this->SelectedWorkType('installation').">Installation</a></div>";
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
  
  public function GetWatercolor() {
  
  $sql = "SELECT * FROM artwork WHERE public=1 AND (technique='akvarell') ORDER BY year DESC";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->works = $res;
  
  }
  
  public function GetInkwashes() {
  
  $sql = "SELECT * FROM artwork WHERE public=1 AND (technique='tuschlavering') ORDER BY year DESC";
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
  $html .= $this->WorkWithInfo($this->works);
  break;
  
  case "drawing":
  $this->GetDrawings();
  $html = $this->WorkAsList($this->works);
  break;
  
  case "painting":
  $this->GetPaintings();
  $html = $this->WorkAsList($this->works);
  break;
  case "watercolor":
  $this->GetWatercolor();
  $html = $this->WorkAsList($this->works);
  break;
  case "inkwashes":
  $this->GetInkwashes();
  $html = $this->WorkAsList($this->works);
  break;
  
  case "installation":
  $this->GetInstallations();
  $html = $this->WorkAsList($this->works);
  break;
  
  default:
  $this->GetAllWorks();	
  break;

  }
  
  return $html;

  
  }
  
  
  public function WorkAsList($works) {
  $html = "";
  foreach($works as $work) {
      $html .= "<figure class='work'><a href='works.php?type=single&id={$work->workid}'><img class='work' title='{$work->worktitle} {$work->year}' alt='{$work->worktitle} {$work->year}' src='img.php?src=work/{$work->workimage}&width=400'></a><figcaption>{$work->worktitle} {$work->year}</figcaption></figure>";
  }
  return $html;
  }
  
  public function WorkWithInfo($works) {
  foreach($works as $work) {
      $html = "<h2>{$work->worktitle}</h2>";
      $html .= "<figure><img class='work' title='{$work->worktitle} {$work->year}' alt='{$work->worktitle} {$work->year}' src='img.php?src=work/{$work->workimage}'><figcaption>Titel: {$work->worktitle} <br>År: {$work->year}<br>Teknik: {$work->technique}<br>Storlek: {$work->worksize}</figcaption></figure>";
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