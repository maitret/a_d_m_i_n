
var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}


var Usuario_SS = localStorage.getItem('usuario');
var myUuid = localStorage.getItem('key');
if (!myUuid) {
myUuid = guid();
localStorage.setItem('key', myUuid);
}

if (!Usuario){ Usuario = "Invitado"; }

var firebase_app = "<?php echo $firebase_app; ?>"; 
var config_adminpanel_fb = {
apiKey: "<?php echo $firebase_apiKey; ?>",
authDomain: firebase_app+".firebaseapp.com",
databaseURL: "https://"+firebase_app+".firebaseio.com",
storageBucket: firebase_app+".appspot.com",
messagingSenderId: "<?php echo $firebase_messagingSenderId; ?>" 
};
var AdminPanel_FB = firebase.initializeApp(config_adminpanel_fb);
var storage_FB = firebase.storage();
var storageRef_FB = storage_FB.ref();

jQuery(document).ready(function($) {
//var user_lat; var user_lon;
var startPos;

if (navigator.geolocation) {
//navigator.geolocation.getCurrentPosition(function(position) {
//window.startPos = position;

navigator.geolocation.watchPosition(function(position) {

AdminPanel_FB.database().ref('/users').child(Usuario).update({
lat: position.coords.latitude,
lon: position.coords.longitude,
altitud: position.coords.altitude,
geo_aprox: position.coords.accuracy,
last_geo: position.timestamp,
usuario: Usuario,
user_agent: user_agent,
session_id: session_id,
ip: ip
});

var Lat = position.coords.latitude;
var Lon = position.coords.longitude;
window.lat_global = Lat;
window.lon_global = Lon;

if(Lat != ""){ window.localStorage.setItem("User_Lat", Lat); }
if(Lon != ""){ window.localStorage.setItem("User_Lon", Lon); }
window.localStorage.setItem("Geo_Aprox", position.coords.accuracy);

$("#User_Lat").val(Lat);
$("#User_Lon").val(Lon);
$(".User_Lat").val(Lat);
$(".User_Lon").val(Lon);
$(".User_LatLon_print").html(Lat+","+Lon);
$(".User_Lat_print").html(Lat);
$(".User_Lon_print").html(Lon);
/*
AdminPanel_FB.database().ref('/users').child(Usuario).update({
lat: position.coords.latitude,
lon: position.coords.longitude,
altitud: position.coords.altitude,
geo_aprox: position.coords.accuracy,
last_geo: position.timestamp
});
*/
});
//}, function(error) {
//alert('Error occurred. Error code: ' + error.code);
    // error.code can be:
    //   0: unknown error
    //   1: permission denied
    //   2: position unavailable (error response from locaton provider)
    //   3: timed out
//alert(JSON.stringify(error));
//});

/*
//navigator.geolocation.watchPosition(showPosition);
navigator.geolocation.getCurrentPosition(showPosition);
function showPosition(position) {
}
} else {
//alert("Geolicalizacion no soportada.");
}
*/
}
});

jQuery(document).ready(function($){
window.enable_geocomplete = function enable_geocomplete(target, default_loc, map) {
if(target){ } else { target = ".Direccion"; }
if(default_loc){  } else { default_loc = ""; }
if(map){
$(target).geocomplete({
map: map,
mapOptions: { scrollwheel: true },
markerOptions: { draggable: true, title: "Defina punto exacto" },
details: "form",
location: default_loc,
types: ["geocode", "establishment"],
detailsAttribute: "data-geo"
});
} else {
$(target).geocomplete({
details: "form",
location: default_loc,
types: ["geocode", "establishment"],
detailsAttribute: "data-geo"
});
}

$(target).bind("geocode:dragged", function(event, latLng){
$("input[name=Lat]").val(latLng.lat());
$("input[name=Lon]").val(latLng.lng());
});
//$("#reset").click(function(){ $(target).geocomplete("resetMarker"); $("#reset").hide(); return false; });
};
});