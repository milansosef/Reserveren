<?php
require_once 'includes/database.php';

if(isset($_POST['submit'])) {
    //Alle gebruikersinput wordt gecontroleerd op speciale tekens
    $voornaam = mysqli_real_escape_string($db, $_POST['voornaam']);
    $achternaam = mysqli_real_escape_string($db, $_POST['achternaam']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $telefoonnummer = mysqli_real_escape_string($db, $_POST['telefoonnummer']);
    $datum = mysqli_real_escape_string($db, $_POST['datum']);
    $straat = mysqli_real_escape_string($db, $_POST['straat']);
    $postcode = mysqli_real_escape_string($db, $_POST['postcode']);

    if(isset($_POST['tijd'])) {
        $tijd = implode(",", $_POST['tijd']);
    } else {
        $tijd = "";
    }

    $errors = [];
    $succes = "";

    if ($voornaam == '') {
        $errors[] = 'Voornaam mag niet leeg zijn.';
    }

    if ($achternaam == '') {
        $errors[] = 'Achternaam mag niet leeg zijn.';
    }

    if ($email == '') {
        $errors[] = 'E-mail mag niet leeg zijn.';
    }

    if ($telefoonnummer == '') {
        $errors[] = 'Telefoonnummer mag niet leeg zijn.';
    }

    if ($straat == '') {
        $errors[] = 'Straat en huisnummer mag niet leeg zijn.';
    }

    if ($postcode == '') {
        $errors[] = 'Postcode mag niet leeg zijn.';
    }

    if ($datum == '') {
        $errors[] = 'Er is nog geen datum gekozen';
    }

    if ($tijd == '') {
        $errors[] = 'Er is nog geen tijd gekozen';
    }

    //De data wordt in de database geplaatst
    if (empty($errors)) {
        $query = "INSERT INTO appointment(voornaam, achternaam, email, telefoonnummer, datum, tijd, straat, postcode) 
                  values (
                    '$voornaam',   
                    '$achternaam',
                    '$email',
                    '$telefoonnummer',
                    '$datum',
                    '$tijd',
                    '$straat',
                    '$postcode'
                  )";

        mysqli_query($db, $query);

//        $lastId = mysqli_insert_id($db);
//
//        $query = "INSERT INTO appointment_tijden (appointment_id, tijden_id)
//                  values (
//                    '$lastId',
//                    '$hours_id'
//                  )";
//
//        mysqli_query($db, $query);

        //Onderstaande code is voor het versturen van een bevestigingsmail
        $to        = $email;
        $subject   = 'Uw reservering';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        $message = "Geachte heer/mevrouw,<br><br>

Middels deze email bevestigen we graag uw reservering voor de coachkamer bij de Zuster aan de Gasthuisplaats 1 in Delft op $datum 
van (tijd) tot (tijd).
<br><br>

<b>Sleutel ophalen</b><br>
In het pand geen receptie aanwezig. U kunt de sleutel afhalen in het nabij gelegen hotel Leeuwenbrug aan de Koornmarkt 16 te Delft 
(tel. 015 2147 741). Het hotel bevindt zich naast de synagoge die ligt aan het parkeerterrein bij Gebouw De Zuster. Als u op de parkeerplaats 
bent, loopt u naar de poort (naast het gebouw), richting de gracht, door de poort gaat u naar rechts, daar ziet u het hotel aan uw rechterhand.
Komt u van het station, dan ziet u het hotel links liggen van De Zuster. Bij het hotel kunt u bij de receptie vragen om de sleutel van de 
coachkamer van Aletta Wubben mens- en organisatieontwikkeling, de receptioniste is op de hoogte van uw komst.<br><br>
 
<b>De ruimte</b><br>
De coachkamer bevindt zich in gebouw de Zuster op de 1ste etage, kamer 1.10 (gang rechts, aan de rechterhand).<br>
Aan de binnenzijde van de deur vindt u de wifi code, in de ruimte is gelegenheid om koffie en thee te zetten.<br>
Aan het einde van de gang links vindt u een grote keuken waar u tevens gebruik van mag maken en de vaat kunt doen.<br><br>
 
<b>Uw klanten binnen laten</b><br>
Uw klanten kunnen gebruik maken van de intercom, in de coachkamer vindt u een mobiele telefoon welke doorgeschakeld is naar de intercom. 
Als uw klant aanbelt bij de intercom waarop Deskbookers vermeld staat dan gaat deze telefoon over in de coachkamer. U kunt opnemen en het 
cijfer 3 intoetsen. De deur van de hoofdingang gaat dan open.<br><br>
 
<b>Betaling van de reservering</b><br>
Tevens is bijgesloten de factuur. Ik verzoek u vriendelijk om deze factuur binnen 10 dagen te voldoen op bankrekening NL32 INGB 0004526434, ten name van Aletta Wubben, Mens- en organisatieontwikkeling, onder vermelding van factuurnummer Z….<br><br>

<b>Annulering</b><br>
Wilt u de reservering annuleren? Geen probleem. U kunt tot 48 uur tevoren kosteloos annuleren door een mail te sturen naar office@alettawubben.nl, 
onder vermelding van uw naam, bank- en gironummer. U ontvangt dan een creditnota en terugbetaling van het huurbedrag.<br><br>
 
Bij vragen of problemen kunt u bellen met Petra Wiesnekker 06-20832609.<br><br>
 
Hopende u hiermee voldoende te hebben ge&iuml;nformeerd.<br><br><br><br>
 
 
 
Met vriendelijke groet,<br><br>
 
Petra Wiesnekker<br>
Office manager";

        if(mail($to, $subject, $message, implode("\r\n", $headers))){
            $succes = 'Uw boeking is voltooid. Er is een bevestigingsmail verstuurd naar het door u opgegeven e-mailadres.';
        }
    }
}

?>


