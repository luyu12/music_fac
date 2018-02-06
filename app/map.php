<?php

?>

<!--AIzaSyCxRVG8FmQadGSp9wTg9YDVvzfF7-A5xpo-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wifth-device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=dege">
    <title>My Google Map</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<h3>My Google Maps Demo</h3>
<p><a href="index.php">back to home page</a></p>
<div id="map"></div>
<script>
    function initMap() {
        //Map options
        var uluru = {lat: 40.694204, lng: -73.986579};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: uluru
        });

        //new map

        //add marker
//        var marker = new google.maps.Marker({
//            position: uluru,
//            map: map
//        });
//

  //Array of markers
  var markers=[
      {
          coords: {lat: 40.721803, lng: -74.002258},
          content:'<h1>acne studio</h1>'
      },
      {
          coords:{lat:40.694096, lng:-73.9828205},
          content:'<h1>work </h1>'
      },
      {
          coords:{lat:40.682495, lng:-73.975035},
          content:'<h1>Barcleys center </h1>'
      },
      {
          coords:{lat:40.761433, lng:-73.977622},
          content:'<h1>The MOMA </h1>'
      },
      {
          coords:{lat:40.780514, lng:-73.981085},
          content:'<h1>Beacon Theater </h1>'
      },
      {
          coords:{lat:40.750504, lng:-73.993439},
          content:'<h1>Madison Square Garden </h1>'
      },
      {
          coords:{lat:40.759976, lng:-73.979977},
          content:'<h1>Randio city music hall </h1>'
      },
      {
          coords:{lat:40.779437, lng:-73.963244},
          content:'<h1>The met </h1>'
      },
      {
          coords:{lat:40.769710, lng:-73.992715},
          content:'<h1>Terminal 5</h1>'
      }
  ];

  //Loop through markers
        for(var i=0;i<markers.length;i++)
        {
            addMarker(markers[i]);
        }







//        addMarker({
//            coords:{lat:40.4666, lng:-73.9495},
//            content:'<h1>ocean </h1>'
//        });
////addMarker({coords:{lat:40.4666, lng:-73.9495}});
//        addMarker({coords:{lat:40.694096, lng:-73.9828205}});
//
//        //add marker function
        function addMarker(props) {
            var marker = new google.maps.Marker({
                position: props.coords,
                map: map,
                icon:props.iconImage
            });

            if(props.iconImage){
                //Set icon image
                marker.setIcon(props.iconImage);
            }

            //check content
            if(props.content){
                var infoWindow=new google.maps.InfoWindow({
            content:props.content
        });

        marker.addListener('click',function(){
            infoWindow.open(map,marker);
        });
            }

        }




    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxRVG8FmQadGSp9wTg9YDVvzfF7-A5xpo&callback=initMap">
</script>
</body>
</html>

