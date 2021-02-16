<?php 
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	require_once('./cfg.php');
	if($_GET['page'] == 'cfg') $cfg = 'cfg.php';	
	include 'admin/admin.php';
	include 'showpage.php';
	include 'contact.php';
	if(file_exists($cfg)) include($cfg); //else echo "404! Strona nie istnieje! 
	if(file_exists($admin)) include($admin); //else echo "404! Strona nie istnieje! /n";
	
?>
<!DOCTYPE HTML>

<html lang="pl">
<head>
	<meta charset="utf-8 /">
	<title>Największe budynki świata</title>
	<meta name="Author" content="Marta Skwarska" />

	<meta name="keywords" content="budynki, najwyższe budynki świata, największe budynki, top budynki">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link href='css/styl.css' rel='stylesheet' type='text/css' />
	<link href='fontello/css/fontello.css' rel='stylesheet' type='text/css' />
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato&display=swap" rel="stylesheet">
	<script type="text/javascript" src="js/kolorujtlo.js"></script>
	<script type="text/javascript" src="js/timedate.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
</head>

<body onload="startlock()" >

	<?php
	switch ($_GET['page']) 
	{
		case '':
			$subpage = PokazPodstrone(1);
			$page = $subpage["page_content"];
			
		case 'index':
			$subpage = PokazPodstrone(4);
			$page = $subpage["page_content"];
			break;
			
		case 'filmy':
			$subpage = PokazPodstrone(2);
			$page = $subpage["page_content"];
			break;
			
		case 'galeria':
			$subpage = PokazPodstrone(3);
			$page = $subpage["page_content"];
			break;
			
		case 'glowna':
			$subpage = PokazPodstrone(4);
			$page = $subpage["page_content"];
			break;

		case 'historiaWiezowcow':
			$subpage = PokazPodstrone(5);
			$page = $subpage["page_content"];
			break;
			
		case 'kontakt':
			$subpage = PokazPodstrone(6);
			$page = $subpage["page_content"];
			break;
			
		case 'spis':
			$subpage = PokazPodstrone(7);
			$page = $subpage["page_content"];
			break;
			
		case 'admin':
			$subpage = FormularzLogowania();
			$page = $subpage;
			break;
			
		case 'admin/wypiszPodstrony':
            $subpage = WypiszStrony();
            $page = $subpage;
            break;
		
		
		 case 'admin/podstrony/dodaj':
            $subpage = DodajPodstroneFormularz();
            $page = $subpage;
            break;

        case 'admin/podstrony/usun':
            $id = $_GET['id'];
            $subpage = UsunPodstrone($id)
            $page = $subpage;
            break;
		
		case 'admin/podstrony/edytuj':
            $id = $_GET['id'];
            $subpage = EdytujPodstroneFormularz($id);
            $page = $subpage;
            break;  
		
		case 'kontakt':
            $subpage = PokazKontakt();
            $page = $subpage;
            break;

        case 'kontakt/wyslij':
            $subpage = PokazPodstrone(7);
            $page = $subpage["page_content"];
            break;

        case 'przypomnijHaslo':
            $subpage = PrzypomnijHasloFormularz();
            $page = $subpage;
            break;
          
		
		default:
			$subpage = PokazPodstrone(4);
			$page = $subpage["page_content"];
			break;
	}
	echo $page;
	?>
	
	<div id="container">
		<div class="rectangle"></div>
			<div id="zegar"></div>
			<div id="data"></div>
		<div class="square">
			<div class="tile1">
				<a href="?page=historiaWiezowcow" class="tilelink">
				<i class="icon-doc"></i><br />Historia ewoluowania wieżowców</a>
			</div>
			<div class="tile1">
				<a href="?page=galeria" class="tilelink">  
				<i class="icon-picture"></i><br />Galeria</a>
			</div>
			<div style="clear: both;"></div>
			
			<div class="tile2">
				<a href="?page=kontakt" class="tilelink">
				<i class="icon-mail-1"></i><br />Kontakt</a>
			</div>
			<div class="tile2">
				<a href="?page=spis" class="tilelink">
				<i class=" icon-align-center"></i><br />Spis</a>
			</div>
			<div style="clear: both;"></div>
			
			<div class="tile2">
				<a href="?page=filmy" class="tilelink">
				<i class="icon-picture"></i><br />Filmy</a>

			</div>
			<div style="clear: both;"></div>
			
			<div class="tile3">
				<a href="?page=glowna" class="tilelink">
				<i class="icon-menu-outline"></i><br />Menu/HOME</a>
			</div>
		</div>
		
		<div class="square"></div>
		<div style="clear: both;"></div>
						
	</div>
	

<?php
	$nr_indeksu = '150536';
	$nrGrupy = '5';
	echo ' Numer indeksu '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
?>

	<footer>
	<p> 2020 &copy; Marta Skwarska  <br>
	</footer>
</body>
</html>
