<?
class SpellCheck{
 private $url="http://translate.google.com/translate_a/t";
 function __construct(){
  return true;
 }
 private function makeURL($s){
  $url=$this->url."?client=t&sl=en&tl=en&hl=en&sc=2&ie=UTF-8&oe=UTF-8&oc=1&otf=2&ssel=3&tsel=0";
  $url.="&q=$s";
  return $url;
 }
 public function check($s){
  $c=file_get_contents($this->makeURL($s));
  preg_match('/e","(.*?)",/', $c, $m);
  $a=isset($m[1]) ? $m[1]:"";
  $a=str_replace('",', '', $a);
  return $a;
 }
}
?>
