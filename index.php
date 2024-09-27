<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once "vendor/autoload.php";

    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['message']))
    {
        $nom=$_POST['name'] ?? "";  
        $prenom=$_POST['surname'] ?? ""; 
        $email=$_POST['email'] ?? "";
        $message=$_POST['message'] ?? "";
    }
    if(empty($nom))
    {
        header("Location:home.html?error=Votre nom est requis");
        exit();
    }
    else if (empty($prenom)) 
    {
        header("Location:home.html?error=Votre prenom est requis");
        exit();
    }
    else if(empty($email))
    {
        header("Location:home.html?error=Votre adresse mail est requis");
        exit();
    }
    else if(empty($message))
    {
        header("Location:home.html?error=un message est requis");
        exit();
    }
    else{      
        $smtpHost = "smtp.gmail.com";  
        $smtpPort = 465;
        $smtpUsername = "val59roger@gmail.com";
        $smtpPassWord ="gudk iyiu pzes xneq";
        $date = date('l jS \of F Y h:i:s A');


        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            
            $mail->Host       = $smtpHost;                              
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = $smtpUsername;                           
            $mail->Password   = $smtpPassWord;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = $smtpPort;                          
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mail->setFrom('val59roger@gmail.com', 'Valentin Roger');
                $mail->addReplyTo($email, "$nom $prenom");
                $mail->addAddress('val59roger@gmail.com');
            

            $mail->isHTML(true);                               
            $mail->Subject = 'Prise de contact via portefolio';
            $mail->Body    = "<html>
                                <body>
                                        <h1>$nom $prenom vient de prendre contact avec vous !</h1> 
                                        <p>$message</p>
                                        <hr />
                                        <p>envoie du mail le $date via $email<p>
                                </body>
                            </html>";
            $mail->send();
            header('Location: home.html');
            exit();
        } else {
            header("Location:home.html?error=le mail est inconnue");
        }
        } catch (Exception $e) {
            header("Location:home.html?error=erreur lors de l'envoie de mail : {$mail->ErrorInfo}");
        }
    }
?>