<?include("inc/functions.php");?>
<html>
 <head>
  <?head("Settings");?>
 </head>
 <body>
  <?headerElem();?>
  <div class="container">
   <h1>Settings</h1>
   <p>Configure the behaviour of Searching</p>
   <?
   if(isset($_POST['settings'])){
    $newWindow=isset($_POST['newWindow']) ? 1:0;
    if($newWindow==1){
     $_SESSION['newW']=1;
    }else{
     unset($_SESSION['newW']);
    }
    if(isset($_POST['limit'])){
     if($_POST['limit']==10){
      unset($_SESSION['limit']);
     }else{
      $_SESSION['limit']=$_POST['limit'];
     }
    }
    echo "<h2>Saved Settings</h2>";
   }
   ?>
   <form action="settings.php" method="POST">
    <table cellspacing="20"><tbody>
     <tr>
      <td><label style="line-height: 8px;" for="newWindow">Open Search Results URL's In new Window</label></td>
      <td><input type="checkbox" name="newWindow" id="newWindow" <?echo isset($_SESSION['newW']) ? 'checked':'';?>/></td>
     </tr>
     <tr>     
      <td><label style="line-height: 8px;">Limit Of Search Result In a Page</label></td>
      <td><input type="text" name="limit" value="<?echo isset($_SESSION['limit']) ? $_SESSION['limit']:10;?>"/></td>
     </tr>
    </tbody></table>
    <button name="settings">Save Settings</button>
   </form>
  </div>
  <?footer();?>
 </body>
</html>
