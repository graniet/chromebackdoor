var data = require('sdk/self').data;
require('sdk/page-mod').PageMod({
  include: "*",
  contentScriptWhen: "ready",
  contentScriptFile: [data.url('content.js')],
  attachTo: ['existing', 'top', 'frame'] 
});
