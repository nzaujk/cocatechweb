sprintfWrapper={init:function(){if(typeof arguments=="undefined"){return null;}
if(arguments.length<1){return null;}
if(typeof arguments[0]!="string"){return null;}
if(typeof RegExp=="undefined"){return null;}
var string=arguments[0];var exp=new RegExp(/(%([%]|(\-)?(\+|\x20)?(0)?(\d+)?(\.(\d)?)?([bcdfosxX])))/g);var matches=new Array();var strings=new Array();var convCount=0;var stringPosStart=0;var stringPosEnd=0;var matchPosEnd=0;var newString='';var match=null;while(match=exp.exec(string)){if(match[9]){convCount+=1;}
stringPosStart=matchPosEnd;stringPosEnd=exp.lastIndex- match[0].length;strings[strings.length]=string.substring(stringPosStart,stringPosEnd);matchPosEnd=exp.lastIndex;matches[matches.length]={match:match[0],left:match[3]?true:false,sign:match[4]||'',pad:match[5]||' ',min:match[6]||0,precision:match[8],code:match[9]||'%',negative:parseInt(arguments[convCount])<0?true:false,argument:String(arguments[convCount])};}
strings[strings.length]=string.substring(matchPosEnd);if(matches.length==0){return string;}
if((arguments.length- 1)<convCount){return null;}
var code=null;var match=null;var i=null;for(i=0;i<matches.length;i++){if(matches[i].code=='%'){substitution='%'}
else if(matches[i].code=='b'){matches[i].argument=String(Math.abs(parseInt(matches[i].argument)).toString(2));substitution=sprintfWrapper.convert(matches[i],true);}
else if(matches[i].code=='c'){matches[i].argument=String(String.fromCharCode(parseInt(Math.abs(parseInt(matches[i].argument)))));substitution=sprintfWrapper.convert(matches[i],true);}
else if(matches[i].code=='d'){matches[i].argument=String(Math.abs(parseInt(matches[i].argument)));substitution=sprintfWrapper.convert(matches[i]);}
else if(matches[i].code=='f'){matches[i].argument=String(Math.abs(parseFloat(matches[i].argument)).toFixed(matches[i].precision?matches[i].precision:6));substitution=sprintfWrapper.convert(matches[i]);}
else if(matches[i].code=='o'){matches[i].argument=String(Math.abs(parseInt(matches[i].argument)).toString(8));substitution=sprintfWrapper.convert(matches[i]);}
else if(matches[i].code=='s'){matches[i].argument=matches[i].argument.substring(0,matches[i].precision?matches[i].precision:matches[i].argument.length)
substitution=sprintfWrapper.convert(matches[i],true);}
else if(matches[i].code=='x'){matches[i].argument=String(Math.abs(parseInt(matches[i].argument)).toString(16));substitution=sprintfWrapper.convert(matches[i]);}
else if(matches[i].code=='X'){matches[i].argument=String(Math.abs(parseInt(matches[i].argument)).toString(16));substitution=sprintfWrapper.convert(matches[i]).toUpperCase();}
else{substitution=matches[i].match;}
newString+=strings[i];newString+=substitution;}
newString+=strings[i];return newString;},convert:function(match,nosign){if(nosign){match.sign='';}else{match.sign=match.negative?'-':match.sign;}
var l=match.min- match.argument.length+ 1- match.sign.length;var pad=new Array(l<0?0:l).join(match.pad);if(!match.left){if(match.pad=="0"||nosign){return match.sign+ pad+ match.argument;}else{return pad+ match.sign+ match.argument;}}else{if(match.pad=="0"||nosign){return match.sign+ match.argument+ pad.replace(/0/g,' ');}else{return match.sign+ match.argument+ pad;}}}}
sprintf=sprintfWrapper.init;function oc(name){var bits=name.split('_');loads[bits[1]][bits[0]]=$("input[name='"+name+"']").val()
if(loads[bits[1]][bits[0]]=="checked")
{if($("input[name='"+name+"']:checked").length>0)
loads[bits[1]][bits[0]]="checked";else
loads[bits[1]][bits[0]]="";}
lcalc();}
function add_load(load)
{loads.push(load);render_loads();lcalc();}
function lv(v)
{if(v==undefined)
return"";return v;}
function lcalc()
{var acConnected=0;var acSurge=0;var acDaily=0;var dcDaily=0;var highestSurge=0;var summedSurge=0;for(var i in loads)
{load=loads[i];if(load['acWatts']>0||load['dcWatts']>0)
{var q=load['quantity'];if(q==undefined)
{q=1;load['quantity']=q;$("input[name='quantity_"+ i+"']").val(q);}
var hours=Number(load['hoursPerDay']);if(isNaN(hours))
hours=0;if(load['acWatts']>0)
{var w=load['acWatts']*q;var wh=w*hours;acDaily+=wh;var surge=load['acSurge'];if(load['acWatts']>surge||surge==undefined)
surge=load['acWatts'];surge*=q;if(load['onAtTime']=="checked")
{summedSurge+=surge;acConnected+=w;}else
if(surge>highestSurge)
highestSurge=surge;$("input[name='dcWatts_"+ i+"']").val(0);}else{var w=load['dcWatts']*q;var wh=w*hours;dcDaily+=wh;$("input[name='acWatts_"+ i+"']").val(0);}
if(load['wattHoursPerDay']!=wh)
{load['wattHoursPerDay']=wh;$("input[name='wattHoursPerDay_"+ i+"']").val(wh);}}}
$('#acDaily').html(acDaily);$('#dcDaily').html(dcDaily);if(highestSurge>summedSurge)
$('#acSurge').html(highestSurge);else
$('#acSurge').html(summedSurge);$('#acConnected').html(acConnected);$('#allDaily').html(acDaily+ dcDaily);$('input[name=dwhrs]').val(acDaily+ dcDaily);}
function render_loads()
{html='';for(var i=0;i<loads.length;i++)
{var load=loads[i];html+=sprintf(['','<tr>','	<td><input type="text" name="name_%s" value="%s" onkeyup="oc(\'name_%s\')" /></td>','	<td><input type="checkbox" size="4" name="onAtTime_%s" value="checked" onchange="oc(\'onAtTime_%s\')"  %s/></td>','	<td><input type="text" size="4" name="quantity_%s" value="%s" onkeyup="oc(\'quantity_%s\')" /></td>','	<td><input type="text" size="6" name="acWatts_%s" value="%s" onkeyup="oc(\'acWatts_%s\')" /></td>','	<td><input type="text" size="6" name="acSurge_%s" value="%s" onkeyup="oc(\'acSurge_%s\')" /></td>','	<td><input type="text" size="6" name="dcWatts_%s" value="%s" onkeyup="oc(\'dcWatts_%s\')" /></td>','	<td><input type="text" size="6" name="hoursPerDay_%s" value="%s" onkeyup="oc(\'hoursPerDay_%s\')" /></td>','	<td><input type="text" size="6" name="wattHoursPerDay_%s" value="%s" onkeyup="oc(\'wattHoursPerDay_%s\')" /></td>','</tr>'].join("\n"),i,lv(load['name']),i,i,i,lv(load['onAtTime']),i,lv(load['quantity']),i,i,lv(load['acWatts']),i,i,lv(load['acSurge']),i,i,lv(load['dcWatts']),i,i,lv(load['hoursPerDay']),i,i,lv(load['wattHoursPerDay']),i);}
$("#lbody").html(html);}