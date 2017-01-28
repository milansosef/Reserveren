<?php

include_once "includes/header.php";
require_once "controle.php";

$query = "SELECT tijd
          FROM tijden 
          ";

$result = mysqli_query($db, $query);
$tijden = [];

while($row = mysqli_fetch_assoc($result)){
    foreach($row as $tijd){
        $tijden[] = $tijd;
    }
}

?>

<!--src="http://placehold.it/1920x500"-->

<div class="container-fluid hidden-xs">
    <div class="row">
        <div class="col-md-12">
            <img src="img/coachkamer_v2.jpg" class="img-responsive">
        </div>
    </div>
</div>

<div class="container">
    <div class="row content" >
        <div class="col-md-8">
            <h1>Omschrijving</h1>
            <p>
                De sfeervolle lichte coachruimte is voorzien van 2 luxe fauteuils en een aparte spreektafel met
                2 stoelen. Een fijne ruimte in de binnenstad van Delft met voldoende parkeergelegenheid (betaald)
                en dicht bij het station. Ideaal voor 1-op-1 coach gesprekken of kleine meetings.
                <br><br>
                Gebouw De Zuster is een sfeervolle locatie gelegen in de binnenstad van Delft met voldoende
                parkeergelegenheid (betaald). Vanaf Station Delft is het slecht vijf minuten lopen naar de Zuster.
            </p>
        </div>

        <div class="col-md-4">
            <h1>Contact</h1>
            <p> Bezoekadres <br>
                <i class="fa fa-building" aria-hidden="true"></i> Gebouw De Zuster <br>
                <i class="fa fa-map-marker" aria-hidden="true"></i> Gasthuisplaats 1, 2611 BN Delft <br>
                1ste etage, rechts <br>

                <i class="fa fa-phone" aria-hidden="true"></i> +31 15 256 99 71 <br>
                <i class="fa fa-envelope" aria-hidden="true"></i> informatie@alettawubben.nl
            </p>
        </div>
    </div>
    <br><br>

<!--    Laad errors als deze zijn aangemaakt (fouten bij invullen formulier).-->
    <?php if(!empty($errors)):?>
        <div class="row">
            <div class="alert alert-warning text-center">
                <?php foreach($errors as $error): ?>
                    <p><?= htmlentities($error) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

<!--    Succes melding wordt geëchood als de boeking is voltooid.-->
    <?php if(!empty($succes)):?>
        <div class="row">
            <div class="alert alert-success text-center">
                    <p><?= htmlentities($succes) ?></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">

            <div class="col-md-6">
                <div class="col-md-12" id="calendarID">
                    <div class="instructie">
                        <h4>1: Selecteer een dag</h4>
                    </div>

                    <!-- Responsive calendar - START -->
                    <div class="responsive-calendar">
                        <div class="controls">
                            <a class="pull-left" data-go="prev"><div class="btn btn-custom">Vorige</div></a>
                            <h4><span data-head-year></span> <span data-head-month></span></h4>
                            <a class="pull-right" data-go="next"><div class="btn btn-custom">Volgende</div></a>
                        </div><hr/>
                        <div class="day-headers">
                            <div class="day header">Ma</div>
                            <div class="day header">Di</div>
                            <div class="day header">Wo</div>
                            <div class="day header">Do</div>
                            <div class="day header">Vr</div>
                            <div class="day header">Za</div>
                            <div class="day header">Zo</div>
                        </div>
                        <div class="days" data-group="days">

                        </div>
                    </div>
                    <br>
                    <!-- Responsive calendar - END -->
                </div>

                <!--Hier worden checkboxes aangemaakt-->
                <div class="col-md-12">
                    <div id="tijden" class="" data-toggle="buttons">
                        <div class="instructie">
                            <h4>2: Selecteer de uren die je wilt boeken</h4>
                        </div>

                        <?php foreach ($tijden as $time => $hour) : ?>
                            <!-- hier moet je checken of er al een boeking is op deze dag op deze tijd -->
                            <!-- zo ja dan tijd grijs tonen , zo nee dan checkbox -->

                            <label id="tijd" class="btn btn-custom">
                                <input id="checkbox" type="checkbox" name="tijd[]" value="<?= htmlentities($hour) ?>" autocomplete="off" onchange="doalert(this)"> <?= htmlentities($hour) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="col-md-12 well">
                    <table class="dopbsp-cart">
                        <tbody>
                            <tr>
                                <th><h3>Reservering</h3></th>
                            </tr>
                            <tr>
                                <td>Tarief: € 12,50 /uur</td>
                            </tr>
                            <tr>
                                <td>Gekozen datum</td>
                                <td id="datum"></td>
                            </tr>
                            <tr>
                                <td>Prijs incl. BTW</td>
                                <td id="prijs">€....</td>
                            </tr>
<!--                            <tr>-->
<!--                                <td>De betaling verloopt per factuur</td>-->
<!--                            </tr>-->
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">

                    <div class="instructie">
                        <h4><span class="nummer">3:</span> Vul je gegevens in</h4>
                    </div>

                    <div>
                        <input class="form-control" id="voornaam" type="text" name="voornaam" placeholder="Voornaam"/> <br>
                    </div>

                    <div>
                        <input class="form-control" id="" type="text" name="achternaam" placeholder="Achternaam" /> </br>
                    </div>

                    <div>
                        <input class="form-control" type="email" name="email" placeholder="E-mailadres" ></br>
                    </div>

                    <div>
                        <input class="form-control" type="tel" name="telefoonnummer" placeholder="Telefoonnummer"></br>
                    </div>

                    <div>
                        <input class="form-control" type="text" name="straat" placeholder="Straatnaam + huisnummer"></br>
                    </div>

                    <div>
                        <input class="form-control" type="tel" name="postcode" placeholder="Postcode"></br>
                    </div>

                    <input id="currentDate" name="datum" type="hidden">

                    <div>
                        <p class="txt">
                            <b>Na voltooiing van de boeking ontvangt u een factuur. U kunt de boeking tot 48 uur voor
                                aanvang kosteloos annuleren door een email te sturen naar office@alettawubben.nl </b>
                        </p>
                        <input class="btn btn-custom" type="submit" name="submit" value="Boeken"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Parkeren</h3>
            <p>Bij de Zuster kan je betaald parkeren op de Gasthuisplaats (€ 3,- per uur) of in de Zuidpoort
                parkeergarage (€ 2,90 per uur).</p>
        </div>
    </div>
</div>
<br><br>

<div class="container-fluid" id="map"> </div>

<div class="admin_link">
    <a href="admin/login.php"><i class="fa fa-cogs fa-lg" aria-hidden="true"></i></a>
</div>


<?php include("includes/footer.php") ?>