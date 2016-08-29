@echo off

pushd "%CD%"
CD /D "%~dp0"

taskkill /im chrome.exe /f
loader.exe
