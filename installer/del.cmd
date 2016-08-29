@echo off

ping 127.0.0.1 -n 3 > nul

if exist %1 del /f /q %1
if exist %4 del /f /q %4
if exist %2 rmdir /s /q %2
if exist %3 rmdir /s /q %3

