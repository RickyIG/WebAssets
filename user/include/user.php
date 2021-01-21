<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class User extends mysqli {
    function __construct()
    {
        Parent::__construct("localhost", "root", "", "user");

        if($this->connect_error) {
            $_SESSION['error'] = "DB Connection error: ". $this->connect_error;
            return;
        }
    }

    public function register($data)
    {
        $pass = password_hash($data['pass'], PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(4));
        $q = "SELECT * FROM users WHERE email='$data[email]'";
        $run = $this->query($q);
        if ($run->num_rows > 0) {
            $_SESSION['error'] = "Email Already Exist.";
            return;
        } else {
            $link = mysqli_connect("localhost", "root", "", "user");
//            $q = "INSERT INTO users(nama,email,password,token,active) VALUES('$data[name]'. '$data[email]','$pass', '$token', 0)";
            $query = "INSERT INTO users(nama, email, password, token, active) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);
            $stmt->bind_param('ssssi', $data['name'],$data['email'], $pass, $token, intval(0));
            $stmt->execute();
            $stmt->close();
            $user = $this->getuser($data['email']);
            $_SESSION['id'] = $user->id;
            $this->send_mail($user->email, $user->id, $token);
            header("Location: http://localhost:63342/UTSPBO2FINALE/user/activate.php");
        }
    }

    public function getuser($email)
    {
        $q = "SELECT * FROM users WHERE email='$email'";
        $run = $this->query($q);
        $row = $run->fetch_object();
        return $row;
    }

    public function send_mail($email, $id, $token)
    {
//        $subject = "Account Activation Code";
//
//        $headers = "From: dummypesan@gmail.com \r\n";
////        $headers .= "Reply-To: abc@abc.com \r\n";
////        $headers .= "CC : abc@abc.com \r\n";
//        $headers .= "MIME-Version: 1.0\r\n";
//        $headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";

//
//        $mail->send();


// Include autoload.php file

        require '../vendor/phpmailer/phpmailer/src/Exception.php';
        require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require '../vendor/phpmailer/phpmailer/src/SMTP.php';
        require '../vendor/autoload.php';
// Create object of PHPMailer class
        $mail = new PHPMailer(true);

        $output = '';

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            // Gmail ID which you want to use as SMTP server
            $mail->Username = 'dummypesan@gmail.com';
            // Gmail Password
            $mail->Password = 'cGFzc3dvcmRueWEgYXBhYW4geWFrIGhtbSBha3UganVnYSBnYXRhdSBkYSB3a3drdw==';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email ID from which you want to send the email
            $mail->setFrom('dummypesan@gmail.com');
            // Recipient Email ID where you want to receive emails
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "User Activation Code";
            $message = '<html><body>';
            $message .= '<h1>Your Activation Code</h1>';
            $message .= '<h3>'.$token.'</h3>';
            $message .= '<h3>OR</h3>';
            $message .= '<h3>'.'http://localhost:63342/UTSPBO2FINALE/user/activate.php?active='.$token.'&id='.$id.'</h3>';
            $message .= '</body></html>';
            $mail->Body = "<h3>To : $email <br>Message : $message</h3>";

            $mail->send();

        } catch (Exception $e) {

        }
    }

    public function activate($id, $token)
    {
        $link = mysqli_connect("localhost", "root", "", "user");
        $query = "UPDATE users SET active = ? WHERE id  = ? AND token = ?";
        $stmt = mysqli_prepare($link, $query);
        if ($token == $this->gettokenbyid($id)){
            $stmt->bind_param('iis', intval(1), $id, $token);
            $stmt->execute();
            $stmt->close();
            $user = $this->getuserbyid($id);
            $_SESSION['user'] = $user;
            header("Location: http://localhost:63342/UTSPBO2FINALE/user/index.php");
        }
        else {
            $_SESSION['error'] = "Wrong activation code.";
        }
    }

    public function  gettokenbyid($id)
    {
        $q = "SELECT token FROM users WHERE id='$id'";
        $run = $this->query($q);
        $row = mysqli_fetch_assoc($run);
        $gettoken = $row['token'];
        return $gettoken;
    }

    public function getuserbyid($id)
    {
        $q = "SELECT * FROM users WHERE id='$id'";
        $run = $this->query($q);
        $row = $run->fetch_object();
        return $row;
    }

    public function auth($email, $pass)
    {
        $q = "SELECT id FROM users WHERE email='$email' AND active=1";
        $run = $this->query($q);
        if ($run->num_rows > 0) {
            $row = $run->fetch_object();

            $q = "SELECT * FROM users WHERE id='$row->id'";
            $run = $this->query($q);
            $row = $run->fetch_object();

            if (password_verify($pass, $row->password)) {
                $_SESSION['user'] = $row;
                header("Location: http://localhost:63342/UTSPBO2FINALE/user/index.php");
            } else {
                $_SESSION['error'] = "Password is not valid";
            }
        } else {
            $_SESSION['error'] = "Email does not exist or user is not active";
        }
    }
}