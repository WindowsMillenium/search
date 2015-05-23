<?php
class SpellCheck{
 private $url="http://translate.google.com/translate_a/t";
 function __construct(){
  return true;
 }
 private function makeURL($s){
  $s=urlencode($s);
  $url=$this->url."?client=t&sl=en&tl=en&hl=en&sc=2&ie=UTF-8&oe=UTF-8&uptl=en&oc=1&otf=1&ssel=3&tsel=0";
  $url.="&q=$s";
  return $url;
 }
 public function check($s){
  $a="";
  $c=file_get_contents($this->makeURL($s));
  $c=substr_replace($c, "", 0, 41);
  preg_match('/u003e","(.*?)",\[1]/', $c, $m);
  if(isset($m[1])){
   $a=$m[1];
   $a=str_replace('",', '', $a);
  }
  return $a;
 }
}
?>
