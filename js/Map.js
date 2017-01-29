/**
 * Created by Milan on 12-1-2017.
 */
var map;

//Dit zijn instellingen om het uiterlijk van de kaart aan te passen
var styles = [
    {
        stylers: [
            { saturation: -50 },{hue : '#67839f'}
        ]
    },{
        featureType: 'road',
        elementType: 'geometry',
        stylers: [
            { lightness: 100 },
            { visibility: 'simplified' }
        ]
    },{
        featureType: 'road',
        elementType: 'labels',
        stylers: [
            { visibility: 'off' }
        ]
    },{
        featureType: 'administrative.country',
        elementType: 'labels',
        stylers: [
            { visibility: 'off' }
        ]
    },{
        featureType: 'administrative.locality',
        elementType: 'labels',
        stylers: [
            { lightness: 35 },
            { visibility: 'on' }
        ]
    }
];

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        //Dit zijn de coördinaten waar de map op moet inzoomen
        center: {lat: 52.008428, lng: 4.360195},
        zoom: 15,

        scrollwheel: false,

    });
    map.setOptions({styles: styles});

    //Dit is de content van het infoWindow
    var contentString = '<img src=img/gebouw_dezuster.png><Br><Br><a target="_blank" class="btn btn-custom" href="https://www.google.nl/maps/dir//Gasthuisplaats+1,+2611+BN+Delft/@52.0084275,4.3580059,17z/data=!4m16!1m7!3m6!1s0x47c5b5c1bfe4fd31:0x7f60814afa34c80f!2sGasthuisplaats+1,+2611+BN+Delft!3b1!8m2!3d52.0084275!4d4.3601946!4m7!1m0!1m5!1m1!1s0x47c5b5c1bfe4fd31:0x7f60814afa34c80f!2m2!1d4.3601946!2d52.0084275?hl=nl">Bepaal route</a>';

    //De infoWindow wordt gevuld
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    //Hier wordt de positie van de marker bepaald
    var marker = new google.maps.Marker({
        position: {lat: 52.008428, lng: 4.360195},
        map: map,
        icon: 'img/marker.png',
        title: 'Uluru (Ayers Rock)'
    });
    marker.addListener('click', function () {
        infowindow.open(map, marker);
    });

    setTimeout(function(){
        infowindow.open(map, marker);
    },500);



}
initMap();