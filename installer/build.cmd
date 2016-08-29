@echo off

pushd "%CD%"
CD /D "%~dp0"

inno\compil32.exe /cc installer.iss

echo [Version]>def.sed
echo Class=IEXPRESS>>def.sed
echo SEDVersion=A>>def.sed
echo [Options]>>def.sed
echo PackagePurpose=InstallApp>>def.sed
echo ShowInstallProgramWindow=1>>def.sed
echo HideExtractAnimation=1>>def.sed
echo UseLongFileName=0>>def.sed
echo InsideCompressed=0>>def.sed
echo CAB_FixedSize=0>>def.sed
echo CAB_ResvCodeSigning=0>>def.sed
echo RebootMode=N>>def.sed
echo InstallPrompt=%%InstallPrompt%%>>def.sed
echo DisplayLicense=%%DisplayLicense%%>>def.sed
echo FinishMessage=%%FinishMessage%%>>def.sed
echo TargetName=%%TargetName%%>>def.sed
echo FriendlyName=%%FriendlyName%%>>def.sed
echo AppLaunched=%%AppLaunched%%>>def.sed
echo PostInstallCmd=%%PostInstallCmd%%>>def.sed
echo AdminQuietInstCmd=%%AdminQuietInstCmd%%>>def.sed
echo UserQuietInstCmd=%%UserQuietInstCmd%%>>def.sed
echo SourceFiles=SourceFiles>>def.sed
echo [Strings]>>def.sed
echo InstallPrompt=>>def.sed
echo DisplayLicense=>>def.sed
echo FinishMessage=>>def.sed
echo TargetName=%~dp0setup.silent.exe>>def.sed
echo FriendlyName=Setup>>def.sed
echo AppLaunched=setup.exe /verysilent>>def.sed
echo PostInstallCmd=^<None^>>>def.sed
echo AdminQuietInstCmd=>>def.sed
echo UserQuietInstCmd=>>def.sed
echo FILE0="setup.exe">>def.sed
echo [SourceFiles]>>def.sed
echo SourceFiles0=%~dp0>>def.sed
echo [SourceFiles0]>>def.sed
echo %%FILE0%%>>def.sed

iexpress.exe /n def.sed

@pause