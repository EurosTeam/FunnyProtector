import base64,sys,time,binascii,os,re,ctypes,urllib,getpass,json,hashlib,webbrowser
from urllib import request,parse
from ctypes import *
from colorama import init,Fore,Back,Style
from datetime import datetime

kernel32 = ctypes.WinDLL('kernel32')
user32 = ctypes.WinDLL('user32')
SW_MAXIMIZE = 3
init()

def xor(string2encrypt):
	finalstring = ""
	string2encrypt = binascii.hexlify(bytes(string2encrypt,"utf-8"))
	for c in string2encrypt.decode():
		e = ord(c)
		f = e + 10
		finalstring += chr(f)
	return finalstring

def unxor(string2encrypt):
	finalstring = ""
	for c in string2encrypt:
		e = ord(c)
		f = e - 10
		finalstring += chr(f)
	finalstring = finalstring.replace("\x00","")
	finalstring = bytes.fromhex(finalstring)
	return finalstring.decode()

#get string of a given variable
def getstring(string):
	xlen = 0
	x = re.search("(\".*\")", string)
	if x is not None:
		x = x.group()
		xlen = len(x)
		if xlen > 3:
			return x


def returnCipher(code):
	if sys.platform == "win32":
		#if the windows architecture is  32 bits
		if ctypes.sizeof(ctypes.c_voidp)==4:
			mydll=ctypes.CDLL(os.getcwd()+"\\_protector32.dll")
		#if the windows architecture is 64 bits
		elif ctypes.sizeof(ctypes.c_voidp)==8:
			mydll=ctypes.CDLL(os.getcwd()+"\\_protector.dll")
	mydll.Xoring.restype = c_wchar_p
	result = mydll.Xoring(code,"4JT6Qc493H8Zkth6F6Wzyx")
	return result

def StringEncrypt(string):
	if sys.platform == "win32":
		if ctypes.sizeof(ctypes.c_voidp)==4:
			mydll=ctypes.CDLL(os.getcwd()+"\\_protector32.dll")
		elif ctypes.sizeof(ctypes.c_voidp)==8:
			mydll=ctypes.CDLL(os.getcwd()+"\\_protector.dll")
	#set the return type to wchar*
	mydll.StringEncrypt.restype = c_wchar_p
	#get the encrypted result
	result = mydll.StringEncrypt(string)
	return result

def login(user,passwd):
	try:
		time = datetime.utcnow().strftime("%Y-%m-%d %H:%M")
		secretkey = "c7Cf8654UrhLPD4ikQ2zd5q3tHE9P53mZn7zXH4L"
		headers={"Content-Type":"application/json","User-Agent":"Mozilla/5.0 (X11; U; Linux i686) Gecko/20071127 Firefox/2.0.0.11"}
		req = request.Request("http://localhost/loginapi.php?username="+user+"&passwd="+passwd)
		requests = request.urlopen(req)
		response = json.load(requests)
		if response["status"] == "success" and hashlib.sha256(bytes(user + secretkey + time + passwd,"utf-8")).hexdigest() == response["hash"]:
			return True
		else:
			return True
	except KeyError:
		return True


