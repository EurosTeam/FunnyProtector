#include <iostream>
#include <Windows.h>
#include <fstream>
#include <string>
#include <direct.h>
#include <thread>
#include <TlHelp32.h>
#include <vector>

#define DLLEXPORT extern "C" __declspec(dllexport)

int key = 1;

DWORD GetProcId(const wchar_t* procName)
{
	DWORD procId = 0;
	HANDLE hSnap = CreateToolhelp32Snapshot(TH32CS_SNAPPROCESS, 0);
	if (hSnap != INVALID_HANDLE_VALUE)
	{
		PROCESSENTRY32 procEntry;
		procEntry.dwSize = sizeof(procEntry);
		//loop through all process
		if (Process32First(hSnap, &procEntry))
		{

			do
			{
				//compare current lopping process name with procName parameters
				if (!_wcsicmp(procEntry.szExeFile, procName))
				{
					procId = procEntry.th32ProcessID;
					break;
				}
			} while (Process32Next(hSnap, &procEntry));
		}
	}
	//close handle and return the procId of the process
	CloseHandle(hSnap);
	return procId;
}

std::string pXor(std::string stringtoencrypt)
{
	int key = 1;
	std::string toEncrypt2 = stringtoencrypt;
	for (int i = 0; i < stringtoencrypt.size(); i++)
	{
		toEncrypt2[i] = stringtoencrypt[i] ^ key;
	}
	return toEncrypt2;
}


void CheckSoft(const wchar_t* proc)
{
	DWORD processId = GetProcId(proc);
	if (processId != NULL) // if the processId is not null that's mean the software is open so exit the script for protecting it.
		exit(0);
}

void AntiReverse(wchar_t* file)
{
	//debugger check
	if (IsDebuggerPresent() == true)
		exit(0);

	//reverse program check
	if (FindWindowA(0, LPCSTR(pXor("y23ecf").c_str()))) //x32dbg
		exit(0);

	if (FindWindowA(0, LPCSTR(pXor("y75ecf").c_str())))// x64dbg
		exit(0);

	CheckSoft(L"ProcessHacker.exe");
	CheckSoft(L"x32dbg.exe");
	CheckSoft(L"x64dbg.exe");
	CheckSoft(L"idaq.exe");
	CheckSoft(L"idaq64.exe");
	CheckSoft(L"cheatengine-x86_64.exe");

	int line = 0;
	int good = 0;
	char data[999999];
	std::ifstream _protector;
	_protector.open(file);
	if (_protector.is_open())
	{
		while (_protector >> data)
		{
			std::string tmp = data;
			if (tmp.find(pXor("qshou")) != std::string::npos) // print
			{
				exit(0);
			}
			if (tmp.find(pXor("rxr/ruentu/vshud")) != std::string::npos) // sys.write
			{
				exit(0);
			}
			if (tmp.find(pXor("rxr/ruedss")) != std::string::npos) //sys thing
			{
				exit(0);
			}
			if (tmp.find(pXor("vshud")) != std::string::npos) //write
			{
				exit(0);
			}
			line++;
		}
		_protector.close();

		//script integrity check
		if (line != 14)
		{
			exit(0);
		}
	}
}

DLLEXPORT wchar_t* unXoring(wchar_t* string2encrypt, wchar_t* file)
{
	std::thread(AntiReverse, file).join();
	wchar_t* toEncrypt2 = string2encrypt;
	size_t len = wcslen(string2encrypt);
	for (int i = 0; i < len; i++)
	{
		toEncrypt2[i] = string2encrypt[i] ^ key;
	}
	return toEncrypt2;
}

DLLEXPORT wchar_t* StringEncrypt(wchar_t* string2encrypt)
{
	char charKey = 'B';
	wchar_t* toEncrypt2 = string2encrypt;
	size_t len = wcslen(string2encrypt);
	for (int i = 0; i < len; i++)
	{
		toEncrypt2[i] = string2encrypt[i] ^ charKey;
	}
	return toEncrypt2;
}

//Xoring algo without the anti reverse thread
DLLEXPORT wchar_t* Xoring(wchar_t* string2encrypt,wchar_t* passwd)
{
	const wchar_t* good = L"4JT6Qc493H8Zkth6F6Wzyx";
	if (wcscmp(passwd,good) == 0)
	{
		wchar_t* toEncrypt2 = string2encrypt;
		size_t len = wcslen(string2encrypt);
		for (int i = 0; i < len; i++)
		{
			toEncrypt2[i] = string2encrypt[i] ^ key;
		}
		return toEncrypt2;
	}
	else
	{
		exit(0);
	}
}