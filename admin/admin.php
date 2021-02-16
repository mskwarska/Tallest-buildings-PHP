<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include './cfg.php';
session_start();


if ((!isset($_POST['email'])) || (!isset($_POST['login_pass'])))
{
	header('Location: admin.php');
	exit();
}

// formularz logowania
function FormularzLogowania()
{
    return = '
    <div class="logowanie">
		<form name="LoginForm" method="post"  enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].' ">
			<table>
				<tr><th colspan="2">Logowanie</th></tr>
				<tr><td>E-mail</td><td><input type="text" name="email"/></td></tr>
				<tr><td>Hasło</td><td><input type="password" name="login_pass"/></td></tr>
				<tr><td><a href="?page=przypomnijHaslo">Przypomnij hasło</a></td><td><input type="submit" name="login" value="Zaloguj"/></td></tr>
			</table>
		</form>
	</div>
    ';

    
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
}

// logowanie uzytkownika 
function Login()
{
	global $link;
	if ($link->connect_errno!=0)
	{
		echo "Error: ".$link->connect_errno;
	}
	else
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$email = htmlentities($email, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
	
		if ($result =$link->query(
		sprintf("SELECT * FROM uzytkownicy WHERE Email='%email' AND Password='%pass'",
		mysqli_real_escape_string($link,$email),
		mysqli_real_escape_string($link,$password))))
		{
			$manyrow= $result->num_rows;
			if($manyrow>0)
			{
				$_SESSION['zalogowany'] = true;
				
				$row = $result->fetch_assoc();
				$_SESSION['id'] = $row['id'];
				$_SESSION['user'] = $row['user'];
				$_SESSION['email'] = $row['email'];
				
				unset($_SESSION['blad']);
				$result->free_result();
				header('Location: index.php');
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy email lub hasło!</span>';
				header('refresh:0');
				
			}
		}
		
		$link->close();
	}
	
}

// wypisywanie isniejących podstron
function WypiszStrony()
{
	global $link;
    $query = "SELECT * FROM page_list LIMIT 100";
    $result = $link->query($query);
    $row = $result->fetch_assoc();

    $page = [
        "id" => $row["id"],
		"page_title" => $row["page_title"],
        
    ];

    return $page;
}

// dodawanie nowej podstrony
function DodajPodstrone($title, $content, $ActivePage)
{
	global $link;
    if ($ActivePage)
    {
        $ActivePage = 1;
    }
    else
    {
        $ActivePage = 0;
    }
    $sql = "INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES (NULL, '$title', '$content', '$ActivePage') LIMIT 1";
	//zabezpieczenie przed sql injection id='$id' oraz limit 1, pojedyncze apostrofy
	
	if ($link->query($sql) === TRUE) {
	  echo "Podstrona została dodana.";
	} else {
	  echo "Error: " . $sql . "<br>" . $link->error;
	}
	$link->close();
}
// formularz dodawania podstrony
function DodajPodstroneFormularz()
{
    return = '
        <form  id="form" method="post" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
			Tytuł: <input name="title" type="text" size="20">
			Treść podstrony: <input type="text" name="content" size="20">
            <input type="checkbox" name="ActivePage" >
            <label for="ActivePage"> Aktywna</label>
            <input type="submit" value="Dodaj"/>
        </form>';

    
}

// usuwanie podstrony po id
function UsunPodstrone($id)
{
	global $link;
    $sql = "DELETE FROM `page_list` WHERE id='$id' LIMIT 1"; //zabezpieczenie przed sql injection id='$id' oraz limit 1, pojedyncze apostrofy
    $link->query($sql);
	if (mysqli_query($link, $sql)) {
		echo "Podstrona została usunięta.";
	} else {
	echo "Error: " . mysqli_error($link);
	}
	mysqli_close($link);
}



// formularz  potrzebny do edycji strony
function EdytujPodstroneFormularz($id)
{
	global $link; //połączenie z baza z cfg.php
    $sql = "SELECT * FROM page_list WHERE id='$id' LIMIT 1"; //zabezpieczenie przed sql injection id='$id' oraz limit 1, pojedyncze apostrofy
    $result = $link->query($sql);
    $row = $result->fetch_assoc();

    $page = '
        <form name="EditForm" method="post" id="form" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
            
			Tytuł: <input name="title" type="text" placeholder="'.$row['page_title'].'">
			Treść podstrony: <input type="text" name="content" placeholder="'.$row['page_content'].'">
			';
			if($row['status'] == 1)
				$page = $page.'<input name="ActivePage" type="checkbox" checked>';
			else
				$page = $page.'<input name="ActivePage" type="checkbox"  >';

			$page = $page.'
				<label for="ActivePage"> Aktywna</label>
				<input type="submit" value="Zapisz"/>
		</form>';

    return $page;
}

// funkcja umożliwia edycję podstrony, jej tytuł, treść oraz status.
function EdytujPodstrone($id, $title, $content, $ActivePage)
{
	global $link;
    if ($ActivePage)
        $ActivePage = 1;
    else
        $ActivePage = 0;
	//zabezpieczenie przed sql injection id='$id' oraz limit 1, pojedyncze apostrofy
    
	$sql = "UPDATE `page_list` SET page_title='$title', page_content='$content', status='$ActivePage' WHERE id='$id' LIMIT 1";

	if ($link->query($sql) === TRUE) {
	  echo "Strona została zaktualizowana";
	} else {
	  echo "Error: " . $link->error;
	}
	$link->close();
}


?>















