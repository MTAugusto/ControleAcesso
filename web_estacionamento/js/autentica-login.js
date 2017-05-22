function fnConsomeWs() {

     let usuario = document.getElementById("usuario").value;
     let senha = document.getElementById("password").value;
     let ficarLogado = document.getElementById("filled-in-box").checked;

     $.ajax({
          type: "POST",
          url: "http://localhost/ControleAcesso/BackEnd/api/controlador/Login.php",
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
                    console.log("token gravado no local storage");
               } else {
                    sessionStorage.setItem('user_session', response.token);
                    console.log("token gravado no session storage");
               }
               console.log(response);
               window.location = "/painel/#/";    
          },
          error: function(response) {
               console.log(response.responseJSON);
          }
     });
}
