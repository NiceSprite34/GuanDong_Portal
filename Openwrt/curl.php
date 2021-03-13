<?php
//OpenWRT Curl Login
require 'api.php';
$app = new Myitmx\xyw();
$wlanacip = "183.56.00.00";
$wlanuserip = $_GET["userip"];
$username = $_GET["username"];
$password =  $_GET["password"];
$mac = "00-00-00-00-00-00";
//获取验证码
$verifycode = $app->getVerifyCode($username,$wlanuserip,$wlanacip,$mac);     
//登录账号
$result = $app->Login($username,$password,$wlanuserip,$wlanacip,$mac,$verifycode);

?>
<?php		  
//登录验证反馈
     $array = json_decode($result,TRUE);
     $a=($array['rescode']);
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
     else{
          $status="未知状态";
          $check="close";
          $color="red";

     }
?>  
<span class="mdui-chip-title"><? echo "用户:" .$wlanuserip ?> | <? echo $status; ?></span>
 
