<script>
    var cpt = 0;
    var tabQuestions = new Array();
    
    function Question(libelle , type) {
      this.libelle=libelle;
      this.type=type;
   }
   
   function supprimerQuestion(index) {
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
        if($("#libelle").val() == "") {
            return false;
        } else {
            var uneQuestion = new Question($("#libelle").val(), $('input[type=radio][name=type]:checked').attr('value'));
            return uneQuestion;
        }
    }
    
    function enregistrer() {
        uneQuestion = add();
        if(uneQuestion== false) {
            alert("Veuillez entrer un libelle pour la question");
        } else {
            var index = $("#suppr").index();
            index++;
            $.ajax({
                type : "GET",
                url: "./index.php",
                data: {
                    q: uneQuestion,
                    page : 'AddQuestion'
                }, 
                success: function(msg){
                    location.reload();
                }	
            });
        }      
    }
    

    
   
</script>

<fieldset id ="addQuestion">
    <input type="text" id ="libelle" name="libelle" value="" size ="150"/><p>
    OUVERTE<input type="radio" id="type" name="type" value="0" checked="checked"/>
    FERMEE<input type="radio" id="type" name="type" value="1" />
    <input type="button" id="valider" value="AJOUTER" name="valider" onclick ="enregistrer();"/><p>
</fieldset>