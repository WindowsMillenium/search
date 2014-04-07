<?
ini_set("display_errors", "on");
include("PHPCrawl/libs/PHPCrawler.class.php");
include("simple_html_dom.php");

$GLOBALS['maxtime']=strtotime("+1 seconds");
$GLOBALS['crawled']=array();
class WSCrawler extends PHPCrawler { 
 function handleDocumentInfo(PHPCrawlerDocumentInfo $p) { 
  $u=$p->url;
  $c=$p->http_status_code;
  $s=$p->source;
  if($c==200 && $s!=""){
   $html = str_get_html($s);
   if(is_object($html) && $html->find("title", 0)){
    $t=$html->find("title", 0)->innertext;
    echo $u."<br/>";
   }
   $html->clear(); 
   unset($html);
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
