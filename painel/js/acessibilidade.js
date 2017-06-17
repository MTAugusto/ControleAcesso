  function aplicaAutoContraste() {

       let contraste = document.getElementById("autocontraste");
       let splitUrl = contraste.href.split("/");

       if (splitUrl[5] == "styles.css") {
            contraste.href = 'css/autocontraste.css'
       } else {
            contraste.href = 'css/styles.css'
       }

  }

  function aumentaFonte() {
       let aumentafonte = document.querySelector('body').style;
       if (aumentafonte.fontSize) {
            let splitFont = aumentafonte.fontSize.substring(0, 3);
            let convertValueFont = parseFloat(splitFont);
            if (convertValueFont <= 2.2) {
                 aumentafonte.fontSize = (convertValueFont + 0.1) + "em";
            }

       } else {
            aumentafonte.fontSize = '1.1em';
       }
  }

  function diminuiFonte() {
       let diminuirfonte = document.querySelector('body').style;
       if (diminuirfonte != '1.0em') {
            let splitFont = diminuirfonte.fontSize.substring(0, 3);
            let convertValueFont = parseFloat(splitFont);
            if (convertValueFont >= 1.0) {
                 diminuirfonte.fontSize = (convertValueFont - 0.1) + "em";
            }
       }


  }
