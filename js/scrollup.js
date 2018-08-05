let intervalId=0;const $scrollButton=document.querySelector('.scroll');function scrollStep(){if(window.pageYOffset===0){clearInterval(intervalId)}
window.scroll(0,window.pageYOffset-50)}
function scrollToTop(){intervalId=setInterval(scrollStep,12.66)}
$scrollButton.addEventListener('click',scrollToTop)