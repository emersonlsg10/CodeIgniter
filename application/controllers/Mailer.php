<?php

class Mailer extends CI_Controller {

    const USERNAME = "marthasoraya123@gmail.com";
    const PASSWORD = "<?password?>";
    const NAME_FROM = "HCode Store";

    private $mail;

    function __construct($toAdress, $toName, $subject, $tplName, $data = array()) {

        $this->load->library("My_PHPMailer");
        $html = $this->template->load("email/$tplName", $data);


//create a new PHPMailer
        $this->mail = new PHPMailer;

//tell PHPMailer to use SMTP
        $this->mail->isSMTP();

//enable SMTP debugging
//0 = off (for production use)
//1 = client messages
//2 = client and server messages
        $this->mail->SMTPDebug = 0;

//Askfor HTML-friendly debug output
        $this->mail->Debugoutput = 'html';

//set the hostname of the mail server
        $this->mail->Host = 'smtp.gmail.com';
//use
//$email->Host = gethostbyname('smtp.gmail.com');
//if your network does not support SMTP over IPV6
//set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $this->mail->Port = 587;

//set the encryption system to use - sll (deprecated) or  tls
        $this->mail->SMTPSecure = 'tls';

//whether to use SMTP authentication 
        $this->mail->SMTPSecure = 'true';

//username to use for SMTP authentication - use full email address for gmail
        $this->mail->Username = Mailer::USERNAME;

//password to use for smtp authentication - use full email adress for gmail
        $this->mail->Password = Mailer::PASSWORD;

//set who the message is to be sent from
        $this->mail->setFrom(Mailer::USERNAME, Mailer::NAME_FROM);

//set an alternative reply-to address
//$this->mail->addReplyTo('reply@example.com', 'First Last');
//set who the message is to be sent to
        $this->mail->addAddress($toAdress, $toName);

//set the subject line
        $this->mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded
//convert HTML into a basic plain-text alternative body
        $this->mail->msgHTML($html);

//replace the plain text ody with one created manually
        $this->mail->AltBody = 'This is a plain-text message body';
    }

    public function send() {
        return $this->mail->send();
    }

}
