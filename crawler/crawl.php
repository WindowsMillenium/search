<?
ini_set("display_errors", "on");
include("PHPCrawl/libs/PHPCrawler.class.php");
$GLOBALS['maxtime']=strtotime("+10 second");
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
  $C = new WSCrawler();
  $C->setURL($u);
  $C->addContentTypeReceiveRule("#text/html#");
  $C->addURLFilterRule("#(jpg|gif|png|pdf|jpeg|svg|css|js)$# i");
  $C->setPageLimit(100, true);
  $C->obeyRobotsTxt(true);
  $C->setUserAgentString("Dingo Bot (http://search.subinsb.com/about/bot.php)");
  $C->setFollowMode(0);
  $C->force_output_flushing = true;
  echo $u."<br/>";
  flush();
  $C->go();
 }
}
crawlAdd("http://www.google.com");
?>