def obfuscation(user):
	os.system("cls")
	#obfu variable
	xorencode = "def EEE3E3E3E3(O0O0O0):\n    Z2ZZZZ2Z2 = ''\n    for A1A1A1A1 in O0O0O0:\n        POPOPOP = ord(A1A1A1A1)\n        O0O0O0O0 = POPOPOP - 10\n        Z2ZZZZ2Z2 += chr(O0O0O0O0)\n        Z2ZZZZ2Z2 = Z2ZZZZ2Z2\n    return binascii.unhexlify(bytes(Z2ZZZZ2Z2,'utf-8')).decode()\n"
	#string encryption
	print(Fore.RED+"""

  █████▒█    ██  ███▄    █  ███▄    █▓██   ██▓ ██▓███   ██▀███   ▒█████  ▄▄▄█████▓▓█████  ▄████▄  ▄▄▄█████▓ ▒█████   ██▀███  
▓██   ▒ ██  ▓██▒ ██ ▀█   █  ██ ▀█   █ ▒██  ██▒▓██░  ██▒▓██ ▒ ██▒▒██▒  ██▒▓  ██▒ ▓▒▓█   ▀ ▒██▀ ▀█  ▓  ██▒ ▓▒▒██▒  ██▒▓██ ▒ ██▒
▒████ ░▓██  ▒██░▓██  ▀█ ██▒▓██  ▀█ ██▒ ▒██ ██░▓██░ ██▓▒▓██ ░▄█ ▒▒██░  ██▒▒ ▓██░ ▒░▒███   ▒▓█    ▄ ▒ ▓██░ ▒░▒██░  ██▒▓██ ░▄█ ▒
░▓█▒  ░▓▓█  ░██░▓██▒  ▐▌██▒▓██▒  ▐▌██▒ ░ ▐██▓░▒██▄█▓▒ ▒▒██▀▀█▄  ▒██   ██░░ ▓██▓ ░ ▒▓█  ▄ ▒▓▓▄ ▄██▒░ ▓██▓ ░ ▒██   ██░▒██▀▀█▄  
░▒█░   ▒▒█████▓ ▒██░   ▓██░▒██░   ▓██░ ░ ██▒▓░▒██▒ ░  ░░██▓ ▒██▒░ ████▓▒░  ▒██▒ ░ ░▒████▒▒ ▓███▀ ░  ▒██▒ ░ ░ ████▓▒░░██▓ ▒██▒
 ▒ ░   ░▒▓▒ ▒ ▒ ░ ▒░   ▒ ▒ ░ ▒░   ▒ ▒   ██▒▒▒ ▒▓▒░ ░  ░░ ▒▓ ░▒▓░░ ▒░▒░▒░   ▒ ░░   ░░ ▒░ ░░ ░▒ ▒  ░  ▒ ░░   ░ ▒░▒░▒░ ░ ▒▓ ░▒▓░
 ░     ░░▒░ ░ ░ ░ ░░   ░ ▒░░ ░░   ░ ▒░▓██ ░▒░ ░▒ ░       ░▒ ░ ▒░  ░ ▒ ▒░     ░     ░ ░  ░  ░  ▒       ░      ░ ▒ ▒░   ░▒ ░ ▒░
 ░ ░    ░░░ ░ ░    ░   ░ ░    ░   ░ ░ ▒ ▒ ░░  ░░         ░░   ░ ░ ░ ░ ▒    ░         ░   ░          ░      ░ ░ ░ ▒    ░░   ░ 
          ░              ░          ░ ░ ░                 ░         ░ ░              ░  ░░ ░                   ░ ░     ░     
                                      ░ ░                                                ░                                   
		Want protection ? Get FunnyProtector.
		\r\n"""+Fore.GREEN)
	print(f"Welcome {user}.")
	file2obfu = input("home@funnyprotector:~/filetoobfuscate$ ")
	toobfu = ""
	filetoobfu = open(file2obfu,"r",encoding="utf-8",errors="ignore")
	for line in filetoobfu:
		if "import" in line and "from" not in line:
			#print(line)
			#add the Cipher function
			line = line.replace("\n","")+",sys,ctypes\nfrom ctypes import *\ndef Cipher(string):\n    if sys.platform == 'win32':\n        if ctypes.sizeof(ctypes.c_voidp)==4:\n           mydll=ctypes.CDLL('FunnyProtector\\\_protector32.dll')\n        elif ctypes.sizeof(ctypes.c_voidp)==8:\n            mydll=ctypes.CDLL('FunnyProtector\\\_protector.dll')\n    mydll.StringEncrypt.restype = c_wchar_p\n    result = mydll.StringEncrypt(string)\n    return result\n"
			#print(line)
		#encrypt the string
		string = getstring(line)
		if string == None or string == "\"utf-8\"" or "\"utf-8\"" in string or "{" in string or "[" in string or ":" in string or "," in string:
			toobfu += line

		if string != None and string != "" and string != "\"utf-8\"" and "{" not in string and "[" not in string and ":" not in string and "," not in string:
			#print(string)
			string2replace = "Cipher(\""+StringEncrypt(string.replace("\"",""))+"\")"
			toobfu += line.replace(string,string2replace)
	filetoobfu.close()

	#create FunnyProtect folder
	os.system("mkdir Protected")
	filename = file2obfu
	filetoobfu_create = open("Protected\\"+os.path.basename(filename),"w").close()
	filename_len = len(os.path.basename(filename))
	path = os.path.abspath(filename[0:-filename_len])
	path = path+"\\"

	os.system("mkdir Protected\\FunnyProtector")
	os.system("copy _protector.dll Protected\\FunnyProtector")
	os.system("copy _protector32.dll Protected\\FunnyProtector")

	#create protector.py
	protector = open("Protected\\FunnyProtector\\protector.py","a")
	protector.write("from ctypes import *\nimport sys,ctypes\nif sys.platform == 'win32':\n    if ctypes.sizeof(ctypes.c_voidp)==4:\n        mydll=ctypes.CDLL('FunnyProtector\\\_protector32.dll')\n    elif ctypes.sizeof(ctypes.c_voidp)==8:\n        mydll=ctypes.CDLL('FunnyProtector\\\_protector.dll')\ndef returnCipher(code,file):\n    mydll.unXoring.restype = c_wchar_p\n    result = mydll.unXoring(code,file)\n    return result")
	protector.close()

	#starting obfuscation
	filetoobfu = open("Protected\\"+os.path.basename(filename),"a")
	#base64 the realcode with junk
	obfuscate = base64.b64encode(bytes(toobfu,"utf-8"))
	#xor the base64 encoded code
	xored_obfuscate = xor(obfuscate.decode())
	print("[Funny Protector] Add obfuscation...")
	final_obfu = returnCipher("import base64,binascii\r\n"+
		xorencode+
		"\r\nexec(base64.b64decode(EEE3E3E3E3('"+xored_obfuscate+"')))")

	filetoobfu.write("from FunnyProtector import protector\nexec(protector.returnCipher('"+final_obfu+"',__file__))")
	filetoobfu.close()
	print("[Funny Protector] Done !")
	input("")

