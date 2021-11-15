<?php
require_once('360safe/360webscan.php');
require 'assets/api.php';
$ip = $_SERVER["REMOTE_ADDR"];
$app = new Myitmx\xyw();

//改这个为学校的认证IP
$wlanacip = "0.0.0.0";
//下面别动
$wlanuserip = $_POST["userip"];
$username = $_POST["username"];
$password =  $_POST["password"];
$mac = $_POST["mac"];

//获取验证码
$verifycode = $app->getVerifyCode($username,$wlanuserip,$wlanacip,$mac);     

//登录账号
$result = $app->Login($username,$password,$wlanuserip,$wlanacip,$mac,$verifycode);

require 'header.php';
?>
<div class="container">
        <div class="mdui-row">
            <div class="mdui-col-md-3 mdui-col-sm-12 sticky">
                <div class="status">             
                      <div class="mdui-typo-title mdui-text-center"><strong>登录状态</strong></div>               
<div class="mdui-card-actions">
<div class="mdui-typo">
<?php		  
//登录验证反馈
     $array = json_decode($result,TRUE);
     $a=($array['rescode']);
     $b=($array['resinfo']);

     if($a==13016000){
          $status="输入的帐号不存在";
          $check="close";
          $color="red";
     }
     else if($a==0){
          $status="登录成功";
          $check="check";
          $color="blue";
     }
     else if($a==13003000){
          $status="登录超时";
          $check="close";
          $color="red";
     }
     else if($a==13001000){
          $status="此用户认证请求被拒绝";
          $check="close";
          $color="red";
     }
     else if($a==-1){
          $status="连接验证服务器失败";
          $check="close";
          $color="red";
     }
     else if($a==11064000){
          $status=$b;
          $check="close";
          $color="red";
     }
     else{
          $status=$b;
          $check="close";
          $color="red";

     }
?>  
<div class="mdui-chip mdui-center">
<span class="mdui-chip-icon mdui-color-<? echo $color; ?>">
<i class="mdui-icon material-icons"><? echo $check; ?></i></span>
<span class="mdui-chip-title"><? echo "用户:" .$wlanuserip ?> | <? echo $status; ?></span>
</div>
  </div>
    </div>
      </div>
        </div>                
             
             <div class="mdui-col-md-6 mdui-col-sm-8">
                <div class="list">
                    <div class="mdui-typo-title mdui-text-center"><strong>系统信息</strong></div>
                     <div class="container">
        <div class="mdui-typo">
<pre>
<?
$n=chr(13);
echo "<SCRIPT LANGUAGE=\"JavaScript\">".$n; 
echo "document.write('<div id=\"TimeShow\" style=\"MARGIN-right:0px;font-size:12pt\">?</div>');".$n; 
echo "var y=".date("Y")."; //年 ".$n; 
echo "var m=".date("n")."; //月 ".$n;
echo "var d=".date("j")."; //日 ".$n;
echo "var w=".date("w")."; //星 ".$n;
echo "var h=".date("H")."; //时 ".$n;
echo "var i=".date("i")."; //分 ".$n;
echo "var s=".date("s")."; //秒 ".$n;
echo "var hstr=istr=sstr=a='';".$n;
echo "var ww = Array('日','一','二','三','四','五','六');".$n; 
echo "function clock(){".$n; 
echo " s++;".$n;
echo " if (s==60) {i+=1;s=0;}//秒进位".$n; 
echo " if (i==60) {h+=1;i=0;}//分进位".$n; 
echo " if (h==24) {w+=1;d+=1;h=0;}//时进位".$n; 
echo " if (w==7) {w=0;}//星期进位".$n; 
echo " if (m==2) { //是否是二月份？".$n; 
echo " if (!y%4>0) { //不是闰月（二月有28天）".$n; 
echo " if (d==30){".$n; 
echo " m+=1;".$n; 
echo " d=1;}".$n; 
echo " }".$n; 
echo " else { //是闰月（二月有29天）".$n; 
echo " if (d==29){".$n; 
echo " m+=1;".$n; 
echo " d=1;}".$n; 
echo " }".$n; 
echo " }".$n; 
echo " else { //非2月份的月份".$n; 
echo " if (m==4 || m==6 || m==9 || m==11) { //只有30天的月份".$n; 
echo " if (d==31) {".$n; 
echo " m+=1;".$n; 
echo " d=1;}".$n; 
echo " }".$n; 
echo " else { //有31天的月份".$n; 
echo " if (d==32){".$n; 
echo " m+=1;".$n; 
echo " d=1;}".$n; 
echo " }".$n; 
echo " }".$n; 
echo " if (m==13) {y+=1;m=1;}//月进位".$n; 
echo " if (h < 10) {hstr=' 0'+h} else {hstr=' '+h};".$n; 
echo " if (i < 10) {istr=':0'+i} else {istr=':'+i};".$n; 
echo " if (s < 10) {sstr=':0'+s} else {sstr=':'+s};".$n; 
echo " if (h < 13) {astr=' am';} else {astr=' pm';};".$n;
echo " TimeShow.innerHTML=y+'年'+m+'月'+d+'日 '+'<font color=#000000>星期'+ww[w]+'</font>'+hstr+istr+sstr;".$n;
echo " setTimeout('clock()',1000);".$n; 
echo "}".$n; 
echo "clock();".$n; 
echo "</SCRIPT>".$n; 
?>
</pre>

<pre>
<? echo "您的IP地址是:" .$ip;
?></pre>
</div>

<?php
date_default_timezone_set("Asia/Shanghai");
$b = date("s");
?>

<div class="mdui-progress">
  <div class="mdui-progress-determinate" style="width: <? echo $b; ?>%;"></div>
</div>
<br>     
   </div>
       </div>
           </div>
            <div class="mdui-col-md-3 mdui-col-sm-4 sticky">
                <div class="header">
                    <div class="mdui-card">
                        <div class="mdui-card-media">
                            <img src="./assets/img/background.png" />
                        </div>           
                        <div class="mdui-card-content">
                            <small>
                                               </small>
                            <p>Copyright © 2021 NiceSprite All Rights Reserved.</p>       
                             <p>UI: PluginsKers</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </body>
</html>




 