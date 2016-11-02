
<?php 
        
			$url = "";
			$jsessionid = "";
			switch ($_POST['action']){
				
				case "nop" :
					$url = "https://my.zipato.com:443/zipato-web/v2/user/nop";
					webserviceAction($url,$jsessionid);
				break;
				case "login" :
					$url = "https://my.zipato.com:443/zipato-web/v2/user/init";
					$result = webserviceAction($url,$jsessionid);					
					if($result['success'] == true){
						$token = sha1($result["nonce"]."e7b64e474e3fe41adee21fe9de8a1c2098873c83");
						$jsessionid = "Cookie:".$result["jsessionid"];
						$url = "https://my.zipato.com/zipato-web/v2/user/login?token=".$token."&username=pedja0106@gmail.com";
						webserviceloginAction($url,$jsessionid);
						
					}
			}
			
			
			
		function webserviceAction($url,$jsessionid){
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch, CURLOPT_HEADER, false); 
			curl_setopt($ch, CURLOPT_URL,$url ); 
			curl_setopt($ch, CURLOPT_HTTPGET, true); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			
			$output = curl_exec($ch); 		
			echo $output;
			return json_decode($output, true);
		};
                
                function webserviceloginAction($url,$jsessionid){
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch, CURLOPT_HEADER, false); 
			curl_setopt($ch, CURLOPT_URL,$url ); 
			curl_setopt($ch, CURLOPT_HTTPGET, true); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
				'Accept-Encoding:gzip, deflate, sdch, br',
				'Accept-Language:en-US,en;q=0.8,de;q=0.6,hr;q=0.4,sr;q=0.2',
				'Host: my.zipato.com',
				'Connection: keep-alive',
				'Pragma: no-cache',
				'Cache-Control: no-cache',
				'Upgrade-Insecure-Requests: 1',
				'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36',                                
				'Referer: https://my.zipato.com/zipato-web/app2login',
				$jsessionid
			));
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			$verbose = fopen('php://temp', 'w+');
			curl_setopt($ch, CURLOPT_STDERR, $verbose);
			
			$output = curl_exec($ch); 

			
			if ($output === FALSE) {
				printf("cUrl error (#%d): %s<br>\n", curl_errno($ch),
					   htmlspecialchars(curl_error($ch)));
			}
			
			rewind($verbose);
			$verboseLog = stream_get_contents($verbose);

			echo "Verbose information:\n<pre>", htmlspecialchars($verboseLog), "</pre>\n";
			
			echo $output;
			//return json_decode($output, true);
		};
		
		
?>

