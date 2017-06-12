function aplicaAutoContraste() {

     let contraste = document.getElementById("autocontraste");
     let splitUrl = contraste.href.split("/");

     if (splitUrl[5] == "styles.css") {
          contraste.href = 'css/autocontraste.css'
     } else {
          contraste.href = 'css/styles.css'
     }

}
