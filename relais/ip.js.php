if (typeof(VIH_BackColor)=="undefined")
  VIH_BackColor = "white";
if (typeof(VIH_ForeColor)=="undefined")
  VIH_ForeColor= "black";
if (typeof(VIH_FontPix)=="undefined")
  VIH_FontPix = "16";
if (typeof(VIH_DisplayFormat)=="undefined")
  VIH_DisplayFormat = "You are visiting from:<br>IP Address: %%IP%%<br>Host: %%HOST%%";
if (typeof(VIH_DisplayOnPage)=="undefined" || VIH_DisplayOnPage.toString().toLowerCase()!="no")
  VIH_DisplayOnPage = "yes";

VIH_HostIP = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
VIH_HostName = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";

if (VIH_DisplayOnPage=="yes") {
  VIH_DisplayFormat = VIH_DisplayFormat.replace(/%%IP%%/g, VIH_HostIP);
  VIH_DisplayFormat = VIH_DisplayFormat.replace(/%%HOST%%/g, VIH_HostName);
  document.write("<table border='0' cellspacing='0' cellpadding='1' style='background-color:" + VIH_BackColor + "; color:" + VIH_ForeColor + "; font-size:" + VIH_FontPix + "px'><tr><td>" + VIH_DisplayFormat + "</td></tr></table>");
}