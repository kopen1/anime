<?php
/*
$i = 1;
while(true){
$g = get("https://resep.place.eu.org/?wp_automatic=cron&id=2237");
$x = ex('" href="https://resep.place.eu.org/',"/a>",1,$g);
$x = ex('/">',"<",1,$x);
$gg = get("https://tribun.place.eu.org/?wp_automatic=cron&id=223");
$xx = ex('" href="https://tribun.place.eu.org/',"/a>",1,$gg);
$xx = ex('/">',"<",1,$xx);
if(file_put_contents("x",$x)){
$xx = file_get_contents("x");
echo "[$i] $x \n";
}else{
echo "[$i] \n";
}
$i++;
//if(!$x){ exit; }
}
exit;
*/


$host = "https://185.231.223.76/";
//anime
$ii = 1;
while(true){
$host = "https://185.231.223.76/anime/page/$ii/";
$x = get($host);
$x = ex('<ul class="anime-list">','</ul>',1,$x);
for($i=1;$i < 11;$i++){
$u = ex('<li> <a href="','"',$i,$x);
$ses = get($u);
$desc = ex('itemprop="description"><p>',"</p>",1,$ses);
$kat = ex('class="entry-title" itemprop="name">',"</",1,$ses);
$kat = "<a href='$u' >$kat</a>";

$img = ex('<meta property="og:image" content="','"',1,$ses);
$img = '<meta property="og:image" content="'.$img.'" />';

$li = ex('var episodelist = [',"];",1,$ses);
$js = json_decode("[ $li ]",1);
foreach($js as $links){
  $jdl = $links["ep-title"];
  $link = $links["ep-link"];
  $date = $links["ep-date"];
  $no = $links["ep-num"];
$get = get($link);
$time = ex('property="article:',"/>",1,$get);
$time = '<meta property="article:'.$time."/>";
$vhash = ex('vhash  = "', '"', 1,$get);
$token = ex('token  = "', '"', 1,$get);
$fhash = ex('fhash  = "', '"', 1,$get);
$kadal = ex('kadal  = "', '"', 1,$get);
$permalink = ex("permalink_karang = '","'",1,$get);
$vid1 = '<iframe class="lockiframe" style="position: absolute;" src="https://gugcloud.club/vapi.php?id='.$fhash.'" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH="100%" HEIGHT="50%" allowfullscreen="true"></iframe>';
$vid = "<embed width='100%' HEIGHT='50%' src=\"https://content-gomuvideo.onicdn.xyz/videoplayback/watch/$token/$kadal/0/$vhash/original/video.mp4\" type=\"video/mp4\" />";
  
 echo "$no | $jdl "; 
  $save = "
  $img
  <h2> $jdl </h2>
  $date $time
  $kat <br>
  <p> <br> $vid <br> </p> <br>
  <span> <a href='https://navigablepiercing.com/r4wasaeay?key=0b12b0aa39d39dc615fd0f3664d5260a' target='_blank' > Download Film </a> </span> <br>
  <p> $desc </p>
  \n";
  save($permalink,$save);
}
  
}
$ii++;}
exit;




function save($x,$ss){
$n = "$x.html";
if(!file_exists($n)){
  
if(file_put_contents($n,$ss)){
  echo " sukses Save \n";
}else{
  echo " Failed \n";}

}else{
  echo " Sudah Ada \n";}
}


function artikel($host){
$js = get($host);
$des = ex('itemprop="description">',"</p>",1,$js)."</p>";
$img = "<img ".ex("<noscript><img","</",1,$js);
$kat = ex('" data-title="','"',1,$js);
$js = ex("var episodelist = ","];",1,$js)."]";
$js = json_decode($js,1);
foreach($js as $x){
$no = $x["ep-num"];
$jdl = $x["ep-title"];
$url = $x["ep-link"];
$ll = explode("/",$url)[3];
//if(file_exists("anime/2/$ll.html")){ echo " Sudah Ada \n"; continue;}
$c = get($url);
$fhash = ex('var fhash  = "','"',1,$c);
$frame = '<iframe class="lockiframe" style="position: relative;" src="https://gugcloud.club/vapi.php?id='.$fhash.'" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH="100%" HEIGHT="50%" allowfullscreen="true"></iframe>';
$ads = 'https://navigablepiercing.com/v0zcf66cu?key=fa8b1b24e7bcb8e0935581769d593d5c';
$ss = "
<div class='anim'>
<center> $img <br><br>
<h2> $jdl </h2>
$frame <br><br>
<p><span> $kat </span> </p><br>
<p>$des <br>
<a href='$ads' > Download Now </a> <br>
</p>
</center>
</div>
";
save($ss,$ll);
}}



function get($url){
 return file_get_contents($url);
}
function ex($a,$b,$i,$xx){
  $z = explode($a,$xx);
  $z = explode($b,$z[$i])[0];
  return $z;
}

