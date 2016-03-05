<?php

class CCV extends CDatabase {

  private $cv;
  private $editmode;
  private $editgroup;
  private $edititem;
  private $loggedin;
  private $userrole;

  public function __construct($options) {
  
  parent::__construct($options);
  
  $this->editmode = isset($_GET['edit']) ? $_GET['edit']: null;
  $this->editgroup = isset($_GET['group']) && $this->editmode=="group" ? $_GET['group']: null;
  $this->edititem = isset($_GET['item']) && $this->editmode=="item" ? $_GET['item']: null;
  
  $this->loggedin = isset($_SESSION['user']) ? true : false;
  $this->userrole = isset($_SESSION['user']) ? $_SESSION['user']->userrole : null;
  
  }
  
  
  public function CVCollectAll() {
  
  $sql = "SELECT cvgroup.*,cvitem.* FROM cvgroup left outer join cvitem on itemgroup=groupid ORDER BY cvgroup.weight asc,cvitem.year1 desc";
  $res = $this->ExecuteSelectQueryAndFetchAll($sql);
  
  $this->cv = $res;
  
  }
  
  public function GetGroups() {
  
  $sql = "SELECT * FROM cvgroup ORDER BY weight asc";
  $params = array();
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  
  return $res;
  
  }
  
  public function GetGroupName($groupid) {
  
  $sql = "SELECT groupname FROM cvgroup WHERE groupid=?";
  $params = array($groupid);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  
  return $res['0']->groupname;
  
  }
  
  public function GetGroupDesc($groupid) {
  
  $sql = "SELECT groupdescription FROM cvgroup WHERE groupid=?";
  $params = array($groupid);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);

  return $res['0']->groupdescription;
  
  }
  
  
  public function GetItemDesc($itemid) {
  
  $sql = "SELECT description FROM cvitem WHERE itemid=?";
  $params = array($itemid);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  
  return $res['0']->description;
  
  }
  
    public function GetItemYear1($itemid) {
  
  $sql = "SELECT year1 FROM cvitem WHERE itemid=?";
  $params = array($itemid);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  
  return $res['0']->year1;
  
  }
  
  public function GetItemYear2($itemid) {
  
  $sql = "SELECT year2 FROM cvitem WHERE itemid=?";
  $params = array($itemid);
  $res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);
  
  return $res['0']->year2;
  
  }
  

  
  public function CVPresentAll() {
  
  //default style for CVGroup
  $style="yearlast";
  
  $html = "";
  
  //collect cv items
  $this->CVCollectAll();
  $groups = $this->GetGroups();

  
  if (!empty($groups)) {
 
  
      foreach ($groups as $cvgroup) {
      

      if($cvgroup->groupid==$this->editgroup) {
      
	  $html .= $this->EditGroup($cvgroup->groupid);
      
      }

 
      else {
    
      	if ($cvgroup->groupid==1||$cvgroup->groupid==2) {
	$style = "textonly";
	}
	elseif ($cvgroup->groupid==6||$cvgroup->groupid==7) {
	$style = "yearfirst";
	}
	elseif ($cvgroup->groupid==8) {
	$style = "noyear";
	}
	else {
	$style = "yearlast";
	}
	
	$html .= $this->CVGroup($cvgroup->groupid,$style);
      
      }
      
      
      }
      

    
    }
    return $html;
 
  }
  
  
  public function CVGroup($groupid,$style) {
  
  $html = "";
  
  
  if (!empty($this->cv)) {
  
  
  $name = $this->GetGroupName($groupid);
  $editgroup = $this->userrole=='admin' ? "<a href='cv.php?edit=group&group=$groupid'>redigera</a>" : "";
  
    $html .= "<h3>$name</h3><p>$editgroup</p>";  
    $html .= "<ul>";
   
    foreach ($this->cv as $cvgroup) {
      if ($cvgroup->groupid==$groupid) { 
      
      if(isset($this->edititem) && $cvgroup->itemid==$this->edititem) {
      
	  $html .= "<li class='cv-item'>".$this->EditItem($cvgroup->itemid)."</li>";
      
      }
      else {
      $edititem = $this->userrole=='admin' ? "<a href='cv.php?edit=item&item={$cvgroup->itemid}'>redigera</a>" : "";
      
   
	switch ($style) {
	
	case "yearfirst": 
	if (!empty($cvgroup->description)) {

	  $html .= "<li class='cv-item'>{$cvgroup->year1}, {$cvgroup->description} $edititem</li>";
	  
	  }
	
	break;
      
	case "yearlast": 
	if (!empty($cvgroup->description)) {
	
	  $html .= "<li class='cv-item'>{$cvgroup->description}, ({$cvgroup->year1}) $edititem</li>";
	}
	break;
	
	case "textonly": 
	
	  if (!empty($cvgroup->groupdescription)) {

	  $html .= "<div>{$cvgroup->groupdescription} $editgroup</div>";
	}
	
	break;
	
	case "noyear": 
	
	  if (!empty($cvgroup->description)) {

	  $html .= "<li class='cv-item'>{$cvgroup->description} $edititem</li>";
	}
	
	break;
	

      
	}
	}
      }
    }
    
    $html .= "</ul>";
    
    return $html;
  
  }
  }
  
  public function EditGroup($groupid) {
  
  if (!empty($this->cv)) {
    $html = "<form><legend>Redigera CV-grupp</legend><input type='hidden' name='groupid' value='$groupid'><table>";
    $name = $this->GetGroupName($groupid);
    $description = $this->GetGroupDesc($groupid);
    
      $html .= "<tr><td><label>Rubrik: </label></td><td ><input type='text' name='groupname' value='$name'></td></tr>";
      $html .= "<tr><td><label>Beskrivning: </label></td><td ><textarea name='' cols='70' rows='5'>{$description}</textarea></td></tr>";
      $html .= "";
      $html .= "</table><input type='submit' value='Spara' name='savegroup'></form>";
      return $html;
      }
  }
  
    public function EditItem($itemid) {
  
    if (!empty($this->cv)) {
    $description = $this->GetItemDesc($itemid);
    $year1 = $this->GetItemYear1($itemid);
    $year2 = $this->GetItemYear2($itemid);
    $html = "<form><input type='hidden' name='itemid' value='$itemid'>";
        
      $html .= "<input type='text' name='description' size='60' value='$description'> ";
      $html .= "från: <input type='text' size='4' name='description' value='$year1'> ";
      $html .= "till: <input type='text' size='4' name='description' value='$year2'> ";
      $html .= "<br>Kategori: <input type='text' name='description' value=''>";
      $html .= "<input type='submit' value='Spara' name='saveitem'></form>";
      return $html;
      }
  }
  


}