$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});
document.addEventListener('DOMContentLoaded', function(){
    if(document.querySelector("#formLogin")){

        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function(e){
            e.preventDefault();

            let strEmail = document.querySelector('#txtEmail').Value;
            let strPassword = document.querySelector('#txtPassword').Value;

            if(strEmail == "" || strPassword == "")
            {
                swal("Por favor", "Escribe usuario y contraseña.", "error");
                return false; 
            }
            else{
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObj
                var ajaxUrl = base_url + '/Login/loginUser';
                var formData = new FormData(formLogin);
                request.open("POST",ajaxUrl,TRUE);
                request.send(formData);
            }
        }
    }
}, false);