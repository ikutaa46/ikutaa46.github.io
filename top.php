<?php
///////////////////////////////////////////////////////////////////////////
//  Product: Daddy's Link Protector					
//  Version: 1.X						     
//								
// by DaddyScripts.com						
//								        
///////////////////////////////////////////////////////////////////////////
include('config.php');
include('header.php');

if($topten==false){
?>
<center>
<h1><center><? echo $lang[topten];?></h1><?
echo "$lang[fdis10]";?>
<tr><td colspan=5 height=1></td></tr><?
echo "$lang[disabled10]";
?></table></p></center></td></tr></table><p style="margin:3px;text-align:center"><?
include("./footer.php");
die();
}
?>
<center>
<h1><center><? echo $lang[topten];?></h1>
<p><table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="#C0C0C0">
<tr>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Nr</b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Name</b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Views</b></td>
<td align=center bgcolor=#EBEBEB background="img/bg.png"><b>Date Added</b></td>
</tr>
<?php
$me=$shorturl;
if ($me==true)
  $short= "";
else
  $short= "index.php?ID=";
if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}
include("./config.php");
if($topten == false){
echo "$lang[fdis10]";
die();
}
$order = array();
$dirname = "./config";
$dh = opendir( $dirname ) or die("couldn't open directory");
while ( $file = readdir( $dh ) ) {
if ($file != '.' && $file != '..' && $file != '.htaccess') {
	$fh = fopen ("./config/".$file, r);
	$list= explode('|', fgets($fh));
	$filecrc = str_replace(".dlp","",$file);
	    $order[] = $list[4].','.$filecrc.','.$list[1].",".$list[4];
	fclose ($fh);
}
}

	sort($order, SORT_NUMERIC);
	$order = array_reverse($order);

$i = 1;

foreach($order as $line){
  $line = explode(',', $line);

  	echo "<tr><td bgcolor=#F7F7F7 align=center>".$i."</td><td bgcolor=#F7F7F7 align=left><a href=\"". $short .$filedata[0] . $line[1] ."\" target=\"_blank\">".$line[1]."</a></td><td bgcolor=#F7F7F7 align=center>".$line[3]."</td>";

echo "<td bgcolor=#F7F7F7 align=center>".date('Y-m-d G:i', $list[0])."</td></tr>";
if($i == 10) break;
$i++;

}
?>

</table></p></center></td></tr></table><p style="margin:3px;text-align:center"><?
include("./footer.php");
?>