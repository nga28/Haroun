<script>
    var cpt = 0;
    var tabQuestions = new Array();
    //OBJET QUESTION
    function Question(libelle , type) {
      this.libelle=libelle;
      this.type=type;
   }
   
   function supprimerQuestion(index) {
       //FONCTION AJAX QUI SUPPRIMER UNE QUESTION EN BDD EN INSTANCIANT LE CONTROLLER SPECIFIQUE
       $.ajax({
                type : "GET",
                url: "./index.php",
                data: {
                    action : 'suppr',
                    id : index,
                    page : 'Questions'
                }, 
                success: function(msg){
                    location.reload();
                }	
            });
   }
    
    function add() {
    //CREE UNE NOUVELLE QUESTION QUE L ON VA TRANSMETTRE A LA FONCTION enregistrer() POUR ETRE AJOUTEE EN BDD
        if($("#libelle").val() == "") {
            return false;
        } else {
            var uneQuestion = new Question($("#libelle").val(), $('input[type=radio][name=type]:checked').attr('value'));
            return uneQuestion;
        }
    }
    
    function enregistrer() {
        //FONCTION AJAX QUI AJOUTE UNE QUESTION EN BDD EN INSTANCIANT LE CONTROLLER SPECIFIQUE
        uneQuestion = add();
        if(uneQuestion== false) {
            alert("Veuillez entrer un libelle pour la question");
        } else {
            $.ajax({
                type : "GET",
                url: "./index.php",
                data: {
                    libelle: uneQuestion.libelle,
                    type: uneQuestion.type,
                    page : 'AddQuestion'
                }, 
                success: function(msg){
                    location.reload();
                }	
            });
        }      
    }
    

    
   
</script>
<!--FORMULAIRE D'AJOUT DE QUESTIONS-->
<form id="formID" class="formular">
<fieldset>
    <legend>QUESTION</legend>
    <label>
        <span>Entrez le libelle de votre question</span>
    </label>
    <input class="text-input" type="text" name="libelle" id="libelle"  />
</fieldset>
    <fieldset>
        <legend>TYPE QUESTION</legend>
        <label>
            <span style = 'font-weight:bold'>Choississez votre type de question</span>
        </label>
        <table style='font-size:12px;margin-top:10px'>
            <tr>
                <td>OUVERTE<input type='radio' name='type' value='0' CHECKED="checked"/></td>
            </tr>   
            <tr>    
                <td>FERMEE <input type='radio' name='type' value='1' /></td>
            </tr>
            <tr>    
                <td>NUMERIQUE <input type='radio' name='type' value='2' /></td>
            </tr>
        </table>
        <input type='button' id = 'valider' value='Valider' name='valider' onclick ='enregistrer();'/>
    </fieldset>
</form>
