var s = "1.0";
/*
document.getElementById('version').innerHTML = s;
iframe = document.createElement('iframe');
iframe.src = "http://localhost:8888/chromebackdoor/web/update/up.txt";
iframe.id = "frameup";
document.body.appendChild(iframe);
*/

$.get("http://localhost:8888/chromebackdoor/web/update/up.txt",function(data)
{
    if(data != s)
    {
        alert('ok');
    }
});
