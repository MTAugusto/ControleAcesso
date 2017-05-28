function aplicaAutoContraste() {
     let contraste = document.getElementById("autocontraste")
     if (contraste.href == "http://localhost:8080/painel/css/styles.css") {
          contraste.href = 'css/autocontraste.css'
     } else {
          contraste.href = 'css/styles.css'
     }

}
