<?php
define('VIEWPATH', 'template');


session_start();//session start
$_SESSION["vercode"]="utsw"; //initiate a session

//header('Content-Type: image/jpeg');

$img_width=100;
$img_height=26;
$authnum='';

$ychar="1,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,P,Q,R,S,T,U,V,W,X,Y";
$list=explode(",",$ychar); //To store ychar in a list

//randomly pick 4 chars from list and store into authnum
for ($i=0;$i<4;$i++){
    $randnum=rand(0,count($list)-1);
    $authnum.=$list[$randnum];
}

$_SESSION["vercode"]=$authnum;//put 4 random chars in the session

$aimg=imagecreate($img_width,$img_height);//create the image with size
imagecolorallocate($aimg,248,249,250); //allocate a color for an image to white
$textcolor=imagecolorallocate($aimg,0,0,0); //allocate a color for text to black
$bordercolor=imagecolorallocate($aimg,250,250,250); //allocate a color for border of frame


for ($i=1; $i<=81; $i++) {
    //draws "@i" at the given coordinates (range from 1 to its image width and height) in the image and set random color for each "@!"
    imagestring($aimg,1,mt_rand(1,$img_width),mt_rand(1,$img_height),"&@",imagecolorallocate($aimg,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255)));
}

for($i=0;$i<strlen($authnum);$i++){
    //draws the 4 chars at the given coordinates
    imagestring($aimg,5,$i*$img_width/4+mt_rand(2,7),mt_rand(1,$img_height/2-2), $authnum[$i],imagecolorallocate($aimg,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200)));
}

imagerectangle($aimg,0,0,$img_width-1,$img_height-1,$bordercolor);//put the image in a rectangle frame
header("Content-type: image/PNG");//send the content type header so the image is displayed properly
imagepng($aimg);//output the image to the browser
imagedestroy($aimg);//destroy the image to free up the memory

?>