def main():
	hWnd = kernel32.GetConsoleWindow()
	user32.ShowWindow(hWnd,SW_MAXIMIZE)
	os.system("cls")
	try:
		userfile = open("creds.bin","r")
		user = userfile.readlines()
		userfile.close()
		username = unxor(user[0])
		password = unxor(user[1])
		loginresponse = login(username,password)
		if(loginresponse == True):
			obfuscation(username)
		if(loginresponse == False):
			os.system("del creds.bin")
			main()
	except FileNotFoundError:
		print("""

·▄▄▄▄• ▄▌ ▐ ▄  ▐ ▄  ▄· ▄▌ ▄▄▄·▄▄▄        ▄▄▄▄▄▄▄▄ . ▄▄· ▄▄▄▄▄      ▄▄▄  
▐▄▄·█▪██▌•█▌▐█•█▌▐█▐█▪██▌▐█ ▄█▀▄ █·▪     •██  ▀▄.▀·▐█ ▌▪•██  ▪     ▀▄ █·
██▪ █▌▐█▌▐█▐▐▌▐█▐▐▌▐█▌▐█▪ ██▀·▐▀▀▄  ▄█▀▄  ▐█.▪▐▀▀▪▄██ ▄▄ ▐█.▪ ▄█▀▄ ▐▀▀▄ 
██▌.▐█▄█▌██▐█▌██▐█▌ ▐█▀·.▐█▪·•▐█•█▌▐█▌.▐▌ ▐█▌·▐█▄▄▌▐███▌ ▐█▌·▐█▌.▐▌▐█•█▌
▀▀▀  ▀▀▀ ▀▀ █▪▀▀ █▪  ▀ • .▀   .▀  ▀ ▀█▄▀▪ ▀▀▀  ▀▀▀ ·▀▀▀  ▀▀▀  ▀█▄▀▪.▀  ▀

			""")
		print(Fore.GREEN + "[*] FunnyProtector - Private Obfuscator [*]" + Style.RESET_ALL)
		print(Fore.MAGENTA + "[1] Login" + Style.RESET_ALL)
		print(Fore.YELLOW + "[2] Register" + Fore.CYAN)
		choose = input("login@funnyprotector:~$ ")
		if(choose == "1"):
			user = input("login@funnyprotector:~/Username$ ")
			password = getpass.getpass("login@funnyprotector:~/Password$ ")
			if(user != "" and password != ""):
				loginresponse = login(user,password)
				if(loginresponse == True):
					print("login@funnyprotector:~$ ./success.sh")
					time.sleep(2)
					print("Successfully logged...")
					userfile = open("creds.bin","a")
					userfile.write(xor(user)+"\n"+xor(password))
					userfile.close()
					time.sleep(2)
					obfuscation(user)
				if(loginresponse == False):
					print("login@funnyprotector:~$ ./error.sh")
					time.sleep(2)
					print("You're credentials is false or you have been banned.")
					time.sleep(2)
					main()
			else:
				print("[!]Please enter an username and a password [!]")
				time.sleep(2)
				main()
		elif(choose == "2"):
			#webbrowser.open("http://localhost/register.php")
			main()
		else:
			main()

main()