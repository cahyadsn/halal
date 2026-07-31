<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : inc/process.php
AUTHOR       : CAHYA DSN
CREATED DATE : 2026-07-31 08:00:56
UPDATED DATE : 2026-07-31 08:28:37
DEMO SITE    : -
SOURCE CODE  : https://github.com/cahyadsn/halal
================================================================================
This program is free software; you can redistribute it and/or modify it under the
terms of the MIT License.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

See the MIT License for more details

copyright (c) 2026 by cahya dsn; cahyadsn@gmail.com
================================================================================ */

//-- database connection
$db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
$rst="";
$s="1";
if(isset($_GET['q'])){
  $s=isset($_GET['s'])?$_GET['s']:$s;
  $query=$_GET['q'];
  $escaped_query = $db->real_escape_string($query);
  if($s=="1"){
    $qry="SELECT a.id,a.iname,a.ecode,b.status_nm,a.desc  "
        ."FROM ingredient a "
        ."LEFT JOIN status b on a.id_status=b.id "
        ."WHERE a.iname LIKE '%".$escaped_query."%'";
  }else{
    $qry="SELECT a.id,a.iname,a.ecode,b.status_nm,a.desc  "
        ."FROM ecode a "
        ."LEFT JOIN status b on a.id_status=b.id "
        ."WHERE a.ecode LIKE '%".$escaped_query."%'";    
  }     
  $rst="containing <b>".htmlspecialchars($query, ENT_QUOTES, 'UTF-8')."</b></div>\n";    
}else{
  $query=isset($_GET['l'])?$_GET['l']:"a";
  $escaped_query = $db->real_escape_string($query);
  $qry="SELECT a.id,a.iname,a.ecode,b.status_nm,a.desc  "
      ."FROM ingredient a "
      ."LEFT JOIN status b on a.id_status=b.id "
      ."WHERE a.iname LIKE '".$escaped_query."%'";
  $rst="starting with letter <b>".htmlspecialchars(strtoupper($query), ENT_QUOTES, 'UTF-8')."</b></div>\n";
} 
$res=$db->query($qry) or die("Having error in execution ==".$db->error);
$i=0;
$html="<div class=\"clearHead\"><div class=\"iname\"><b>Ingredient</b></div><div class=\"stat\"><b>Status</b></div></div>\n";
while($row=$res->fetch_row())
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
