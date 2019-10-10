<?php

class CArtwork extends CDatabase {

  private $works;
  private $work;
  private $workinfo;
  private $type;
  private $theme;
  private $filter;
  private $technique;
  private $editmode;
  private $edititem;
  private $item;

  public function __construct($options) {
  
  parent::__construct($options);
  
  $this->editmode = isset($_GET['edit']) ? $_GET['edit']: null;
  $this->edititem = isset($_GET['id']) && isset($this->editmode) ? $_GET['id']: null;
  $this->item = isset($_GET['id']) ? $_GET['id']: null;
  $this->type = isset($_GET['type']) ? $_GET['type']: null;
  $this->theme = isset($_GET['theme']) ? $_GET['theme']: null;
  $this->technique = isset($_GET['technique']) ? $_GET['technique']: null;
  $this->filter = !isset($_GET['technique']) && !isset($_GET['theme'])? "nofilter" : "filtered";
    
  }
 
 public function SelectedWorkType($type) {
 
 $html = ($type == $this->type) ? "class='selected-worktype'" : "";
 return $html;
 
 }
 
 public function SelectedFilter($type) {
 
 $html = ($type == $this->technique || $type == $this->theme || $type == $this->filter) ? "class='selected-worktype'" : "";
 return $html;
 
 }
 
 public function WorkMenu() {
 
  $html = "";
  return $html;	
 }
 
 
  public function ThemeMenu() {
  	  
   $this->GetThemePreviews();
   
   $themes = $this->works;
   // Starttag meny
   $html = "<div class='workmenu'>";
   
   $html .= "<a href='theme.php' ".$this->SelectedFilter("nofilter").">Alla</a> ";
    
   foreach($themes as $theme) {
   //Menyval utifrån tema
   $html .= "<a href='theme.php?theme={$theme->artcategory}' ".$this->SelectedFilter($theme->artcategory).">{$theme->artcattitle}</a> "; 
   }
   
   $this->GetTechniques();
   $techniques = $this->works;
   foreach($techniques as $tech) {
   //Menyval utifrån teknik
   $html .= "<a href='theme.php?technique={$tech->technique}' ".$this->SelectedFilter($tech->technique).">{$tech->description}</a> "; 
   }
	
	// Endtag meny
   $html .= "</div>";
 
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
  
  public function GetWorksByFilter($theme,$technique) {
  $sql1 = isset($theme) ? " AND artcategory=?": "";
  $sql2 = isset($technique) ? " AND technique=?": "";
  $sql = "SELECT * FROM artwork WHERE public=1{$sql1}{$sql2} ORDER BY year DESC";

  $param1 = isset($theme) ? $theme : null;
  $param2 = isset($technique) ? $technique : null;
  $params = isset($param1) && !isset($param2) ? array($param1) : null;

  $params = isset($param2) && !isset($param1) && !isset($params) ? array($param2) : $params;

  $params = isset($param2) && isset($param1) && !isset($params) ? [$param1,$param2] : $params;

  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);

  $this->works = $res;
  }
 
  //funktion som hämtar tumnaglar för verkgrupper ur databasen
  
  public function GetPreviews() {
  
  $sql = "SELECT * FROM workgroup ORDER BY wgroupsortkey ASC";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->works = $res;
  
  }
 
    //funktion som hämtar tumnaglar för motivkategorier ur databasen
  
  public function GetThemePreviews() {
  
  $sql = "SELECT * FROM artcategory WHERE public=1 ORDER BY artcatsortkey ASC";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->works = $res;
  
  }
  
  
  public function GetTechniques() {
  
  $sql = "SELECT * FROM technique WHERE public=1";
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
  $sql = "SELECT * FROM workgroup WHERE public=1 AND wgroupcode=?";
  $params = array($type);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  $this->workinfo = $res;  
  }
 
  
  //hämta information för en motivkategori
  public function GetCategoryInfo($type) {
  $sql = "SELECT * FROM artcategory WHERE public=1 AND artcategory=?";
  $params = array($type);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  $this->workinfo = $res;  
  }  
  
  //hämtar alla verk som hör till en motivkategori  
  public function GetCategoryWorks($id) {
  $sql = "SELECT * FROM artwork WHERE public=1 AND artcategory=?";
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
  
  //visa en vald motivkategori med info och verk
  
  case "category":
  $id = $this->item;
  $this->GetCategoryInfo($id);
  $this->GetCategoryWorks($id);
  $html .= $this->CategoryWithInfo($this->workinfo);
  $html .= $this->WorkgroupAsList($this->works);
  break;
  
  //visa tumnaglar för ingångssida för olika motivkategorier
  
  case "theme":
  $this->GetThemePreviews();
  $html .= $this->ThemePreview($this->works);
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

  //Visa filtrerbara verk
  
  public function ShowFilteredWorks() {
  
  $html = "";
 
  if($this->filter == "nofilter") {
  $this->GetAllWorks();
  }

  else {
  $this->GetWorksByFilter($this->theme,$this->technique);
  }
  
  $html .= $this->WorkGroupAsList($this->works);	
  
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
  
  //Funktion som ska visa thumbnails för en ett visst motivtema. Länken ska leda till en presentationssida som visar alla verk för detta tema. 

  public function ThemePreview($works) {
  $html = "";
  foreach($works as $work) {
      $html .= "<figure class='workpreview'><a href='works.php?type=category&id={$work->artcategory}'><img class='workpreview' title='{$work->artcattitle}' alt='{$work->artcattitle}' src='img.php?src=work/{$work->artcatimage}&width=600&height=450&crop-to-fit'></a><figcaption class='overlay'>{$work->artcattitle}</figcaption></figure>";
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
  
//Visa huvudinfo om en grupp med verk ur samma kategori

  public function CategoryWithInfo($works) {
  $html = "";
  foreach($works as $work) {
      $html = "<h2>{$work->artcattitle}</h2>";
      //$html .= "<figure class='workpresentation'><img class='workpresentation' title='{$work->wgrouptitle}' alt='{$work->wgrouptitle}' src='img.php?src=work/{$work->wgroupimage}&width=700&height=150&crop-to-fit'><figcaption>";
      //$html .= "<h4>Om verket:</h4>";
      $html .= "<div class='workpresentation'>{$work->artcatdesc}</div>";
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