@echo off
start "C:\Program Files\Internet Explorer\iexplorer.exe" "http://127.0.0.1:1249/admin/jihua/jihua"
ping -n 5 127.0.0.1>nul
Taskkill /f /im "iexplore.exe"
exit
