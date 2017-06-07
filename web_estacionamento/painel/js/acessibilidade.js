function aplicaAutoContraste() {

     let contraste = document.getElementById("autocontraste");
     console.log(contraste);
     let splitUrl = contraste.href.split("/");
     console.log(splitUrl[5]);

     if (splitUrl[5] == "styles.css") {
          contraste.href = 'css/autocontraste.css'
          console.log(contraste);
     } else {
          contraste.href = 'css/styles.css'
          console.log(contraste);
     }

}
