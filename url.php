<?
$url=isset($_GET['u']) ? urldecode($_GET['u']):"";
if(filter_var($url, FILTER_VALIDATE_URL) === FALSE || $url==""){
 header("Location: http://".$_SERVER['HTTP_HOST'], 302);
 exit;
}else{
 header("Location: ".$url);
 exit;
}
?>
