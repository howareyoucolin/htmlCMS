<?php 

	session_start();

	if(isset($_SESSION['loggedin'])){
		
		header('Location:../editor/');
		exit(1);
	}


	//Login Action:
	
	if(isset($_POST['save'])){
		
		//Agent advance login:
		
		$data['username'] = trim($_POST['usr']);
		$data['password'] = md5(trim($_POST['psw']));
		
		//Check admin identity:
		$is_admin = false;
		$t = file_get_contents('../data/agent.cz');
		$arr = array_map('trim', explode(',', $t));
		if (in_array($data['username'], $arr)) {
			$is_admin = true;
		}
		
		if($is_admin){
		
			//Set POST variable
			$url = 'http://www.codezimple.com/custom/templates/agent_login_api.php';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$feedback = curl_exec($ch);
			curl_close($ch);
			
			if(trim($feedback) === 'true'){
				$_SESSION['loggedin'] = '5';//Higher Level Accessibility;
				header('Location:../editor/');
				exit(1);
			}
		
		}
		
		//Regular admin login:
		
		$content = file_get_contents('../data/psw.php');
		
		if(preg_match('/^\/\/\s*\[(\w+)\]\s*$/m',$content,$match)){
			
			$key = $match[1];
			
		}
		
		$usr = trim($_POST['usr']);
		$psw = md5($key.trim($_POST['psw']));
		
		if(preg_match('/^\/\/\s*'.$usr.'\s*=(.*)$/m',$content,$match)){
			
			$psw2 = trim($match[1]);
			
		}
		
		if($psw == $psw2){
			
			$_SESSION['loggedin'] = '1';
			header('Location:../editor/');
			exit(1);
			
		}else{
			
			echo '<div style="color:#D00;margin:50px;">Incorrect username or password!</div>';
			
		}
		
	}

?>

<form method="POST" action="#" style="margin:50px;">

	<h2>CZ Editor Login</h2>
	
	<br><br>

	Username : <input type="text" name="usr" value="<?php if(isset($_POST['usr'])) echo $_POST['usr'];?>" /><br><br>

	Password : <input type="password" name="psw" /><br><br>
	
	<input type="submit" name="save" value="Login" />
	
</form>