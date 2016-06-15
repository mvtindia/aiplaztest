$(document).ready(function(){
//var inday = new Array(5);
var myurl=window.location.href;
        var check1=myurl.indexOf('index.php') > -1;
        var check3=myurl.indexOf('searchlst') > -1;
              if(check1==true || check3==true){
                $('#autocomplete').blur(function(){

                //$('#my-address').val();
                codeAddress();
              });

                function codeAddress() {
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById("autocomplete").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        $('#autocomplete').focus();
        lt=results[0].geometry.location.lat();
        ln=results[0].geometry.location.lng();
        $('#my-lat').val(lt);
        $('#my-lng').val(ln);
      } 

      else {
        // alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }

                }//if check1



        var check=myurl.indexOf('searchlst') > -1;
        var inday;
              if(check==true){
                var marker_addresses=$('#marker_addresses').val();
                var marker_location=$('#marker_location').val();
                var nloc=marker_location.split(">>>");
                var nadd=marker_addresses.split(">>>");
                inday = new Array(nadd.length);
                locationsarrayvalue = new Array(nadd.length);
                for (var i = 0,j=0; i < nadd.length; i++,j++) {
                  nadd[j]= nadd[j].replace(/,/g, "");
                  inday[i] = [nloc[i],nadd[j],'loc'];
                }  
              }
              
var locations = inday;





var lt1=$('#mylat').val()//30.9007;
var ln1=$('#mylng').val();
/*========================Map JS=============================*/
function initialize() {
  var mapProp = {
     center:new google.maps.LatLng(lt1,ln1),//,
    zoom:5,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);
var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize() {
  map = new google.maps.Map(
    document.getElementById("map_canvas"), {
   center: new google.maps.LatLng(lt1,ln1),
      zoom: 10,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  geocoder = new google.maps.Geocoder();
  
  for (i = 0; i < locations.length; i++) {


    geocodeAddress(locations, i);
  }
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
  var title = locations[i][0];
  var address = locations[i][1];
  var url = locations[i][2];
  geocoder.geocode({
      'address': locations[i][1]
    },

    function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
     //   alert("Latitude: "+results[0].geometry.location.lat());
     // alert("Longitude: "+results[0].geometry.location.lng());
        var marker = new google.maps.Marker({
          icon: 'img/flag.png',
          map: map,
          position: results[0].geometry.location,
          title: title,
          animation: google.maps.Animation.DROP,
          address: address,
          url: url
        })
        infoWindow(marker, map, title, address, url);
        bounds.extend(marker.getPosition());
        map.fitBounds(bounds);
      } else {
        // alert("geocode of " + address + " failed:" + status);
      }
    });
}

function infoWindow(marker, map, title, address, url) {
  google.maps.event.addListener(marker, 'click', function() {
    var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a href='" + url + "'>View location</a></p>";
    iw = new google.maps.InfoWindow({
      content: html,
      maxWidth: 350
    });
    iw.open(map, marker);
  });
}

function createMarker(results) {
  var marker = new google.maps.Marker({
    icon: 'img/flag.png',
    map: map,
    position: results[0].geometry.location,
    title: title,
    animation: google.maps.Animation.DROP,
    address: address,
    url: url
  })
  bounds.extend(marker.getPosition());
  map.fitBounds(bounds);
  infoWindow(marker, map, title, address, url);
  return marker;
}
}); // document brackets close
 

 
