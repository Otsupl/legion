document.getElementById('outerburger').addEventListener('click',()=>
{
    document.getElementById("menu").classList.toggle('nav-open');
	document.getElementById('burger').classList.toggle('menu');
	document.getElementById('burger').classList.toggle('close');
});