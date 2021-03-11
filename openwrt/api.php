<?php
#Created by Myitmx on 2019/10/16.
#Copyright © 2019年 Myitmx. All rights reserved.
#广东天翼校园网第三方登录 PHP版

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
		$authenticator = $wlanuserip.$wlanacip.$mac.$time.$secret;
		$authenticator = strtoupper(md5($authenticator));
		$post_date = array('username' => $username, 'clientip' => $wlanuserip, 'nasip' => $wlanacip, 'mac' => $mac, 'timestamp' => $time, 'authenticator' => $authenticator, 'iswifi' => "4060");
		$post_date = json_encode($post_date);
		$VerifyCode = xyw::post_json("http://125.88.59.131:10001/client/challenge", $post_date);
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
		$post_date = array('username' => $username, 'password' => $password, 'clientip' => $wlanuserip, 'nasip' => $wlanacip, 'mac' => $mac, 'timestamp' => $time, 'authenticator' => $authenticator, 'iswifi' => "4060", 'verificationcode'=>$verificationcode);
		$post_date = json_encode($post_date);
		$Login_return = xyw::post_json("http://125.88.59.131:10001/client/login", $post_date);
		return $Login_return['1'];
	}

	public function Logout($username,$wlanuserip,$wlanacip,$mac)
	{
		$secret = "Eshore!@#";
		$time = time();
		$authenticator = $wlanuserip.$wlanacip.$mac.$time.$secret;
		$authenticator = strtoupper(md5($authenticator));
		$post_date = array('username' => $username, 'clientip' => $wlanuserip, 'nasip' => $wlanacip, 'mac' => $mac, 'timestamp' => $time, 'authenticator' => $authenticator);
		$post_date = json_encode($post_date);
		$Logout_return = xyw::post_json("http://125.88.59.131:10001/client/logout", $post_date);
		return $Logout_return['1'];
	}
}