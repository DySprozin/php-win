#include <iostream>
#include <windows.h>

using namespace std;

int main() {
	
 HWND hWnd;
 char buffer[1024];
 hWnd = FindWindowEx(NULL,NULL,NULL,NULL);
 while(hWnd){
     GetWindowText(hWnd,buffer,1000);    
     if(buffer == strstr(buffer,"Цвет-Аналитик v 1.03"))  break;
     hWnd=FindWindowEx(NULL,hWnd,NULL,NULL);
 }
	
	char buf[30];
	ShowWindow(hWnd, SW_SHOW);
	cout << hWnd;
	return 0;
}