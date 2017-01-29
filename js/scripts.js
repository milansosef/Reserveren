$(document).ready(function(){

    initCalendar();

    $("#tijden").css("display","none");
    $(".responsive-calendar .day").click(function(){
        $("#tijden").css("display","block");
    });
});

//Deze functie wordt uitgevoerd als de kalendar geïnitialiseerd word.
function initCalendar(){

    var tijden = document.getElementById("tijden");
    var datum = document.getElementById("datum");
    var currentDate = document.getElementById("currentDate");

    //Slaat de huidige datum op in een variabele
    var huidigedatum = new Date();
    var dd = huidigedatum.getDate();
    var mm = huidigedatum.getMonth()+1; //Jannuari is 0!
    var yyyy = huidigedatum.getFullYear();

    //Als een dag kleiner is dan 10, zet er een 0 voor
    if(dd<10) {
        dd='0'+dd
    }

    //Als een maand kleiner is dan 10, zet er een 0 voor
    if(mm<10) {
        mm='0'+mm
    }

    huidigedatum = ''  + yyyy + mm + dd;
    var datumNu = yyyy + '-' + mm + '-' + dd;

    var events = {
        "2013-12-26": {"number": 1, "url": "http://w3widgets.com"},
        "2013-05-03": {"number": 1},
        "2013-06-12": {}
    };
    events[datumNu] = {};

    $(".responsive-calendar").responsiveCalendar({

        minDate: new Date(),

        //Word uitgevoerd als er op een dag geklikt word.
        onDayClick: function(events) {

            //Als andere dag wordt aangeklikt, reset alle chechboxes die disabled waren
            $("#tijd input").parent().removeClass('disabled');

            //Checkboxes met id tijden komen tevoorschijn
            tijden.style.display = "block";

            //this refereerd naar de dag die je aanklikt
            console.log(this);

            var dagClick = $(this).data("day");
            var maandClick = $(this).data("month");
            var jaarClick = $(this).data("year");

            //Als een dag of maand kleiner is dan 10, zet er een 0 voor
            if(dagClick < 10){
                dagClick = '0' + dagClick;
            }

            if(maandClick < 10){
                maandClick = '0' + maandClick;
            }

            //Een datum staat opgeslagen in de database als 'DD-MM-yy'
            var dateAjax = jaarClick + '-' + maandClick + '-' + dagClick;
            var datumClick = '' + jaarClick + maandClick + dagClick;

            //Als de datum waar je op klikt eerder is dan de huidige datum: alert!
            if (parseInt(datumClick) < parseInt(huidigedatum)){
                alert('Geen datum in het verleden kiezen');
            }

            datum.innerHTML = dateAjax;
            currentDate.value = dateAjax;

            //Haal de json data op uit tijen_check (=array)
            $.get("tijden_check.php?date=" + dateAjax, function (data) {

                //Voor elk item in de array, voor een functie uit
                $.each(data, function(index, time){

                    //Als json tijd gelijk is aan de tijd van een input field, maak dat input field disabled
                    $("#tijd input[value='"+time+"']").parent().addClass('disabled');
                });
            });
        },
        events: events
    });
};