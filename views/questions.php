<script>
    var cpt = 0;
    var tabQuestions = new Array();
    
    function Question(libelle , type) {
      this.libelle=libelle;
      this.type=type;
   }
   function dupliquer() {
//        $('#addQuestion').clone().appendTo($('body'));
        $('#addQuestion').before($('#save'));
      }
    function add() {
        if($("#libelle").val() == "") {
            alert("Veuillez entrer un libelle pour la question");
        } else {
            var uneQuestion = new Question($("#libelle").val(), $('input[type=radio][name=type]:checked').attr('value'));
            tabQuestions[cpt] = uneQuestion;
            cpt++;
        }
    }
    
    function enregistrer() {
        if(tabQuestions.length <= 4) {
            alert("Vous devez ajouter 5 questions minimum");
        } else {
            $.ajax({
                type : "GET",
                url: "./index.php",
                data: {
                    tab: tabQuestions,
                    page : 'Questions'
                }, 
                success: function(msg){
                    alert(msg);
                }	
            });
        }

    }
    

    
   
</script>

<input type="button" value="AJOUTER" name="ajouter" onclick ="dupliquer();"/>
<input type="button" id ="save"value="ENREGISTRER" name="save" onclick ="enregistrer()();" />
<fieldset id ="addQuestion">
    <input type="text" id ="libelle" name="libelle" value="" size ="150"/><p>
    OUVERTE<input type="radio" id="type" name="type" value="0"/>
    FERMEE<input type="radio" id="type" name="type" value="1" />
    <input type="button" id ="valider"value="VALIDER" name="valider" onclick ="add();"/><p>
</fieldset>