<?php
	session_start();

	$name=$password="";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		function filter($post_name) {return htmlspecialchars(filter_input(INPUT_POST, $post_name), ENT_QUOTES, 'UTF-8');}
		
		$name=filter('name');
		$password=filter('password');
		require_once 'database.php';
		try
		{
			$adminQuery = $db->prepare('SELECT id, name, password FROM admins WHERE name = :name');
			$adminQuery->bindValue(':name', $name, PDO::PARAM_STR);
			$adminQuery->execute();
			
			$admin = $adminQuery->fetch();
			
			if($admin && password_verify($password, $admin['password']))
			{
				echo "aaaa";
				$_SESSION['logged_in'] = true;
				$_SESSION['admin_id'] = $admin['id'];
				$_SESSION['admin_name'] = $admin['name'];
				
				header('Location: admin_panel.php');
			}
		} 
		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
	}
?>
<!doctype html>
<html lang="pl">
	<head>
        <meta charset="utf-8" />
        
		<meta name="apple-mobile-web-app-title" content="Legion">
		<meta name="application-name" content="Legion">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Legion | Panel administracyjny</title>
		<meta name="description" content="Panel administracyjny strony legion.info.pl">
		<meta name="keywords" content="">

        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link rel="stylesheet" href="css/footer.css" type="text/css">
        <link rel="stylesheet" href="css/admin.css" type="text/css">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#1c1c1c">
		<meta name="apple-mobile-web-app-title" content="Legion">
		<meta name="application-name" content="Legion">
		<meta name="msapplication-TileColor" content="#baab00">
		<meta name="msapplication-TileImage" content="/mstile-144x144.png">
		<meta name="theme-color" content="#131313">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="manifest.json">
	</head>
	<body>
		<main>
			<div id="admwarn"><p>UWAGA: Dostęp do panelu administracyjnego zarezerwowany jest dla osób upoważnionych. Nieautoryzowany dostęp jest przestępstwem i&nbsp;podlega karze z&nbsp;tytułu art.&nbsp;267&nbsp;§&nbsp;1&nbsp;i&nbsp;2&nbsp;kodeksu karnego.</p></div>
			<form method="post" action="admin_login.php" id="admform">
				<input name="name" type="text" placeholder="login"  value="<?=$name?>"><br>
				<input name="password" type="password" placeholder="hasło" value="<?=$password?>"><br>
				<input type="submit" value="Zaloguj się!"/>
			</form>
		</main>
		<footer>
			<h3>Klub sztuk walk LEGION</h3>
			<p>Design by <a href='https://otsu.pl'>Otsu.pl</a></p>
		</footer>
        <script>
		</script>
	</body>
</html>
