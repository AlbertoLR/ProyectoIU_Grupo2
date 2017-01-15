<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Notification.php");
require_once(__DIR__."/../Models/NOTIFICATION_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");
require_once(__DIR__."/../mail/PHPMailerAutoload.php");


class NOTIFICATION_Controller extends BaseController {

    private $notificationMapper;

    public function __construct() {
        parent::__construct();
		//Se crea dinamicamente el modelo.
        $this->notificationMapper = new NOTIFICATION_Model();
        $this->view->setLayout("default");
    }
	//Se comprueban los permisos, se controla el campo orderby segun las columnas de la vista, y envia a la vista los datos necesarios
    public function show(){
        $this->checkPerms("notification", "show", $this->currentUserId);

		if (isset($_GET["orderby"])) {            
			$notifications = $this->notificationMapper->fetch_all($_GET["orderby"]);
		} 
		else {
            $notifications = $this->notificationMapper->fetch_all();
		}
        $this->view->setVariable("notifications", $notifications);
        $this->view->render("notification", "NOTIFICATION_SHOW_Vista");
    }
	//Recoge de la vista los datos del formulario.
    public function add(){
		//Comprueba los permisos
        $this->checkPerms("notification", "add", $this->currentUserId);
		
		//Comprueba que se haya seleccionado al menos un email
		if(isset($_POST["misemails"])){
			//Comprueba que se haya escrito un asunto y mensaje
			if (isset($_POST["subject"]) && !empty($_POST["subject"])
			&& isset($_POST["message"]) && !empty($_POST["message"])){
				//Usando la clase mailer se realiza el envio del correo electrónico.
				$subject=$_POST["subject"];
				$message=$_POST["message"];		
				$correo=$_POST['misemails'];
					
				$mail = new PHPMailer;
				//Tell PHPMailer to use SMTP
				$mail->isSMTP();
				//Enable SMTP debugging
				// 0 = off (for production use)
				// 1 = client messages
				// 2 = client and server messages
				//$mail->SMTPDebug = 2;
				//Ask for HTML-friendly debug output
				$mail->Debugoutput = 'html';
				//Set the hostname of the mail server
				//$mail->Host = 'smtp.gmail.com';
				// use
				$mail->Host = gethostbyname('smtp.gmail.com');
				// if your network does not support SMTP over IPv6
				//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
				$mail->Port =587;
				//Set the encryption system to use - ssl (deprecated) or tls
				$mail->SMTPSecure = 'tls';
				//Whether to use SMTP authentication
				$mail->SMTPAuth = true;
				//Username to use for SMTP authentication - use full email address for gmail
				$mail->Username = "moovettgym@gmail.com";
				//Password to use for SMTP authentication
				$mail->Password = "moovettadmin";
				//Set who the message is to be sent from
				$mail->setFrom("moovettgym@gmail.com", 'Moovett Gym');
				//Set an alternative reply-to address
				$mail->addReplyTo("moovettgym@gmail.com", 'Moovett Gym');
				//Set who the message is to be sent to
				//$mail->addAddress($email, $email);
				//Set the subject line
				$mail->Subject = $subject;
				//convert HTML into a basic plain-text alternative body
				$mail->Body = $message;
				//Replace the plain text body with one created manually
				$mail->AltBody = $message;
				$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
						));			
				foreach($correo as $email){				
					$mail->addAddress($email, $email);		  
					}
				if (!$mail->Send()) {
						throw new Exception(i18n("Mailer Error"));
					} else {
						echo(i18n("Message sent!"));
					}
				}
			else{
				throw new Exception(i18n("Subject or Message Empty"));				
				}
			}
		else{
			throw new Exception(i18n("No Email Selected"));
		}
		$this->show();
	}
	//Recoge dtos de la vista de buscador, y en caso de que exista una busqueda por un campo, lo añade a una string que envia al modelo para realiar la busqueda
	public function search() {
        $this->checkPerms("notification", "show", $this->currentUserId);
        //Si se ha pulsado submit, se comprueba la busqueda. Si no, se muestra la vista de buscador.
		if (isset($_POST["submit"])) {
            $query = "";
            $flag = 0;
            if ($_POST["name"]){                
                $query .= "cliente.nombre_c LIKE '%". $_POST["name"] ."%'";
                $flag = 1;
            }
            if ($_POST["surname"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "cliente.apellidos_c LIKE '%". $_POST["surname"] ."%'";
                $flag = 1;
            }
            if ($_POST["activity"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "actividad.nombre LIKE '%". $_POST["activity"] ."%'";
                $flag = 1;
            }
            if ($_POST["email"]){
                if ($flag){
                    $query .= " AND ";
                }
                $query .= "cliente.email LIKE '%". $_POST["email"] ."%'";
            }
            if (empty($query)) {
                $notifications = $this->notificationMapper->fetch_all();
            } else {
                $notifications = $this->notificationMapper->search($query);
            }
            $this->view->setVariable("notifications", $notifications);
            $this->view->render("notification", "NOTIFICATION_SHOW_Vista");
        }
        else {
			$notifications = $this->notificationMapper->fetch_all();
			$this->view->setVariable("notifications", $notifications);
			$this->view->render("notification", "NOTIFICATION_SEARCH_Vista");
        }
    }
}
	  
?>
  


