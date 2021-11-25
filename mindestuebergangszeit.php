<?php
	$ak_zug_typ = $_POST [ 'ak_zug_typ' ] ;
	$n_aussteiger = $_POST [ 'n_aussteiger' ] ;
	$einsteiger = $_POST [ 'einsteiger' ] ;
	$s_ebene = $_POST [ 's_ebene' ] ;
	$s_rampe_auf = $_POST [ 's_rampe_auf' ] ;
	$s_rampe_ab = $_POST [ 's_rampe_ab' ] ;
	$y = $_POST [ 'y' ] ;
	$uwz_aufzug = $_POST [ 'uwz_aufzug' ] ;
	$n_Fahrtreppen = $_POST [ 'n_Fahrtreppen' ] ;
	$h_Fahrtreppen = $_POST [ 'h_Fahrtreppen' ] ;
	$s_Treppe_auf = $_POST [ 's_Treppe_auf' ] ;
	$s_Treppe_ab = $_POST [ 's_Treppe_ab' ] ;
	$n_einsteiger = $_POST [ 'n_einsteiger' ] ;
	$ab_zug_typ = $_POST [ 'ab_zug_typ' ] ;
	$submit = $_POST [ 'submit' ] ;

echo "<html>" ;
echo "<head>" ;
echo "<title>Mindest&uuml;bergangszeiten</title>" ;
echo "</head>" ;
echo "<body>" ;
if ( ! isset ( $submit ) ) {
	
# Formular anzeigen
	
	echo "<h1>Mindest&uuml;bergangszeiten</h1>" ;
	echo "<form method=\"POST\">" ;
	echo "<table>" ;
	echo "<tr><td>Zugtyp ankommender Zug</td>" ;
	echo "<td><select name=\"ak_zug_typ\"><option value=\"fv\">Fernverkehrszug</option><option value=\"nv_lok\">lokbespanter Nahverkehrszug</option><option value=\"nv_tw_m_ts\">Nahverkehrstriebwagen mit Trittstufen</option><option value=\"nv_tw_o_ts\">Nahverkehrstriebwagen ohne Trittstufen</option></td></tr>" ;
	echo "<tr><td>Anzahl Aussteiger</td>" ;
	echo "<td><input type=\"text\" name=\"n_aussteiger\" value=\"0\"></td></tr>" ;
	echo "<tr><td></td>" ;
	echo "<td><input type=\"radio\" name=\"einsteiger\" value=\"o_eist\" checked>ohne wartende Einsteiger</input><br/>" ;
	echo "<input type=\"radio\" name=\"einsteiger\" value=\"m_eist\">mit wartenden Einsteigern</input></td></tr>" ;
	echo "<tr><td>Gesamtl&auml;nge der ebenen Abschnitte [m]</td>" ;
	echo "<td><input type=\"text\" name=\"s_ebene\" value=\"0\"></td></tr>" ;
	echo "<tr><td>Gesamtl&auml;nge der Rampen (aufw&auml;rts)[m]</td>" ;
	echo "<td><input type=\"text\" name=\"s_rampe_auf\" value=\"0\"></td></tr>" ;
	echo "<tr><td>Gesamtl&auml;nge der Rampen (abw&auml;rts)[m]</td>" ;
	echo "<td><input type=\"text\" name=\"s_rampe_ab\" value=\"0\"></td></tr>" ;
	echo "<tr><td>Rampenneigung [%]</td>" ;
	echo "<td><input type=\"text\" name=\"y\" value=\"0\"></td></tr>" ;
	echo "<tr><td>Zeitdauer f&uuml;r Aufzugsnutzung [s]</td>" ;
	echo "<td><input type=\"text\" name=\"uwz_aufzug\" value=\"0\"></td></tr>" ;
	echo "<tr><td>Anzahl Fahrtreppen</td>" ;
	echo "<td><input type=\"text\" name=\"n_Fahrtreppen\" value=\"0\"></td></tr>" ;
	echo "<tr><td>H&auml;henunterschied der Fahrtreppen [m]</td>" ;
	echo "<td><input type=\"text\" name=\"h_Fahrtreppen\" value=\"0\"></td></tr>" ;
	echo "<tr><td>L&auml;nge der Treppen (aufw&auml;rts) [m]</td>" ;
	echo "<td><input type=\"text\" name=\"s_Treppe_auf\" value=\"0\"></td></tr>" ;
	echo "<tr><td>L&auml;nge der Treppen (abw&auml;rts) [m]</td>" ;
	echo "<td><input type=\"text\" name=\"s_Treppe_ab\" value=\"0\"></td></tr>" ;
	echo "<tr><td>Anzahl Einsteiger</td>" ;
	echo "<td><input type=\"text\" name=\"n_einsteiger\" value=\"0\"></td></tr>" ;
	echo "<tr><td>Zugtyp abfahrender Zug</td>" ;
	echo "<td><select name=\"ab_zug_typ\"><option value=\"fv\">Fernverkehrszug</option><option value=\"nv_lok\">lokbespanter Nahverkehrszug</option><option value=\"nv_tw_m_ts\">Nahverkehrstriebwagen mit Trittstufen</option><option value=\"nv_tw_o_ts\">Nahverkehrstriebwagen ohne Trittstufen</option></td></tr>" ;
	echo "<tr><td></td>" ;
	echo "<td><input type=\"submit\" value=\"submit\" name=\"submit\"></td></tr>" ;
	echo "</table>" ;
	
} else {

# Auswertung

	switch ( $ak_zug_typ ) {
		case "fv" :
			$toz = 10.66 ;
			if ( $einsteiger == "o_eist" ) {
				$auz = $n_aussteiger * 5.20 ;
			} else {
				$auz = $n_aussteiger * 7.87 ;
			}
			break ;
		case "nv_lok" :
			$toz = 7.18 ;
			if ( $einsteiger == "o_eist" ) {
				$auz = $n_aussteiger * 2.33 ;
			} else {
				$auz = $n_aussteiger * 2.08 ;
			}
			break ;
		case "nv_tw_m_ts" :
			$toz = 9.88 ;
			if ( $einsteiger == "o_eist" ) {
				$auz = $n_aussteiger * 2.33 ;
			} else {
				$auz = $n_aussteiger * 2.08 ;
			}
			break ;
		case "nv_tw_o_ts" :
			$toz = 5.11 ;
			if ( $einsteiger == "o_eist" ) {
				$auz = $n_aussteiger * 2.33 ;
			} else {
				$auz = $n_aussteiger * 2.08 ;
			}
			break ;
	}
	
	$uwz_ebene = $s_ebene / 0.95 ;
	$uwz_rampe = $s_rampe_auf / ( ( 1 - y ) * 0.95 ) + $s_rampe_ab / ( ( 1 + y ) * 0.95 ) ;
	$uwz_fahrtreppen = ($h_Fahrtreppen + $n_Fahrtreppen) / 0.38 ;
	$uwz_treppe = $s_Treppe_auf / ( 0.46 * 0.95 ) + $s_Treppe_ab / ( 0.52 * 0.95 ) ;
	$uwz = $uwz_ebene + $uwz_rampe + $uwz_aufzug + $uwz_fahrtreppen + $uwz_treppe ;

	switch ( $ab_zug_typ ) {
		case "fv" :
			$abz = 55.02 ;
			$eiz = 0.2 * $n_einsteiger * 6.12 ;
			break ;
		case "nv_lok" :
			$abz = 27.36 ;
			$eiz = 0.2 * $n_einsteiger * 2.95 ;
			break ;
		case "nv_tw_m_ts" :
			$abz = 20.68 ;
			$eiz = 0.2 * $n_einsteiger * 2.95 ;
			break ;
		case "nv_tw_o_ts" :
			$abz = 13.81 ;
			$eiz = 0.2 * $n_einsteiger * 2.95 ;
			break ;
			
	}
	
	$muz = $toz + $auz + $uwz + $eiz + $abz ;
	
	echo "<h1>Mindest&uuml;bergangszeiten</h1>" ;
	echo "<table>" ;
	echo "<tr><td>T&uuml;r&ouml;ffnungszeit</td><td>" . number_format ( $toz , 2 , ',' , '.' ) . " s</td></tr>" ;
	echo "<tr><td>Ausstiegszeit</td><td>" . number_format ( $auz , 2 , ',' , '.' ) . " s</td></tr>" ;
	echo "<tr><td>Umsteigewegezeit</td><td>" . number_format ( $uwz , 2 , ',' , '.' ) . " s</td></tr>" ;
	echo "<tr><td>Einstiegszeit</td><td>" . number_format ( $eiz , 2 , ',' , '.' ) . " s</td></tr>" ;
	echo "<tr><td>Abfertigungszeit</td><td>" . number_format ( $abz , 2 , ',' , '.' ) . " s</td></tr>" ;
	echo "<tr><td>Mindest&uuml;bergangszeit</td><td>" . number_format ( $muz , 2 , ',' , '.' ) . " s</td></tr>" ;
	echo "<tr><td>=</td><td>" . number_format ( ceil ( $muz / 6 ) / 10 , 1 , ',' , '.' ) . " min</td></tr>" ;	
	echo "</table>" ;
	echo "<a href=\"mindestuebergangszeit.php\">zur Eingabemaske</a>" ; 
	
}
echo "</body>" ;
echo "</html>" ;
?>