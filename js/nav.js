document.getElementById('outerburger').addEventListener('click',function()
{
    document.getElementById("menu").classList.toggle('nav-open');
	document.getElementById('burger').classList.toggle('menu');
	document.getElementById('burger').classList.toggle('close');
});
function nav()
{
	if(document.getElementById('nav').classList.contains('nav-transparent'))
	{
		if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30)
			document.getElementById('nav').classList.add('nav-active');
		else
			document.getElementById('nav').classList.remove('nav-active');
	}
}
window.addEventListener('load',function()
{
	if(!document.getElementById('nav').classList.contains('nav-transparent'))
	{
		document.getElementById('nav').classList.add('nav-active');
	}
	nav();
});
window.addEventListener('scroll',function()
{
	nav();
});