function scrolldown()
{
	window.scroll({ top: (document.getElementById("photo_container").scrollHeight-90), left: 0, behavior: 'smooth' });
}
function scrollup()
{
	window.scroll({ top: 0, left: 0, behavior: 'smooth' });
}
function isIndex()
{
	return document.getElementById("photo_container") ? true : false;
}
window.addEventListener('scroll',function()
{
	if (
		isIndex() ? 
		(document.body.scrollTop > document.getElementById("photo_container").scrollHeight-100 || document.documentElement.scrollTop > document.getElementById("photo_container").scrollHeight-100) : 
		(document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) 
	)
	{
		document.getElementById("scrollup").style.visibility = "visible";
		document.getElementById("scrollup").style.opacity = "1";
	}	
	else
	{
		document.getElementById("scrollup").style.visibility = "hidden";
		document.getElementById("scrollup").style.opacity = "0";    
	}

});
