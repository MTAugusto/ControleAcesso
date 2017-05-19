function fnConsomeWs() {
    $.ajax({
        type: "POST",
        url: "./BackEnd/api/controlador/login.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        data: '{Usuario:"' + document.getElementById("usuario").value + '",Senha:"' + document.getElementById("password").value + '"}',
        success: function (data) {
            alert(data.d);
        }
    });
}


// /*teste api*/
//
// var sessao = null;
// var usuario = null;
// var password = null;
// $(document).ready(function(){
// 	$.postJSON = function(url, data, callback) {
// 	    return jQuery.ajax({
// 	    'type': 'POST',
// 	    'url': "./BackEnd/api/controlador/login.php",
// 	    'contentType': 'application/json',
// 	    'data': JSON.stringify(data),
// 	    'dataType': 'json',
// 	    'success': callback
// 	    });
// 	};
//
// 	  $("#login-subimit").click(function(){
// 		    if (!$("#ususario").val()) {
// 		    	window.alert("Informe o username");
// 		    }
// 		    else {
// 		    	if (!$("#password").val()) {
// 		    		window.alert("Informe a password");
// 		    	}
// 		    	else {
// 		    		$.get("./BackEnd/api/controlador/login.php"
// 		    				+ $("#username").val()
// 		    				+ "/"
// 		    				+ $("#password").val(),
// 		    				function(responseTxt,statusTxt,xhr) {
// 		    					if (xhr.status == 200) {
// 		    						sessao = responseTxt;
// 		    						alert("Logon ok");
// 		    						showUser();
// 		    						updateMessages();
// 		    					}
// 		    					else {
// 		    						alert("Erro: " + statusTxt);
// 		    					}
// 		    				}
// 		    				);
// 		    	}
// 		    }
// 		});
//
// 	  $("#refresh").click(function(){
// 		 updateMessages();
// 	  });
// });
// function showUser() {
// 	$.postJSON("/mb/server/userdata", sessao,
// 			function(resposta) {
// 		    	usuario = resposta;
// 		    	$("#usuario").text(usuario.username);
// 		  	}
// 			);
// }
// function updateMessages() {
// 	if (!sessao) {
// 		alert("Tem que logar antes!");
// 	}
// 	else {
// 		$("#mensagens").empty();
// 		$("#mensagens").text("... aguardando ...");
// 		$.postJSON("/mb/server/messages", sessao,
// 				function(resposta) {
// 			    	var lista = resposta;
// 			    	$("#mensagens").empty();
// 			    	for (var x=0; x < lista.length; x++) {
// 			    		var mensagem = lista[x];
// 			    		$("#mensagens").append("<hr>" + new Date(mensagem.map.data.map.$date) + ", " + mensagem.map.texto);
// 			    	}
// 			  	}
// 				);
//
// 	}
// }
