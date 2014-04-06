<?include("inc/functions.php");?>
<html>
 <head>
  <?head("", array("index"));?>
 </head>
 <body>
  <?headerElem();?>
  <div class="container">
   <center>
    <h1>Web Search</h1>
    <form class="searchForm" action="search.php" method="GET">
     <input type="text" autocomplete="off" name="q" id="query"/>
     <div>
      <button>
       <svg class='shape-search' viewBox='0 0 100 100' class='shape-search'><use xlink:href='#shape-search'></use></svg>
      </button>
     </div>
      <p>Free, Open Source<br/>&<br/>Anonymous</p>
    </form>
   </center>
  </div>
  <?footer();?>
 </body>
</html>
