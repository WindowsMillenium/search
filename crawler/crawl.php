<?
ini_set("display_errors", "on");
set_time_limit(30);
include("../inc/config.php");
include("PHPCrawl/libs/PHPCrawler.class.php");
include("simple_html_dom.php");

function addURL($t, $u, $d){
 global $dbh;
 if($t!="" && filter_var($u, FILTER_VALIDATE_URL)){
  $check=$dbh->prepare("SELECT `id` FROM `search` WHERE `url`=?");
  $check->execute(array($u));
  $t=preg_replace("/\s+/", " ", $t);
  $t=substr($t, 0, 1)==" " ? substr_replace($t, "", 0, 1):$t;
  $t=substr($t, -1)==" " ? substr_replace($t, "", -1, 1):$t;
  if($check->rowCount()==0){
   $sql=$dbh->prepare("INSERT INTO `search` (`title`, `url`, `description`) VALUES (?, ?, ?)");
   $sql->execute(array(
    $t,
    $u,
    $d
   ));
  }else{
   $sql=$dbh->prepare("UPDATE `search` SET `description` = ?, `title` = ? WHERE `url`=?");
   $sql->execute(array(
    $d,
    $t,
    $u
   ));
  }
 }
}
class WSCrawler extends PHPCrawler { 
 function handleDocumentInfo(PHPCrawlerDocumentInfo $p){ 
  $u=$p->url;
  $c=$p->http_status_code;
  $s=$p->source;
  if($c==200 && $s!=""){
   $html = str_get_html($s);
   if(is_object($html)){
    $d="";
    $do=$html->find("meta[name=description]", 0);
    if($do){
     $d=$do->content;
    }
    $t=$html->find("title", 0);
    if($t){
     $t=$t->innertext;
     addURL($t, $u, $d);
    }
    $html->clear(); 
    unset($html);
   }
  }
 }
}
function crawl($u){
 $C = new WSCrawler();
 $C->setURL($u);
 $C->addContentTypeReceiveRule("#text/html#");
 $C->addURLFilterRule("#(jpg|gif|png|pdf|jpeg|svg|css|js)$# i");
 $C->setPageLimit(100, true);
 $C->obeyRobotsTxt(true);
 $C->setUserAgentString("DingoBot (http://search.subinsb.com/about/bot.php)");
 $C->setFollowMode(0);
 $C->go();
}
crawl("http://www.google.com");
?>
