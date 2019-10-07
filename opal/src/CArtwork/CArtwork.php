<?php

class CArtwork extends CDatabase {

  private $works;
  private $work;
  private $workinfo;
  private $type;
  private $view;
  private $editmode;
  private $edititem;
  private $item;

  public function __construct($options) {
  
  parent::__construct($options);
  
  $this->editmode = isset($_GET['edit']) ? $_GET['edit']: null;
  $this->edititem = isset($_GET['id']) && isset($this->editmode) ? $_GET['id']: null;
  $this->item = isset($_GET['id']) ? $_GET['id']: null;
  $this->type = isset($_GET['type']) ? $_GET['type']: null;
  $this->view = isset($_GET['view']) ? $_GET['view']: "workgroup";
  
  }
 
 public function SelectedWorkType($type) {
 
 $html = ($type == $this->type) ? "class='selected-worktype'" : "";
 return $html;
 
 }
 
  public function SelectedViewType($type) {
 
 $html = ($type == $this->view) ? "class='selected-worktype'" : "";
 return $html;
 
 }
 
 public function WorkMenu() {
 
   // Starttag meny
   $html = "<div class='workmenu'>";
   
   //Menyval verk utifrån verkgrupp
   $html .= "<a href='works.php?view=workgroup'".$this->SelectedViewType('workgroup').">verk</a>";
   
   //Menyval utifrån tema
   $html .= "<a href='works.php?view=theme'".$this->SelectedViewType('theme').">teman</a>";
   
   //Menyval utifrån teknik
	$html .= "<a href='works.php?view=technique'".$this->SelectedViewType('technique').">teknik</a>"; 
	
	// Endtag meny
   $html .= "</div>";
 	 

  return $html;
  	 
 	 
 //gammal meny baserad på tekniker	 
 /* 
 $html = "<div class='workmenu'><a href='works.php?type=drawing' ".$this->SelectedWorkType('drawing').">Teckningar</a> <a href='works.php?type=inkwashes' ".$this->SelectedWorkType('inkwashes').">Tuschmålningar</a> <a href='works.php?type=watercolor' ".$this->SelectedWorkType('watercolor').">Akvareller</a> <a href='works.php?type=installation' ".$this->SelectedWorkType('installation').">Installation</a></div>";
 return $html;
 */
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
 
  //funktion som hämtar tumnaglar för verkgrupper ur databasen
  
  public function GetPreviews() {
  
  $sql = "SELECT * FROM workgroup ORDER BY wgroupsortkey ASC";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->works = $res;
  
  }
  
  //hämtar alla verk som hör till en grupp verk
  
  public function GetWorkGroupWorks($id) {
  $sql = "SELECT * FROM artwork WHERE public=1 AND workgroupcode=?";
  $params = array($id);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  $this->works = $res;
  
  }
  
  //hämta information för en verkgrupp
  public function GetWorkGroupInfo($type) {
  $sql = "SELECT * FROM workgroup WHERE wgroupcode=?";
  $params = array($type);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  $this->workinfo = $res;
  
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
  
  //visa ett enskilt verk
  case "single":
  $this->GetWork($this->item);
  $html .= $this->WorkAsList($this->works);
  break;
  
  //visa en vald verkgrupp, hämta info och visa överst, visa sedan alla verk
  case "workgroup":
  $id = $this->item;
  $this->GetWorkGroupInfo($id);
  $this->GetWorkGroupWorks($id);
  $html .= $this->WorkGroupWithInfo($this->workinfo);
  $html .= $this->WorkGroupAsList($this->works);
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
  
  /*
  default:
  $html = $this->NoWorks();	
  break;
  */
  
  //visa thumbnails med verk eller serier
  default:
  $this->GetPreviews();
  $html .= $this->WorkPreview($this->works);	
  break;

  }
  
  return $html;

  
  }

    public function NoWorks() {
  $html = "<p>Välj en kategori.</p>";
  
  return $html;
  }
  
  public function WorkAsList($works) {
  $html = "";
  foreach($works as $work) {
      $html .= "<figure class='work'><a href='works.php?type=single&id={$work->workid}'><img class='work' title='{$work->worktitle} {$work->year}' alt='{$work->worktitle} {$work->year}' src='img.php?src=work/{$work->workimage}&width=700'></a><figcaption>{$work->worktitle} {$work->year}</figcaption></figure>";
  }
  return $html;
  }
  
//Funktion som ska visa thumbnails för en verkserie. Länken ska leda till en presentationssida som visar verken ur serien. 

    public function WorkPreview($works) {
  $html = "";
  foreach($works as $work) {
      $html .= "<figure class='workpreview'><a href='works.php?type=workgroup&id={$work->wgroupcode}'><img class='workpreview' title='{$work->wgrouptitle}' alt='{$work->wgrouptitle}' src='img.php?src=work/{$work->wgroupimage}&width=600&height=450&crop-to-fit'></a><figcaption class='overlay'>{$work->wgrouptitle}</figcaption></figure>";
  }
  return $html;
  }
  
//Visa huvudinfo om en grupp med verk ur samma serie

  public function WorkGroupWithInfo($works) {
  $html = "";
  foreach($works as $work) {
      $html = "<h2>{$work->wgrouptitle}</h2>";
      //$html .= "<figure class='workpresentation'><img class='workpresentation' title='{$work->wgrouptitle}' alt='{$work->wgrouptitle}' src='img.php?src=work/{$work->wgroupimage}&width=700&height=150&crop-to-fit'><figcaption>";
      //$html .= "<h4>Om verket:</h4>";
      $html .= "<div class='workpresentation'>{$work->wgroupdescription}</div>";
      //$html .= "</figcaption></figure>";
  }
  return $html;
  }
  
    
//Visa en grupp med verk ur samma serie

  public function WorkGroupAsList($works) {
  	  $html = "";
	  foreach($works as $work) {
      $html .= "<figure class='workpreview'><a href='works.php?type=single&id={$work->workid}'><img class='workpreview' title='{$work->worktitle} {$work->year}' alt='{$work->worktitle}' src='img.php?src=work/{$work->workimage}'></a></figure>";
  }
  return $html;
  }
  
//Visa ett enskilt verk med information
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