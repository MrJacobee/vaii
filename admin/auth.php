<?php
/*
 *
 *	poznámka odomňa mne:
 *	Nezabudni prosím ťa všetko pomenovať a okomentovať ako normálny človek,
 *	nech to nevyzerá, že máš nejakú poruchu,
 *	pred tým, ako to odovzdáš vo finálnej podobe ako hotovú semestrálku.
 *	- Jakub Kramár to future Jakub Kramár
 *	- 24.11.2020 - 01:53
 *
 */
require 'cfg.php';
$db = $conn;
//chybové správičky
$unmErr=$pwdErr='';
//ak sú valídne, švahne true
$unmValid=$pwdValid=false;

extract($_POST);

if(isset($_POST['submit'])){
	$validneMeno="/^[a-zA-Z ]*$/";
	//skontroluje meno, či je valídne a tak
	if(empty($unm)){
		$unmErr="Meno je povinné!";
	}
	else if (!preg_match($validneMeno, $unm)){
		$unmErr="Nesprávne zadané meno";
	}
	else {
		$unmErr=1;
		$unmValid=true;
	}
	//skúsi či je heslo vpísané
	if(empty($pwd)){
		$pwdErr="Heslo je povinné!";
	}
	else {
		$pwdErr=1;
		$pwdValid=true;
	}
	
	if($unmValid==1 && $pwdValid==1){
		$meno = filter_input(INPUT_POST, 'unm');
		$heslo = filter_input(INPUT_POST, 'pwd');
		$heslo = md5($heslo);
		$prihlasit = login($meno,$heslo);
		var_dump($prihlasit);
	}
	
}

function login($meno,$heslo){
	global $db;
	echo "pred query";
	//si skontrolujem napred, že či takô meno vôbec je v db. Jak nie, tak nech ťahá preč
	$menoSQL="SELECT usnm FROM admin WHERE usnm= ?"; //no, toto by som si mohol zapamätať kým budem doku robiť, že ťahám meno z tabuľke
	$menoQuery = $db->prepare($menoSQL);
	$menoQuery->bind_param('s',$meno);
	$menoQuery->execute();
	$exec=$menoQuery->get_result();
	echo "prvy rresult";
	//buď zafunguje alebo to prdne
	if($exec){
		echo "prva podmienka";
		//tak jak je, ide sa ďalej, jak ňe, nah ťahá preč
		if($exec->num_rows>0){
			echo "prva podmienka presla";
			//tož zafungovalo aj meno je good, tak skúsime aj či meno s heslom sedí
			$prihlasajacaSQL="SELECT usnm, pwd FROM admin WHERE usnm=? AND pwd=?"; //aj toto by som si mohol zapamätať čo má byť
			$prihlasajacaQuery = $db->prepare($prihlasajacaSQL);
			$prihlasajacaQuery->bind_param('ss',$meno,$heslo);
			$prihlasajacaQuery->execute();
			$jetotamQuery=$prihlasajacaQuery->get_result();
			echo "druhy result";
			//zas to isté čo aj vyššie, to si zapamätám (ak nie, tento koment mi to aj tak pripomenie)
			if($jetotamQuery){
				echo "druha podmienka presla";
				if($jetotamQuery->num_rows>0){
					echo "pred headerom";
					session_start();
					$_SESSION['usrnm']=$meno;
					header("Location: https://uni.kramar.im/admin/index.php");
					echo "<h1>ECHO</h1>";
				}
				else{
					echo "zlé heslo";
					return "Zlé heslo more!";
				}
			}
			else {
				echo "error 2";
				return $db->error;
			}
		}
		
		else {
			echo "zlé meno";
			return "Také meno neni v DB, ťahaj preč!";
		}
	}
	else {
		echo "error 1";
		return $db->error;
	}
}
?>