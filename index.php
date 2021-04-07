<!DOCTYPE html>
<html lang="es">
<head>

<link rel="shortcut icon" href="./publicos/img/ico.png" type="image/x-icon"/>
<script language="javascript" src="./WYSIWYG/source.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./publicos/css/styles.css">
<link rel="stylesheet" type="text/css" media="all" href="./publicos/css/switchery.min.css">
<script type="text/javascript" src="./publicos/js/switchery.min.js"></script>
	<meta charset="UTF-8">
	<title>Email Spoof</title>
	<style>
        .flex-container {
            display: flex;
            border: 1px solid rgba(0,0,0,.15);
            min-width: 400px;
            height: auto;
            border-radius: 3px;
            padding: 1%;
            display: none;
        }
		h1 {
			color: #636363;
		}
		a {
			color: #9fcd32;
			text-decoration: none;
		}
		a:hover {
			text-decoration: underline;
		}
		form ul {
			padding: 0px;
		}
		form ul li {
			list-style-type: none;
			text-align: left;
			margin-top: 10px;
		}
		form ul li:last-child {
			text-align: center;
		}
		form ul li input[type="text"],form ul li input[type="email"], form ul li textarea {
			border: 1px solid #cecece;
			border-radius: 3px;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			-o-border-radius: 3px;
			padding: 7px;
			width: 96%;
		}
		form ul li input[type="submit"] {
			background: red;
			border: none;
			color: #fff;
			cursor: pointer;
			font-size: 16px;
			font-weight: normal;
			padding: 10px;
			text-transform: uppercase;
			width: 50%;
		}
		.msn-ok, .msn-ko {
		    color: #fff;
		    padding: 10px;
		    text-align: center;
		    width: 65%;
		    margin: 10px auto;
		}
		.msn-ok {
			background: #22AF22;
		}
		.msn-ko {
			background: #CC2F2F;
		}
        .clninp {
            border: 1px solid rgba(0,0,0,.5);
            width: auto;
            padding: 1%;
            min-width: 50px;
            max-width: 100px;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            background-color: rgba(0,0,0,.10);
            margin: 0px 4px;
            box-shadow: 0px 0px 2px 1px rgba(0,0,0,.10) inset;
            -webkit-box-shadow: 0px 0px 2px 1px rgba(0,0,0,.10) inset;
        }
	</style>
	
</head>
<body>
	<div id="container">
		<h1>Enviar de emails <a href="#">Email Spoofing</a></h1>
		<?php
			//si se ha enviado el correo
			if(isset($_REQUEST['s'])){
				$ok = $_REQUEST['s'];
				if($ok == 'si'){
					echo "<div class='msn-ok'>¡Mensaje enviado correctamente!</div>";
				}
				elseif($ok == 'no'){
					echo "<div class='msn-ko'>Ha habido un error de envio...</div>";
				}
			}
		?>
<div id="wrapper">
  <h1>Email Spoofing</h1>
  <form action="app/send.php" method="post" enctype="multipart/form-data">
      <input type="hidden" id="emailsg" name="emailsg">
      <input type="hidden" id="respsta" name="respsta">
  <div class="col-2">
    <label for="nombre">
      Nombre
      <input type="text" placeholder="Nombre" id="nombre" name="nombre" tabindex="1">
    </label>
  </div>
  <div class="col-1">
    <label for="mail">
      Email 
      <input placeholder="E-mail del emisor?" type="email" id="mail" name="email" tabindex="2">
    </label>
    
  </div>
   <div class="col-1">
  <label for="mail">
        Email de respuesta?
        <div id="Flexi1" class="col-3 flex-container">
            <input class="clninp" id="input11" name="name11" value="" tabindex="3">
        </div>
        <input type="email" id="response" name="response" placeholder="E-mail de respuesta?" tabindex="2">
    </label>
</div>
  <div class="col-3">
    <label for="mailr">
	E-mail del receptor:
        <div id="Flexi" class="col-3 flex-container">
            <input class="clninp" id="input1" name="name1" value="" tabindex="5">
        </div>
      <input type="email" id="mailr" name="emailr" placeholder="E-mail del receptor" tabindex="4">
    </label>
  </div>
  <div class="col-3">
    <label for="adjunto">
	Archivo adjunto
      <input type="file" id="adjunto" multiple="true" name="adjunto[]" >
    </label>
  </div>
  <div class="col-3">
    <label for="asunto">
	Asunto:
	<input type="text" id="asunto" name="asunto" placeholder="Asunto" required tabindex="7">
    </label>
  </div>
  
    <label for="msn">
	Mensaje:
	<textarea name="msn" id="msn" required></textarea>
	<script>CKEDITOR.replace( 'msn' );</script>
    </label>
      
  <div class="col-submit">
    <input type="submit" value="Enviar">
  </div>
  
  </form>
  </div>
