<?php
#Update by NiceSprite 2021-11-15
#Copyright © 2019 Myitmx. All rights reserved.
#广东天翼校园网第三方登录 重构版

namespace Myitmx;
class xyw
{
	public function post_json($url, $jsonStr)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json; charset=utf-8'
		)
		);
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return array($httpCode, $response);
	}
	
	public function getVerifyCode($username,$wlanuserip,$wlanacip,$mac)
	{
		$secret = "Eshore!@#";
		$time = time();
		$version = "214";
		    
		$authenticator = $version.$wlanuserip.$wlanacip.$mac.$time.$secret;
		$authenticator = strtoupper(md5($authenticator));
		$post_date = array('version' => $version, 'username' => $username, 'clientip' => $wlanuserip, 'nasip' => $wlanacip, 'mac' => $mac, 'timestamp' => $time, 'authenticator' => $authenticator, 'iswifi' => "4060");
		$post_date = json_encode($post_date);
		$VerifyCode = xyw::post_json("http://enet.10000.gd.cn:10001/client/vchallenge", $post_date);
		$VerifyCode = json_decode($VerifyCode['1'],true);
		if($VerifyCode['rescode'] == "0")
		{
			return $VerifyCode['challenge'];

		}
		else
		{
			return "获取验证码出错！！！";
		}
	}

public function Login($username,$password,$wlanuserip,$wlanacip,$mac,$verificationcode)
	{
		$secret = "Eshore!@#";
		$time = time();
		$authenticator = $wlanuserip.$wlanacip.$mac.$time.$verificationcode.$secret;
		$authenticator = strtoupper(md5($authenticator));
		$post_date = array('username' => $username, 'password' => $password, 'clientip' => $wlanuserip, 'nasip' => $wlanacip, 'mac' => $mac, 'timestamp' => $time, 'authenticator' => $authenticator, 'iswifi' => "1050", 'verificationcode'=>$verificationcode);
		$post_date = json_encode($post_date);
		$Login_return = xyw::post_json("http://61.140.12.23:10001/client/login", $post_date);
		return $Login_return['1'];	
			}


public function Keep($username,$wlanuserip,$wlanacip,$mac)
	{
		$secret = "Eshore!@#";
		$time = time();
		$kee = $wlanuserip.$wlanacip.$mac.$time.$secret;
		$keep = strtoupper(md5($kee));		
	    $post_da = array('username' => $username, 'clientip' => $wlanuserip, 'nasip' => $wlanacip, 'mac' => $mac, 'timestamp' => $time, 'authenticator' => $keep);
	    $get_keep = "username=$username&clientip=$wlanuserip&nasip=$wlanacip&mac=$mac&timestamp=$time&authenticator=$keep";			
		$urls="http://enet.10000.gd.cn:8001/hbservice/client/active?$get_keep";
        $keeps = file_get_contents($urls);   
        echo $keeps;	
        
        
        
        
        
			}


}
