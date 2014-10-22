<?php
//-- database configuration
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$dbname='db_halal';
//-- database connection
$db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
$rst="";
$s="1";
if(isset($_GET['q'])){
  $s=isset($_GET['s'])?$_GET['s']:$s;
  $query=$_GET['q'];
  if($s=="1"){
    $qry="SELECT a.id,a.iname,a.ecode,b.status_nm,a.desc  "
        ."FROM ingredient a "
        ."LEFT JOIN status b on a.id_status=b.id "
        ."WHERE a.iname LIKE '%".$query."%'";
  }else{
    $qry="SELECT a.id,a.iname,a.ecode,b.status_nm,a.desc  "
        ."FROM ecode a "
        ."LEFT JOIN status b on a.id_status=b.id "
        ."WHERE a.ecode LIKE '%".$query."%'";    
  }     
  $rst="containing <b>".$query."</b></div>\n";    
}else{
  $query=isset($_GET['l'])?$_GET['l']:"a";
  $qry="SELECT a.id,a.iname,a.ecode,b.status_nm,a.desc  "
      ."FROM ingredient a "
      ."LEFT JOIN status b on a.id_status=b.id "
      ."WHERE a.iname LIKE '".$query."%'";
  $rst="starting with letter <b>".strtoupper($query)."</b></div>\n";
} 
$res=$db->query($qry) or die("Having error in execution ==".$db->error);
$i=0;
$html="<div class=\"clearHead\"><div class=\"iname\"><b>Ingredient</b></div><div class=\"stat\"><b>Status</b></div></div>\n";
while($row=$resi->fetch_row())
{
  $html.="<div class=\"clear\">"
        ."<div class=\"iname\" id=\"lnk".$row[0]."\" href=\"#load".$row[0]."\" rel=\"#load".$row[0]."\" title=\"".($s=="1"?$row[1]:$row[2])."\">".($s=="1"?$row[1]:$row[2])."</div>"
        ."<div class=\"stat\" title=\"".$row[3]."\">".$row[3]."</div>\n"
        ."<div class=\"desc\" id=\"load".$row[0]."\">"
        ."<b>Name</b> : ".$row[1]."<br />"
        .($row[2]!=""?"<b>E-Code</b> : ".$row[2]."<br />":"")
        ."<b>Status</b> : ".$row[3]."<br />"
        ."<b>Description</b><br />".$row[4]."</div></div>\n";
  $i++;
}
?><html lang="en">
  <head>
    <title>Halal v0.1(beta)</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="content-language" content="id" />
    <meta name="author" content="Cahya DSN" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />    
    <link href="https://plus.google.com/106979874997502462275" rel="author" />
    <link href='http://fonts.googleapis.com/css?family=Share' rel='stylesheet' type='text/css' />
    <link href='halal.css' rel='stylesheet' type='text/css'  media="screen"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="jquery.cluetip.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="menu">
        <div class="item">
          <a class="link icon_mail"></a>
          <div class="item_content">
            <h2>Contact us</h2>
            <p>
              <a href="mailto:cahyadsn@gmail.com">eMail</a>
              <a href="https://plus.google.com/106979874997502462275?prsrc=3">Google+</a>
              <a href="http://www.facebook.com/profile.php?id=760508295">Facebook</a>
            </p>
          </div>
        </div>    
        <div class="item">
          <a class="link icon_find"></a>
          <div class="item_content">
          <h2>Search</h2>
          <p>
            <input type="text" name="stext" id="stext" placeholder="ingredient or e-code"></input>
            <select name="stype" id="stype">
              <option value="1">in Ingredient</option>
              <option value="2">in E-Code</option>
            </select>
            <div href="#" name="go" id="go">Go</div>
          </p>
        </div>
      </div>      
    </div>
<?php
if($s=="1"){
  echo "<div class=\"letterbar\">\n";
  foreach(range('a', 'z') as $letter) { 
    echo "<a href=\"halal.php?l=".$letter."\">".strtoupper($letter)."</a>".($letter=='z'?"</div>\n":"\n "); 
  }
}
echo "<div class=\"result\">Showing <b>".$i."</b> results for ".($s=="1"?"Ingredients":"E-Code")." ".$rst.$html;
?>  
    </div>
  <script src="halal.min.js" type="text/javascript"></script>
</body>
</html>  