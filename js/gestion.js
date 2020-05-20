let buttonCookie = document.getElementById('button-cookie');
let blockCookie = document.getElementById('info-cookie');

if(document.getElementById('button-cookie')){
    buttonCookie.addEventListener('click', () =>{
        blockCookie.style.display = "none";
        document.cookie = 'info-cookie = YES ; path=/'
    })

}




