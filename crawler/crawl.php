<?
ini_set("display_errors", "on");
include("PHPCrawl/libs/PHPCrawler.class.php");
include("simple_html_dom.php");

$GLOBALS['maxtime']=strtotime("+1 seconds");
$GLOBALS['crawled']=array();
class WSCrawler extends PHPCrawler { 
 function handleDocumentInfo(PHPCrawlerDocumentInfo $p) { 
  $u=$p->url;
  $s=$p->http_status_code;
  echo $p->source;
  if($s==200 && $p->source!=""){
   $html = str_get_html($p->source);
   if($html->find("title", 0)){
    $t=$html->find("title", 0)->innertext;
    echo $u."<br/>";
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
 $C->setUserAgentString("Dingo Bot (http://search.subinsb.com/about/bot.php)");
 $C->setFollowMode(0);
 $C->go();
}
crawl("http://www.google.com");
?>
