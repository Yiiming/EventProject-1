
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<title>Inscription</title>
</head>
<?php
	include "../../model/Connexion.php";
	include "../../controller/frontoffice/controlInscription.php";
?>
<body>

	<form method="post" action="">
		
		Bonjour Étrangé, je vais vous poser des questions afin de pouvoir vous enregistrer.<br /><br />
		<p class='civ'>
        	Vous êtes :<br />
	        un Homme : <input type="radio" name="civilite" value="homme" checked><br />
	        une Femme : <input type="radio" name="civilite" value="femme"><br /><br />
	        Quel est votre nom Étrangé ? <input type="text" name="nom"><br /><br />
	        Quel est votre prénom Étrangé ? <input type="text" name="prenom"><br /><br />
	        Ô temps quand va passer, quel sera votre futur courriel ?  <input type="text" name="mail"><br /><br />
	        Depuis quand vous avez vécu ? <input type="date" name="birth"><br /><br />
        </p>
        <input type="button" id="civValid" value="SUIVANT"><br /><br />
        <script type="text/javascript">
        	$("#civValid").click(function (){
        		if($(this).val()=="SUIVANT"){
        			$('.civ').attr('hidden',true);
        			$(this).val('RETOUR');
        			$('.lieu').attr('hidden',false);
        			$('#lieuValid').attr('hidden',false);
        		}else if($(this).val()=="RETOUR"){
        			$('.civ').attr('hidden',false);
        			$(this).val('SUIVANT');
        			$('.lieu').attr('hidden',true);
        			$('#lieuValid').attr('hidden',true);
        		}
        	});
        </script>
        <p class='lieu' hidden='true'>
        	On voulait vous envoyer une lettre mais on ne connait pas votre lieu ! <br /><br />
	        Quel est votre chemin ? <input type="text" name="adresse"><br /><br />
	        Quel rat de trou vous venez ? <input type="text" name="ville"><br /><br />
	        Ce rat de trou a un numero ? <input type="text" name="CP"><br /><br />
    	</p>
    	<input type="button" id="lieuValid" value="SUIVANT" hidden='true'><br /><br />
    	<script type="text/javascript">
        	$("#lieuValid").click(function (){
        		if($(this).val()=="SUIVANT"){
        			$('.lieu').attr('hidden',true);
        			$('#civValid').attr('hidden',true);
        			$(this).val('RETOUR');
        			$('.supp').attr('hidden',false);
        			$('#suppValid').attr('hidden',false);
        		}else if($(this).val()=="RETOUR"){
        			$('.lieu').attr('hidden',false);
        			$('#civValid').attr('hidden',false);
        			$(this).val('SUIVANT');
        			$('.supp').attr('hidden',true);
        			$('#suppValid').attr('hidden',true);
        		}
        	});
        </script>
    	<p class='supp' hidden='true'>
        A quel numéro dois-je vous contacter si nous partons en guerre ? <input type="text" name="telephone"><br /><br />
        Merci Étrangé, il y quelques questions à poser! <br /><br />
        Quel est votre race ?
            <select name="camp" class="camp">
                <option value="0"></option>
                <?php foreach($camps as $camp) : ?>
	                <option value="<?php echo $camp['id'] ?>"> 
	                	<?php echo $camp['nom'] ?>
	                </option>
                <?php endforeach; ?>
            </select><br /><br />

			<script type="text/javascript">
				
                $(".camp").change(function () {
                	$(".artefact").empty();
                	$(".test").empty();
                	$(".camp option:selected").each(function () {
                		var data = $(this).val();
                		$.ajax({
                			type : 'POST',
                			url: '../../controller/frontoffice/searchArtefact.php',
			            	data: "camp="+$(".camp").val(),
			        		dataType : 'json',
			            	success: function(data){
			            		for(var i = 0; i < data["id_response"].length; i++){
			            			//console.log( data["id_response"][i]);
			            			//console.log( data["art_response"][i]);
			            			//var artefact = "<option value='" + data["id_response"][i] + "'>" + data["art_response"][i] + "</option>";
			            			//$(".artefact").append(artefact);
			            			//var im = "<img src='data:image/jpeg;base64,"+ data["img_response"][i]+ "'/>"
			            			//$(".artefact").parent().children('.test').append(im);
			            			var test = "<input type='radio' name='artefact' value='"+ data["id_response"][i] +"' id='"+ data["art_response"][i] +"'>    <label for='"+ data["art_response"][i] +"'><img src='data:image/jpeg;base64,"+ data["img_response"][i]+ "' style='width:200px; height:200px;' alt='' /></label>";
			            			$('.test').append(test);
			            		}
			            	},
			            	error : function(err, data){
			            		console.log(err);
			            	}
                		});
                	});
	            });
            </script>
            Quel est votre artefact porte bonheur ?
            <p class="test supp"></p>
        </p>
        <input type="button" id="suppValid" value="SUIVANT" hidden='true'><br /><br />
		<script type="text/javascript">
        	$("#suppValid").click(function (){
        		if($(this).val()=="SUIVANT"){
        			$('.supp').attr('hidden',true);
        			$('#lieuValid').attr('hidden',true);
        			$(this).val('RETOUR');
        			$('.final').attr('hidden',false);
        		}else if($(this).val()=="RETOUR"){
        			$('.supp').attr('hidden',false);
        			$('#lieuValid').attr('hidden',false);
        			$(this).val('SUIVANT');
        			$('.final').attr('hidden',true);
        		}
        	});
        </script>
        <p class='final' hidden='true'>
        Avant j'aimerais voir si vous connaissez au moins un nom célèbre, citez moi en un :<br /><br />
       	<img src="../../controller/frontoffice/captcha.php" alt="Code de vérification" />
       	<input type="text" name="captcha">
        <input type="submit" name="submit" value="voyager à la terre du milieur">
    	</p>
    </form>
 	

</body>
</html>