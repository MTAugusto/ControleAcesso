function aplicaAutoContraste() {
     let contraste = document.getElementById("autocontraste")
     console.log(contraste.href)
     if (contraste.href == "http://localhost:8080/painel/css/styles.css") {
          contraste.href = 'css/autocontraste.css'
          console.log(contraste)
     } else {
          contraste.href = 'css/styles.css'
          console.log(contraste)
     }

}
