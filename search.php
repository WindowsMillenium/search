<?include("inc/functions.php");?>
<html>
 <head>
  <?head($GLOBALS['displayQ'], array("search"));?>
 </head>
 <body>
  <?headerElem();?>
  <div class="container">
   <?
   if($GLOBALS['q']==""){
    echo "<script>document.getElementById('query').focus();</script>";
   }else{
    $res=getResults();
    if($res==0){
     echo "<p>Sorry, no results were found</p><h3>Search Suggestions</h3>";
     echo "<ul>";
      echo "<li>Check your spelling</li>";
      echo "<li>Try more general words</li>";
      echo "<li>Try different words that mean the same thing</li>";
     echo "</ul>";
    }else{
   ?>
    <div class="info">
     <strong><?echo $res['count'];?></strong>
     <?echo $res['count']==1 ? "result" : "results";?> found in <?echo $res['time'];?> seconds
    </div>
    <div class="results">
     <?
     foreach($res['results'] as $re){
      $t=htmlFilt($re[0]);
      $u=htmlFilt($re[1]);
      $d=htmlFilt($re[2]);
     ?>
      <div class="result">
       <h3 class="title">
        <a target="<?echo isset($_SESSION['newW']) ? '_blank':'';?>" onmousedown="this.href='<?echo HOST;?>/url.php?u='+encodeURIComponent(this.getAttribute('data-href'));" data-href="<?echo $u;?>" href="<?echo $u;?>"><?echo strlen($t)>59 ? substr($t, 0, 59)."..":$t;?></a>
       </h3>
       <p class="url" title="<?echo $u;?>"><?echo $u;?></p>
       <p class="description"><?echo $d;?></p>
      </div>
     <?
     }
     ?>
    </div>
   <?  
    }
   }
   ?>
  </div>
  <?footer();?>
 </body>
</html>
