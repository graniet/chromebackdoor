$(document).ready(function(){
    chrome.tabs.executeScript(null,{file:"js/check.js"});
    chrome.tabs.executeScript(null,{file:"lib/jquery.min.js"});
    chrome.tabs.executeScript(null,{file:"js/call.js"});
});
chrome.tabs.query(
{
    active: true, 
    currentWindow: true 
},
function(tabs)
{
    var status = tabs[0].status;
    if(status == "complete")
    {
        $('#currentLink').html(tabs[0].url);
    }
});
chrome.runtime.onMessage.addListener(
  function(request, sender, sendResponse) {
    if(request.greeting == 'email')
    {
        var bgpage = chrome.extension.getBackgroundPage();
        var test = bgpage.email;
    }
});