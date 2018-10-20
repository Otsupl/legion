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
					<div id="img_navigation">
						<div class="arrow left"></div>
						<div id="close-circle">
							<div class="close-img close icon"></div>
						</div>
						<div class="arrow right"></div>
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
			
			function isJpg($file)
			{
				if(substr($file, -3) == 'jpg') return true;
				return false;
			}
			$position = $fake_img = $all_fake_img = $poprzedni = 0;
			for($i=0; $i < 2; $i++) 
			{
				echo '<div class="divider">';
				for($j=1; $j <= 2; $j++) 
				{
					echo '<ul>';
					$img_id = 0;
					$zostalo = 4-$i*2-$j;
					while($position-$fake_img-$poprzedni <
					($zostalo > 0 ?
					ceil(($indexCount-$fake_img-$poprzedni-floor(($indexCount-$fake_img)/4))/(4-$i*2-$j)) :
					ceil(($indexCount-$fake_img)/4)
					)
					&& $position < $indexCount)
					{
						if(isJpg($dirArray[$position]))
						{
							echo '<li><img src="img/inner-photos/min-compressed/'.$dirArray[$position].'" id="'.($img_id+$i*2+$j).'" alt="Zdjęcie klubu" img_name="'.$dirArray[$position].'"/></li>';
							$img_id+=4;
						}
						else
							$fake_img++;
						$position++;
					}
					echo '</ul>';
					$poprzedni = $position-$fake_img;
				}
				echo '</div>';
			}
			echo '<div id="max_img_id" max_img_id='.($indexCount-$fake_img).'></div>'
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
			var full_image = document.getElementById('full_image');
			for(i=0; i<imgs.length; i++) 
			{
				imgs[i].addEventListener('click',(event)=>
				{
					otworz(full_view, event.target || event.srcElement);
				});
			}
			function change_img(arrow) 
			{
				var direction = (arrow.classList.contains('left') ? -1 : 1);
				var current_id = document.getElementsByClassName('full-img')[0].getAttribute('img_id')
				var id = +(document.getElementsByClassName('full-img')[0].getAttribute('img_id')) + direction;
				otworz(full_view, document.getElementById(id));
			}
			document.getElementsByClassName("arrow")[0].addEventListener("click", function(e){change_img(e.target || e.srcElement)});
			document.getElementsByClassName("arrow")[1].addEventListener("click", function(e){change_img(e.target || e.srcElement)});
			document.getElementById("close-circle").addEventListener("click", function() 
			{
				zamknij(full_view);
			});
			przyciemniacz.addEventListener("click", function() 
			{
				zamknij(full_view);
			});
			function otworz(co, e)
			{
				przyciemniacz.classList.add('aktywny');
				przyciemniacz.style.visibility='visible';
				var full_img = document.createElement('img');
				full_img.src = "img/inner-photos/compressed/"+e.getAttribute('img_name');
				full_img.setAttribute('img_id', e.getAttribute('id'));
				full_img.classList.add('full-img');
				
				document.querySelector(".arrow.left").style.visibility = "visible";
				document.querySelector(".arrow.right").style.visibility = "visible";
				if(full_img.getAttribute("img_id") == 1)
					document.querySelector(".arrow.left").style.visibility = "hidden";
				else if(full_img.getAttribute("img_id")  == document.getElementById("max_img_id").getAttribute('max_img_id'))
					document.querySelector(".arrow.right").style.visibility = "hidden";
				
				full_img.onload = function()
				{
					full_image.innerHTML = '';
					full_image.appendChild(full_img);

					co.style.visibility = "visible";
					co.style.maxWidth = co.scrollWidth + "px";
					co.style.maxHeight = co.scrollHeight + "px";
					setTimeout(()=>{co.classList.add('active')}, 900);
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