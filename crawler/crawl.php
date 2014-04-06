<?
ini_set("display_errors", "on");
include("PHPCrawl/libs/PHPCrawler.class.php");
$GLOBALS['maxtime']=strtotime("+1 second");
$GLOBALS['crawled']=array();
class WSCrawler extends PHPCrawler { 
 function handleDocumentInfo(PHPCrawlerDocumentInfo $p) { 
  $u=$p->url;
  if($GLOBALS['maxtime'] > time()){
   crawlAdd($u);
  }
 }
}

function crawlAdd($u){
 $uen=urlencode($u);
 if(array_search($uen, $GLOBALS['crawled'])===false){
  $GLOBALS['crawled'][]=$uen;
  echo $u."<br/>";
  $C = new WSCrawler();
  $C->setURL($u);
  $C->addContentTypeReceiveRule("#text/html#");
  $C->addURLFilterRule("#\.(jpg|jpeg|gif|png|svg|css|js)$# i");
  $C->setTrafficLimit(1000 * 1024);
  $C->setPageLimit(10, true);
  $C->obeyRobotsTxt(true);
  $C->setUserAgentString("Dingo Bot (http://search.subinsb.com/about/bot.php)");
  $C->setFollowMode(0);
  $C->go();
 }
}
crawlAdd("http://localhost/phpmyadmin/");
?>
