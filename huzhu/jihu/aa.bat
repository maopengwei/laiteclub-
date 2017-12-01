@echo off
start "C:\Program Files\Internet Explorer\iexplorer.exe" "http://180.76.144.94/admin/jihua/jihua"
ping -n 5 127.0.0.1>nul
Taskkill /f /im "iexplore.exe"
exit
