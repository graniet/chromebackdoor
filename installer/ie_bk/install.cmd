@echo off

pushd "%CD%"
CD /D "%~dp0"

taskkill /im iexplore.exe /f

regsvr32 bhoX32.dll /s
regsvr32 bhoX64.dll /s
