@echo off
set MESSAGE=%1
if "%MESSAGE%"=="" set MESSAGE=Update code
git add .
git commit -m "%MESSAGE%"
git push origin main
pause
