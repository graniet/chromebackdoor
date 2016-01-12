var s = "1.0";
$.get("http://localhost:8888/chromebackdoor/web/update/up.txt",function(data)
{
    if(data != s)
    {
        alert('ok');
    }
});
