function fnConsomeWs() {
    $.ajax({
        type: "POST",
        url: "http://localhost/ControleAcesso/BackEnd/api/controlador/Login.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        data: '{Usuario:"' + document.getElementById("usuario").value + '",Senha:"' + document.getElementById("password").value + '"}',
        success: function (response) {
            console.log(response);
            if (manterLogado) {
                localStorage.setItem('user_session', response.token);
                console.log("token gravado no local storage");
            }else{
                sessionStorage.setItem('user_session', response.token);
                console.log("token gravado no session storage");
            }
        }

    });
}
