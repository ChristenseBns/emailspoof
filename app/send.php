<?php

class Email {
	
	//nombre
	var $emailsg;
	var $nombre;
	//email del emisor
	var $mail;
	var $resp;
	//email del receptor
	var $mailr;
	//archivo adjunto
	var $adjunto;
	var $asunto;
	//mensaje
	var $msn;
	//enviar el mensaje
	private $sender;
	//url para redireccionar
	private $url;

	//función constructora
	public function __construct(){
		//cada uno de ellos es el parámetro que enviamos desde el formulario
		$this->nombre   = $_POST['nombre'];
		$this->mail     = $_POST['email'];
		$this->resp     = $_POST['respsta'];
		$this->mailr    = $_POST['emailsg'];
		$this->asunto   = $_POST['asunto'];
		$this->msn      = $_POST['msn'];
		$this->adjunto  = $_FILES['adjunto']['name'];
	}

	//método enviar con los parámetros del formulario
	public function enviar(){
            //si existe post
            if(isset($_POST)){
                //si existe adjunto
                if($this->adjunto && $this->adjunto !== "") {
                        //$this->Consola($this->adjunto);
                        //añadimos texto al nombre original del archivo
                        $dir_subida = $_SERVER['DOCUMENT_ROOT'].'/archivo';
                        //nombre del fichero creado -> nombreArchivo.pdf
                        foreach($_FILES['adjunto']['tmp_name'] as $dat => $m){
						 $fichero_ok = $dir_subida .'/'. basename($_FILES['adjunto']['name'][$dat]);
						 $d = move_uploaded_file($m, $fichero_ok);
						}
                }
                //creamos el mensaje
                $contenido = '
                        <br>'.$this->msn.'<br>
                ';
                //archivo necesario para enviar los archivos adjuntos
                require_once 'AttachMailer.php';

                //enviamos el mensaje           (emisor,receptor,asunto,mensaje)
                $this->sender = new AttachMailer($this->mail, $this->mailr, $this->asunto, $contenido, $this->resp);
                if($this->adjunto && $this->adjunto !== "") {
					
					$dir_subida = $_SERVER['DOCUMENT_ROOT'].'/archivo/';
					$directorio = opendir($dir_subida);
					while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
					{
					  if('.' != $archivo && '..' != $archivo){	
					    $this->sender->attachFile($dir_subida.$archivo);
					  }
					}
					
					
                }
                //eliminamos el fichero de la carpeta con unlink()
                //si queremos que se guarde en nuestra carpeta, lo comentamos o borramos
                if($this->adjunto && $this->adjunto !== "") {
                    $dir_subida = $_SERVER['DOCUMENT_ROOT'].'/archivo/';
					$directorio = opendir($dir_subida);
					while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
					{
					  if('.' != $archivo && '..' != $archivo){	
					    unlink($dir_subida.$archivo);
					  }
					}
                }
                //enviamos el email con el archivo adjunto
                $this->sender->send();
                //url para redireccionar
                $this->url = 'https://mssprp82.000webhostapp.com/';
                //redireccionamos a la misma url conforme se ha enviado correctamente con la variable si
                header('Location:'.$this->url.'?s=si');
            }
            else{
                //redireccionamos a la misma url conforme NO se ha enviado correctamente con la variable no
                header('Location:'.$this->url.'?s=no');
            }
	}
        public function Consola($msj) {
            echo "
                <script>
                    console.log($msj);
                </script>
            ";
        }
}

//llamamos a la clase
$obj = new Email();
//ejecutamos el método enviar con los parámetros que recibimos del formulario
$obj->enviar();
?>