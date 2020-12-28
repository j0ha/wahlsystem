<?php

//Überprüfung: Wahl aktiv?
$sql = "SELECT einstellungs_int FROM einstellungen WHERE einstellungs_id = 1";
$result = $conn->query( $sql );

if ($result->num_rows == 1) {
    while ( $row = $result->fetch_assoc() ) {
        if ( $row[ 'einstellungs_int' ] == 1 ) {
            //Aktive Klassen werden abgefragt und dann ihre Jahrgänge aufgelistet
            $sql = "SELECT DISTINCT jahrgang.jahrgang_jahrgang, jahrgang.jahrgangs_id FROM jahrgang, klassen WHERE klassen.klassen_altiv = 1 AND klassen.klassen_jahrgangsId = jahrgang.jahrgangs_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0 ) {
                echo("<div class='jahrgang_content'><div class='jahrgang_content_header'><div class='headerBig'>In welchem Jahrgang bist du?</div></div><div class='jahrgang_content_flexbox'>" );
                while ($row = $result->fetch_assoc() ) {
                  echo("<form action='https://johannesschur.com/vote/klasse.php' class='jahrgang_content_flexbox_form' method='post'>
                  <input type='hidden' name='jahrgangs_id' value='" . $row[ 'jahrgangs_id' ] . "'>
                  <input class='jahrgang_content_flexbox_form_button' type='submit' value='" . $row[ 'jahrgang_jahrgang' ] . "'>
                  </form>" );
                }
                echo( "</div></div>" );
            } else {
                echo "Kein Jahrgang aktiv!";
            }
        } else if ($row[ 'einstellungs_int' ] == 0) {
            echo("<div class='headerBox'>
              <span class='headerBig'>Die Wahl ist im Moment nicht aktiv</span><br>
              <span class='headerSmall'>Versuch es später noch einmal!</span>
              </div>");
        } else {
            echo("Error: einstellungs_id != 0 oder 1 ");
        }
    }
}
$conn->close();
?>
