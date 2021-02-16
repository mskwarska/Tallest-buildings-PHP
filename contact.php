<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include 'cfg.php';

// walidacja pól email, temat i tresc
if ($_SERVER['REQUEST_METHOD'] === "POST") {
	if (empty($_POST['email'])) {
		$emailError = 'Email jest pusty.';
	} else {
		$email = $_POST['email'];
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailError = 'Błędny email';
		}
	}
	if (empty($_POST['temat'])) {
		$subjectError = 'Musisz wpisać temat.';
	} else {
		$temat = $_POST['temat'];
	}
	if (empty($_POST['tresc'])) {
		$bodyError = 'Wiadomość jest pusta';
	} else {
		$tresc = $_POST['tresc'];
	}
}

// funkcja zwracająca formularz
function PokazKontakt()
{
    return = '
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" enctype="multipart/form-data">
            Temat: <input name="temat" type="text" ><br>
            Adres e-mail: <input name="email" type="text" ><br>
            Wiadomość: </<textarea name="tresc">Wpisz wiadomość</textarea>
            <input name="submit" type="submit" value="Wyślij">
        </form>';
}


// funkcja wysyłająca maila 
function WyslijMail($email, $odbiorca, $temat, $tresc )
{
        $mail['subject'] = $temat;
        $mail['body'] = $tresc;
        $mail['sender'] = $email;
        $mail['reciptient'] = $odbiorca;

        $headers =  'From: ' .$email. "\r\n" .
                    'Reply-To: ' .$email. "\r\n" .
                    'MIME-Version: 1.0\r\n' . 
					'Content-Type: text/html; charset=iso-8859-1\n'.
					'X-Sender: <' . $sender . '>'.
					'Return-Path: <' . $sender . '>';

        mail($mail['reciptient'], $mail['subject'], $mail['body'], $headers);

        echo "Mail został wysłany. Dziękujemy " ;
}


//funkcja umożliwiająca przypomnienie hasła 
function PrzypomnijHaslo($email)
{
    $sql = "SELECT Password FROM uzytkownicy WHERE email='$email' LIMIT 1";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    
    WyslijMail($email, 'mail@mail.com', 'Kontakt przypomnienie hasła', 'Hasło: ' .$row['Password']  );
}


?>