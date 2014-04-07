<?
ini_set("display_errors", "on");
include("PHPCrawl/libs/PHPCrawler.class.php");
include("simple_html_dom.php");

$GLOBALS['maxtime']=strtotime("+10 seconds");
$GLOBALS['crawled']=array();
class WSCrawler extends PHPCrawler { 
 function handleDocumentInfo(PHPCrawlerDocumentInfo $p) { 
  $u=$p->url;
  $s=$p->http_status_code;
  if($s==200 && $p->source!=""){
   $html = str_get_html($p->source);
   $t=$html->find("title", 0) ? $html->find("title", 0)->innertext:"";
   foreach($p->links_found as $v){
    crawlInit($v['link_raw']);
   }
  }
 }
}
function crawlInit($u){
 $uen=urlencode($u);
 if(array_search($uen, $GLOBALS['crawled'])===false && $GLOBALS['maxtime'] > time()){
  $GLOBALS['crawled'][]=$uen;
  echo $u."<br/>\n";
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
 $C->setFollowMode(0);
 $C->go();
}
crawlInit("http://www.google.com");
?>
