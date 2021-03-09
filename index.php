<?php
//PHP : Myitmx
//UI Design : PluginsKers
require_once('360safe/360webscan.php');
$ip = $_SERVER["REMOTE_ADDR"];
//判断开关网时间
$op = date('Ymd'). "09:28";
$ed = date('Ymd'). "23:20";
$time = time();
if($time<strtotime($op) || $time>strtotime($ed))
{
$t = "1";
$input="disabled";
$b= "己到断网时间";
$c= "登录[断网时间]";
}else{
$t ="2";
$input="";
$c= "登录";
$b= "登录";
}
require_once('header.php');

?>
<div class="container">
        <div class="mdui-row">
            <div class="mdui-col-md-3 mdui-col-sm-12 sticky">
                <div class="status">             
                      <div class="mdui-typo-title mdui-text-center"><strong>登录</strong></div>                          
                   <form action="login.php" method="post"> 
                    <div class="mdui-textfield mdui-textfield-floating-label">
        
  <label class="mdui-textfield-label">用户名</label>
  <input class="mdui-textfield-input" <?php echo $input; ?> type="text" name="username" id="username" required/>
  <div class="mdui-textfield-error">用户名不能为空</div>
</div>

<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">密码</label>
  <input class="mdui-textfield-input" <?php echo $input; ?> type="password" pattern="^.*(?=.{6,}).*$" id="password" name="password" required/>
  <div class="mdui-textfield-error">密码至少 6 位</div>
 </div>
 
<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">登录设备IP</label>
  <input class="mdui-textfield-input" value="<?php echo $ip; ?>" <?php echo $input; ?> type="txt" id="userip" name="userip" required/>
 </div>

<div class="mdui-card-actions">
 <button class="mdui-btn mdui-ripple mdui-btn-block mdui-color-grey-600"<?php echo $input; ?>><?php echo $b; ?></button> <br>
 <kbd mdui-dialog="{target: '#user'}">用户协议</kbd>

  </div>
   
 
 
    </div>
         </div>          
    
       <div class="mdui-col-md-6 mdui-col-sm-8">
         <div class="list">
            <div class="mdui-typo-title mdui-text-center"><strong>系统信息</strong></div>
<div class="container">
<div class="mdui-typo"><pre>
<?php
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
    
<!-- 弹窗 -->   
<div class="mdui-dialog" id="user">
  <div class="mdui-dialog-title">用户协议
  </div>
  <div class="mdui-dialog-content">我们提供的服务是免费的！
我们未授权任何个人或组织出售本页面所提供的服务
本站仅作登录用途，不保存任何用户数据！
</br>Github项目地址:</br><div class="mdui-typo">
  <a href="https://github.com/NiceSprite34/GuanDong_Portal">github.com/NiceSprite34/GuanDong_Portal</a></div></div>
  <div class="mdui-dialog-actions">
      <div class="mc-login-btn mdui-btn mdui-btn-dense mdui-ripple mdui-ripple-white" mdui-dialog-confirm>关闭</div>
  </div>
</div>

    <script type="text/javascript" src="./assets/js/mdui.min.js"></script> <!-- MDUI JS --> 
    
  </body>
</html>