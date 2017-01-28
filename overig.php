<!--Alle probeersels die niet werkten-->

<?php
                  $hours_id = [
                            '1',
                            '2',
                            '3',
                            '4',
                            '5',
                            '6',
                            '7',
                            '8',
                            '9',
                            '10',
                            '11',
                            '12',
                            '13',
                    ];

//Geprobeerd om de tijden de database anders in te delen, niet verder mee gekomen.
$query = "SELECT id
FROM tijden
";

$result = mysqli_query($db, $query);
$tijden_id = [];

while($row = mysqli_fetch_assoc($result)){
foreach($row as $id){
$tijden_id[] = $id;
}
}
?>

<?php foreach ($tijden_id as $tijd_id) : echo "$tijd_id"; endforeach; ?>

<script>
    // Maak een array met de tijden van 09:00 tot 21:00
    var hours = ["09:00 - 10:00", "10:00 - 11:00", "11:00 - 12:00", "12:00 - 13:00", "13:00 - 14:00", "14:00 - 15:00", "15:00 - 16:00", "16:00 - 17:00", "17:00 - 18:00", "18:00 - 19:00", "19:00 - 20:00", "20:00 - 21:00"];


    for (var i = 0; i < 12; i++) {
        var btn = document.createElement("button");
        // Vul de tijden in de buttons d.m.v. een array wat text aanmaakt
        var t = document.createTextNode(hours[i]);
        // Append de tekst aan elke individuele button
        btn.appendChild(t);
        // Append al je buttons aan de body
        document.getElementById("calendarID").appendChild(btn).classList.add("btn", "btn-primary", "col-md-12");
    }
    else
    {
        window.location = "/Reserveren/controle.php?datum=" +dag +"-"+  maand +"-"+ jaar;
    }
</script>

<script>
    $('#input[type="checkbox"]').click(function(){

        console.log('check');
    })

    var aantalChecked = document.querySelectorAll('btn-next.active').length;

    console.log(aantalChecked);

    if (!(aantalChecked == 0)) {
        var prijs = '€' + 12.50 * aantalChecked;
    }
    else {
        var prijs = '€....';
    }

    document.getElementById("prijs").innerHTML = prijs;
</script>




