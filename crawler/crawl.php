<?
ini_set("display_errors", "on");
ob_implicit_flush(1);
include("PHPCrawl/libs/PHPCrawler.class.php");
$GLOBALS['maxtime']=strtotime("+1 second");
$GLOBALS['crawled']=array();
class WSCrawler extends PHPCrawler { 
 function handleDocumentInfo(PHPCrawlerDocumentInfo $p) { 
  $u=$p->url;
  crawlInit($u);
 }
}
function crawlInit($u){
 $uen=urlencode($u);
 if(array_search($uen, $GLOBALS['crawled'])===false && $GLOBALS['maxtime'] > time()){
  $GLOBALS['crawled'][]=$uen;
  echo $u."<br/>\n";
  flush();
  crawlNow($u);
 }
}
function crawlNow($u){
 $C = new WSCrawler();
 $C->setURL($u);
 $C->addContentTypeReceiveRule("#text/html#");
 $C->addURLFilterRule("#(jpg|gif|png|pdf|jpeg|svg|css|js)$# i");
 $C->setPageLimit(10, true);
 $C->obeyRobotsTxt(true);
 $C->setUserAgentString("Dingo Bot (http://search.subinsb.com/about/bot.php)");
 $C->setFollowMode(2);
 $C->go();
}
crawlInit("http://www.google.com");
?>
