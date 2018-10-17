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
            <div id="nav">
				<a href='/' id="logo">LEGION</a>
				<div id="outerburger">
					<div id="burger" class="menu icon"></div>
				</div>
				<ul id="menu">
					<li><a href="index.html">Główna</a></li>
					<li><a href="about.html">O&nbsp;nas</a></li>
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
					<div id="close-circle">
						<div class="close-img close icon"></div>
					</div>
				</div>
			</div>
		  <div id ="container">
			<?php
			$photos = opendir("img/inner-photos/min-compressed");
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
			$position = 0;
			for($i=0; $i < 2; $i++) 
			{
				echo '<div class="devider">';
				for($j=1; $j <= 2; $j++) 
				{
					echo '<ul>';
					$img_id = 0;
					while($position <= ceil(($indexCount/4)*($i*2 + $j)) && $position < $indexCount)
					{
						do
						{
							if(isJpg($dirArray[$position]))
							{
								echo '<li><img src="img/inner-photos/min-compressed/'.$dirArray[$position].'" id="'.($img_id+($i*2)+$j).'" alt="Zdjęcie klubu" img_name="'.$dirArray[$position].'"/></li>';
								$img_id+=4;
							}
							$position++;
						}while(isset($dirArray[$position]) && !isJpg($dirArray[$position]) && $position <= ceil( ($indexCount/4)*($i*2 + $j) ) && $position < $indexCount);
					}
					echo '</ul>';
				}
				echo '</div>';
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
			var full_view = document.getElementById('full_view');
			for(i=0; i<imgs.length; i++) 
			{
				imgs[i].addEventListener('click',(event)=>
				{
					otworz(full_view, event);
				});
			}
			document.getElementById("close-circle").addEventListener("click", function() 
			{
				zamknij(full_view);
			});
			przyciemniacz.addEventListener("click", function() 
			{
				zamknij(full_view);
			});
			var full_image = document.getElementById('full_image');
			function otworz(co, e)
			{
				if (!co.style.maxHeight)
				{
					przyciemniacz.classList.add('aktywny');
					przyciemniacz.style.visibility='visible';
					var full_img = document.createElement('img');
					full_img.src = "img/inner-photos/compressed/"+e.target.getAttribute('img_name');
					full_img.classList.add('full-img');
					full_img.onload = function()
					{
						full_image.appendChild(full_img);

						co.style.visibility = "visible";
						co.style.maxWidth = co.scrollWidth + "px";
						co.style.maxHeight = co.scrollHeight + "px";
						setTimeout(()=>{co.classList.add('active')}, 900);
					}
				}
			}
			function zamknij(co)
			{
				if(co.style.maxHeight)
				{
					przyciemniacz.classList.remove('aktywny');
					co.style.maxWidth = null;
					co.style.maxHeight = null;
					setTimeout(()=>
						{
							przyciemniacz.style.visibility='hidden';
							co.style.visibility = "hidden";
							co.classList.remove('active');
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