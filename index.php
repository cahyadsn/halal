<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : index.php
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
require_once 'inc/config.php';
require_once 'inc/process.php';
?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>Halal v<?php echo $app_ver;?></title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="content-language" content="id" />
    <meta name="author" content="Cahya DSN" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />    
    <link href="https://plus.google.com/106979874997502462275" rel="author" />
    <link href='http://fonts.googleapis.com/css?family=Share' rel='stylesheet' type='text/css' />
    <link href='assets/css/halal.css' rel='stylesheet' type='text/css'  media="screen"/>
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
    echo "<a href=\"index.php?l=".$letter."\">".strtoupper($letter)."</a>".($letter=='z'?"</div>\n":"\n "); 
  }
}
echo "<div class=\"result\">Showing <b>".$i."</b> results for ".($s=="1"?"Ingredients":"E-Code")." ".$rst.$html;
?>  
    </div>
  <script src="assets/js/halal<?php echo ($app_env=='PRO'?'':'.min');?>.js" type="text/javascript"></script>
</body>
</html>  