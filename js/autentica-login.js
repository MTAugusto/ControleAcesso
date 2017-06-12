function fnConsomeWs() {

     let usuario = document.getElementById("usuario").value;
     let senha = document.getElementById("password").value;
     let ficarLogado = document.getElementById("filled-in-box").checked;

     $.ajax({
          type: "POST",
          url: "http://localhost/ControleAcesso/api/login",
          contentType: "application/x-www-form-urlencoded; charset=utf-8",
          dataType: "json",
          async: true,
          data: $.param({
               'usuario': usuario,
               'senha': senha
          }),
          success: function(response) {

               if (ficarLogado) {
                    localStorage.setItem('user_session', response.token);
               } else {
                    sessionStorage.setItem('user_session', response.token);
               }
               window.location = "/painel/#/";    
          },
          error: function(response) {
               console.log('Erro token' + '' + response.responseJSON);
          }
     });
}
