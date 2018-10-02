window.addEventListener('load',()=>
{
    var boran = Array.prototype.slice.call(document.getElementsByClassName('muay-boran'));
    var chi = Array.prototype.slice.call(document.getElementsByClassName('tai-chi'));
    var thai = Array.prototype.slice.call(document.getElementsByClassName('muay-thai'));
    var maga = Array.prototype.slice.call(document.getElementsByClassName('krav-maga'));
    var sala = Array.prototype.slice.call(document.getElementsByClassName('wolna-sala'));
    var crus = Array.prototype.slice.call(document.getElementsByClassName('montifera'));
    var teakwondo = Array.prototype.slice.call(document.getElementsByClassName('teakwondo'));
    var wszystko =  boran.concat(boran, chi, thai, maga, sala, crus, teakwondo);

    for (let i = 0; i < wszystko.length; i++) 
    {
        wszystko[i].addEventListener("click", function() 
        {
            var desc_class = "";
            this.classList.contains("muay-boran") ? desc_class = "boran" :
            this.classList.contains("tai-chi") ? desc_class = "chi" :
            this.classList.contains("muay-thai") ? desc_class = "thai" :
            this.classList.contains("krav-maga") ? desc_class = "maga" :
            this.classList.contains("wolna-sala") ? desc_class = "sala" :
            this.classList.contains("montifera") ? desc_class = "crus" :
            this.classList.contains("teakwondo") ? desc_class = "teakwondo" :desc_class = "";
            desc_class += '-desc';
            let desc = document.getElementById(desc_class);
            otworz(desc);
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
    przyciemniacz.addEventListener("click", function() 
    {
        zamknij(document.getElementsByClassName('active')[0]);
    });
    function otworz(co)
    {
        if (!co.style.maxHeight)
        {
            przyciemniacz.classList.add('aktywny');
            przyciemniacz.style.visibility='visible';
            co.style.visibility = "visible";
            co.style.maxWidth = co.scrollWidth + "px";
            co.style.maxHeight = co.scrollHeight + "px";
            setTimeout(()=>{co.classList.add('active');}, 900);
        }
    }
    function zamknij(co)
    {
        if(co.style.maxHeight)
        {
            przyciemniacz.classList.remove('aktywny');
            co.style.maxWidth = null;
            co.style.maxHeight = null;
            setTimeout(()=>{
                    przyciemniacz.style.visibility='hidden';
                    co.style.visibility = "hidden";
                    co.classList.remove('active');
                }, 900);
        }
    }
});