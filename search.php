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
    require "inc/spellcheck.php";
    $SC=new SpellCheck();
    $corSp=$SC->check($GLOBALS['q']);
    if($corSp!=""){
     echo "<p style='color:red;font-size:15px;margin-bottom:10px'>Did you mean ? <br/><a href='?q=$corSp'>".$corSp."</a></p>";
    }
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
     <?echo $res['count']==1 ? "result" : "results";?> found in <?echo $res['time'];?> seconds. Page <?echo $GLOBALS['p'];?>
    </div>
    <div class="results">
     <?
     foreach($res['results'] as $re){
      $t=htmlFilt($re[0]);
      $u=htmlFilt($re[1]);
      $d=htmlFilt($re[2]);
      if(strlen($GLOBALS['q']) > 2){
       $d=str_replace($GLOBALS['q'], "<strong>{$GLOBALS['q']}</strong>", $d);
      }
     ?>
      <div class="result">
       <h3 class="title">
        <a target="_blank" onmousedown="this.href='<?echo HOST;?>/url.php?u='+encodeURIComponent(this.getAttribute('data-href'));" data-href="<?echo $u;?>" href="<?echo $u;?>"><?echo strlen($t)>59 ? substr($t, 0, 59)."..":$t;?></a>
       </h3>
       <p class="url" title="<?echo $u;?>"><?echo $u;?></p>
       <p class="description"><?echo $d;?></p>
      </div>
     <?
     }
     ?>
    </div>
    <div class="pages">
     <?
     $count=(ceil($res['count']/10)) + 1;
     for($i=1;$i<$count;$i++){
      $isC=$GLOBALS['p']==$i ? 'current':'';
      echo "<a href='?p=$i&q={$GLOBALS['q']}' class='button $isC'>$i</a>";
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
