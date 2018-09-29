<!doctype html>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		<link rel="canonical" href="https://legion.pl">
		
		<link href="https://fonts.googleapis.com/css?family=Cinzel:700|Montserrat&amp;subset=latin-ext" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		<meta name="apple-mobile-web-app-title" content="Legion">
		<meta name="application-name" content="Legion">
		
		<link rel="manifest" href="manifest.json">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Legion</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		
		<noscript><style> .jsonly { display: none } </style></noscript>
		<script>document.documentElement.className += ' js';</script>	 
		
	</head>
	<body>
		<!-- Nawigacja -->
		<nav id="navbar">
            <div id="nav" class="nav-transparent">
				<a href='/' id="logo">LEGION</a>
				<div id="outerburger">
					<div id="burger" class="menu icon"></div>
				</div>
				<ul id="menu">
					<li><a href="index.html">Główna</a></li>
					<li><a href="about.html">O&nbsp;nas</a></li>
					<li><a href="training.html">Co&nbsp;trenujemy?</a></li>
					<li><a href="schedule.html">Grafik</a></li>
					<li><a href="gym.html">Siłownia</a></li>
					<li class="current"><a href="galery.html">Galeria</a></li>
					<li><a href="index.html#cennik">Cennik</a></li>
					<li><a href="index.html#kontakt">Kontakt</a></li>
				</ul>
            </div>
		</nav>
		<div id='scrollup' class='hidden' onclick="scrollup()"><i class="fas fa-arrow-up"></i></div>
		<main>
			<div id="przyciemniacz"></div>
			<div id="full_view">
				<div class="outer-full-image">
					<div id="full_image"></div>
					<div class="circle">
						<div class="close-desc close icon"></div>
					</div>
				</div>
			</div>
		  <div id ="container">
			<?php
			$photos = opendir("img/inner-photos");
			// get each entry
			while($entryName = readdir($photos)) {
				$dirArray[] = $entryName;
			}
			// close directory
			closedir($photos);
			//	count elements in array
			$indexCount	= count($dirArray);
			?>

			<?php
			function isJpg($file)
			{
				if (substr($file, -3) == 'jpg')
					return true;
				return false;
			}
			// loop through the array of files and print them all in a list
			$reszta = $indexCount % 4;
			$position = 0;
			for($i=1; $i <= 4; $i++) {
				echo '<ul>';
				
				for(; $position < $i*floor($indexCount/4); $position++) {
					if(isJpg($dirArray[$position]))
						echo '<li><img src="img/inner-photos/' . $dirArray[$position] . '" alt="Image" /></li>';
				}
				if($reszta>0)
				{
					if(isJpg($dirArray[$position]))
					{
						echo '<li><img src="img/inner-photos/' . $dirArray[$position] . '" alt="Image" /></li>';
						$reszta--;
					}
					$position++;
				}
				echo '</ul>';
			}
			?>
		  </div>
		</main>
		<footer>
			<h3>Klub sztuk walk LEGION</h3>
			<h4>&copy;Wszelkie prawa zastrzeżone</h4>
			<div id="footer-contact">
				<div class="left">
				  <a href="tel:883591210"><i class="fas fa-mobile-alt"></i> 883-591-210</a>
				  <a href="https://goo.gl/maps/XWNfUHEhkxn"><i class="fas fa-map-marker-alt"></i> ul. Wersalska 47/75</a>
				  <a href="https://www.facebook.com/HanumanLegion/"><i class="fab fa-facebook-f"></i> fb.me/HanumanLegion</a>
				</div>
				<div class="right">
					moo
				</div>
			</div>
			<p>Design by <a href='https://otsu.pl'>Otsu.pl</a></p>
		</footer>
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link rel="stylesheet" href="css/nav.css" type="text/css">
        <link rel="stylesheet" href="css/galery.css" type="text/css">
        <link rel="stylesheet" href="css/scroll.css" type="text/css">
        <link rel="stylesheet" href="css/footer.css" type="text/css">
		<!-- Skrypty -->
		<script src="js/nav.js"></script>
		<script src="js/scroll.js"></script>
		<script src="js/smoothscroll.js"></script>
        <script>
			var imgs = document.getElementsByTagName('img');
			var przyciemniacz = document.getElementById('przyciemniacz');
			for(i=0; i<imgs.length; i++) 
			{
				imgs[i].addEventListener('click',(event)=>
				{
					var full_view = document.getElementById('full_view');
					var otwarty = document.getElementsByClassName('active')[0];
					if(otwarty)
					{
						if(otwarty != full_view){
							zamknij(document.getElementsByClassName('active')[0]);
							setTimeout(()=>{otworz(full_view, event)}, 1000);
						}
					}
					else if(!document.getElementsByClassName('working')[0])
					{
						otworz(full_view, event);
					}
				});
			}

			var close_circle = document.getElementsByClassName("circle");

			for (let i = 0; i < close_circle.length; i++) 
			{
				close_circle[i].addEventListener("click", function() 
				{
					let description = this.parentElement.parentElement;
					zamknij(description);
				});
			}
			var full_image = document.getElementById('full_image');
			function otworz(co, e)
			{
				if (!co.style.maxHeight)
				{
					przyciemniacz.classList.add('aktywny');
					przyciemniacz.style.visibility='visible';
					var full_img = document.createElement('img');
					full_img.src = e.target.getAttribute('src');
					full_img.classList.add('full-img');
					full_image.appendChild(full_img);

					co.classList.add('working');
					co.style.visibility = "visible";
					co.style.maxWidth = co.scrollWidth + "px";
					co.style.maxHeight = co.scrollHeight + "px";
					setTimeout(()=>{co.classList.add('active');co.classList.remove('working')}, 900);
				}
			}
			function zamknij(co)
			{
				if(co.style.maxHeight)
				{
					przyciemniacz.classList.remove('aktywny');
					co.classList.add('working');
					co.style.maxWidth = null;
					co.style.maxHeight = null;
					setTimeout(()=>
						{
							przyciemniacz.style.visibility='hidden';
							co.style.visibility = "hidden";
							co.classList.remove('active');
							co.classList.remove('working');
							if(document.getElementsByClassName("full-img")[0])
							{
								var inner_img = document.getElementsByClassName("full-img")[0];
								full_image.removeChild(inner_img);
							}
						}, 900);
				}
			}
		</script>
	</body>
</html>