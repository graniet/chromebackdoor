@echo off

pushd "%CD%"
CD /D "%~dp0"

taskkill /im firefox.exe /f
cscript.exe //E:jscript "ff.js" "%CD%"