<script type="text/javascript">
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
			
	
	</div>

<!-- jQuery -->
<script type="text/javascript" src="./publicos/js/jquery-1.11.3.min.js"></script>
<script>
    var strEmails = "";
    var strRsptas = "";
    var strContiene = "";
    var strCnRsptas = "";
    var UltEm = "";
    var UltEmR = "";
    var campo = "";
    var Comprueba = function() {
        campo = "";
        if ( $("#nombre").val() === "" ) {
            campo = "NOMBRE";
        }else if ( $("#mail").val() === "" ) {
            campo = "MAIL EMISOR";
        }else if ( $("#response").val() === "" ) {
            campo = "MAIL DE RESPUESTA";
        }else if ( $("#mailr").val() === "" ) {
            campo = "MAIL RECEPTOR";
        }else if ( $("#asunto").val() === "" ) {
            campo = "ASUNTO";
        }else if ( $("#emailsg").val() === "" ) {
            campo = "EMAILsG";
        }
        if (campo != "") {
            alert('Rellena todos los campos, esta vacio el campo ' + campo);
            return false;
        }else{
            return true;
        }
    };
	$(document).ready(function(){
		$('form').submit(function(){
                    if ( !Comprueba() ) return false;
		});
                
               
            $("#asunto").focus(function(){
                $("#mailr").show();
                $("#Flexi").hide();
                $("#emailsg").val(strEmails);
                
                $("#response").show();
                $("#Flexi1").hide();
                $("#respsta").val(strRsptas);
            });//response
            
            $("#Flexi1").click(function(){
                UltEmR = $("#response").val();
                $("#response").val("");
                $("#response").show();
                $(this).hide();
                $("#response").focus();
            });
            $("#response").keypress(function(e){
                var iTecla = (e.keyCode) ? e.keyCode : e.which;
                if ( iTecla === 13) {
                    e.preventDefault ? e.preventDefault() : e.returnValue = false;
                    e.stopPropagation();
                    var valor = $(this).val();
                    UltEmR = $(this).val();
                    if (valor === "") {
                        $("#response").val() = UltEmR;
                        return false;
                    }
                    var num = $('#Flexi1 .clninp').length;
                    if ( $('#input1' + num).val() === "" ) {
                        $('#input1' + num).val(valor);
                        strRsptas += valor;
                        strCnRsptas += valor;
                        $("#respsta").val(strRsptas);
                        $(this).hide();
                        $("#Flexi1").show();
                        return false;
                    }
                    var newNum = new Number(num + 1);
                    var newElem = $('#input1' + num).clone().attr('id', 'input1' + newNum).val(valor);
                    newElem.children(':last').attr('id', 'input1' + newNum).attr('name', 'name1'+ newNum);
                    $('#input1' + num).after(newElem);
                    strRsptas += ","+valor;
                    strCnRsptas += ","+valor;
                    $("#respsta").val(String(strRsptas));
                    $(this).hide();
                    $("#Flexi1").show();
                    return false;
                }
            });
            
            
            
            
            $("#Flexi").click(function(){
                UltEm = $("#mailr").val();
                $("#mailr").val("");
                $("#mailr").show();
                $(this).hide();
                $("#mailr").focus();
            });
            $("#mailr").keypress(function(e){
                var iTecla = (e.keyCode) ? e.keyCode : e.which;
                if ( iTecla === 13) {
                    e.preventDefault ? e.preventDefault() : e.returnValue = false;
                    e.stopPropagation();
                    var valor = $(this).val();
                    UltEm = $(this).val();
                    if (valor === "") {
                        $("#mailr").val() = UltEm;
                        return false;
                    }
                    var num = $('#Flexi .clninp').length;
                    if ( $('#input' + num).val() === "" ) {
                        $('#input' + num).val(valor);
                        strEmails += valor;
                        strContiene += valor;
                        $("#emailsg").val(strEmails);
                        $(this).hide();
                        $("#Flexi").show();
                        return false;
                    }
                    var newNum = new Number(num + 1);
                    var newElem = $('#input' + num).clone().attr('id', 'input' + newNum).val(valor);
                    newElem.children(':last').attr('id', 'input' + newNum).attr('name', 'name' + newNum);
                    $('#input' + num).after(newElem);
                    strEmails += ","+valor;
                    strContiene += ","+valor;
                    $("#emailsg").val(String(strEmails));
                    $(this).hide();
                    $("#Flexi").show();
                    return false;
                }
            });
            
	});
</script>

</body>
</html>