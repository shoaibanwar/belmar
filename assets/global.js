/* IE Clear type fix */
(function ($) {
    $.fn.customFadeIn = function (speed, callback) {
        $(this).fadeIn(speed, function () {
            if (jQuery.browser.msie) $(this).get(0).style.removeAttribute('filter');
            if (callback != undefined) callback();
        });
    };
    $.fn.customFadeOut = function (speed, callback) {
        $(this).fadeOut(speed, function () {
            if (jQuery.browser.msie) $(this).get(0).style.removeAttribute('filter');
            if (callback != undefined) callback();
        });
    };
    $.fn.customFadeTo = function (speed, callback) {
        $(this).fadeTo(speed, function () {
            if (jQuery.browser.msie) $(this).get(0).style.removeAttribute('filter');
            if (callback != undefined) callback();
        });
    };
    $.fn.customToggle = function (speed, callback) {
        $(this).toggle(speed, function () {
            if (jQuery.browser.msie) $(this).get(0).style.removeAttribute('filter');
            if (callback != undefined) callback();
        });
    };

})(jQuery);
/* Live Search */
$(document).ready(function() {
  $("#inputString").keyup(function() {
	  var inpstr = $(this).val();
	  if (inpstr.length > 3) {
		  $.ajax({
			  type: "post",
			  url: SITEURL + "/ajax/livesearch.php",
			  data: "liveSearch=" + inpstr,
			  cache: false,
			  success: function (res) {
				  $("#suggestions").customFadeIn();
				  $("#suggestions").html(res);
			  }
		  });
  
		  $("input").blur(function () {
			  $('#suggestions').customFadeOut();
		  });
	  }
  });
});
/* Disable autocomplete */
var flag = 1;
   function disAutoComplete(obj){
        if(flag){
      	obj.setAttribute("autocomplete","off");
            flag = 0;
      }
        obj.focus();
}

/*
 * jQuery Form Plugin
 * version: 2.63 (29-JAN-2011)
 * @requires jQuery v1.3.2 or later
 *
 * Examples and documentation at: http://malsup.com/jquery/form/
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
(function(b){b.fn.ajaxSubmit=function(t){if(!this.length){a("ajaxSubmit: skipping submit process - no element selected");return this}if(typeof t=="function"){t={success:t}}var h=this.attr("action");var d=(typeof h==="string")?b.trim(h):"";if(d){d=(d.match(/^([^#]+)/)||[])[1]}d=d||window.location.href||"";t=b.extend(true,{url:d,type:this[0].getAttribute("method")||"GET",iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},t);var u={};this.trigger("form-pre-serialize",[this,t,u]);if(u.veto){a("ajaxSubmit: submit vetoed via form-pre-serialize trigger");return this}if(t.beforeSerialize&&t.beforeSerialize(this,t)===false){a("ajaxSubmit: submit aborted via beforeSerialize callback");return this}var f,p,m=this.formToArray(t.semantic);if(t.data){t.extraData=t.data;for(f in t.data){if(t.data[f] instanceof Array){for(var i in t.data[f]){m.push({name:f,value:t.data[f][i]})}}else{p=t.data[f];p=b.isFunction(p)?p():p;m.push({name:f,value:p})}}}if(t.beforeSubmit&&t.beforeSubmit(m,this,t)===false){a("ajaxSubmit: submit aborted via beforeSubmit callback");return this}this.trigger("form-submit-validate",[m,this,t,u]);if(u.veto){a("ajaxSubmit: submit vetoed via form-submit-validate trigger");return this}var c=b.param(m);if(t.type.toUpperCase()=="GET"){t.url+=(t.url.indexOf("?")>=0?"&":"?")+c;t.data=null}else{t.data=c}var s=this,l=[];if(t.resetForm){l.push(function(){s.resetForm()})}if(t.clearForm){l.push(function(){s.clearForm()})}if(!t.dataType&&t.target){var r=t.success||function(){};l.push(function(n){var k=t.replaceTarget?"replaceWith":"html";b(t.target)[k](n).each(r,arguments)})}else{if(t.success){l.push(t.success)}}t.success=function(w,n,x){var v=t.context||t;for(var q=0,k=l.length;q<k;q++){l[q].apply(v,[w,n,x||s,s])}};var g=b("input:file",this).length>0;var e="multipart/form-data";var j=(s.attr("enctype")==e||s.attr("encoding")==e);if(t.iframe!==false&&(g||t.iframe||j)){if(t.closeKeepAlive){b.get(t.closeKeepAlive,o)}else{o()}}else{b.ajax(t)}this.trigger("form-submit-notify",[this,t]);return this;function o(){var v=s[0];if(b(":input[name=submit],:input[id=submit]",v).length && false){alert('Error: Form elements must not have name or id of "submit".');return}var B=b.extend(true,{},b.ajaxSettings,t);B.context=B.context||B;var E="jqFormIO"+(new Date().getTime()),z="_"+E;var w=b('<iframe id="'+E+'" name="'+E+'" src="'+B.iframeSrc+'" />');var A=w[0];w.css({position:"absolute",top:"-1000px",left:"-1000px"});var x={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(){this.aborted=1;w.attr("src",B.iframeSrc)}};var I=B.global;if(I&&!b.active++){b.event.trigger("ajaxStart")}if(I){b.event.trigger("ajaxSend",[x,B])}if(B.beforeSend&&B.beforeSend.call(B.context,x,B)===false){if(B.global){b.active--}return}if(x.aborted){return}var H=0;var y=v.clk;if(y){var F=y.name;if(F&&!y.disabled){B.extraData=B.extraData||{};B.extraData[F]=y.value;if(y.type=="image"){B.extraData[F+".x"]=v.clk_x;B.extraData[F+".y"]=v.clk_y}}}function G(){var O=s.attr("target"),M=s.attr("action");v.setAttribute("target",E);if(v.getAttribute("method")!="POST"){v.setAttribute("method","POST")}if(v.getAttribute("action")!=B.url){v.setAttribute("action",B.url)}if(!B.skipEncodingOverride){s.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"})}if(B.timeout){setTimeout(function(){H=true;D()},B.timeout)}var N=[];try{if(B.extraData){for(var P in B.extraData){N.push(b('<input type="hidden" name="'+P+'" value="'+B.extraData[P]+'" />').appendTo(v)[0])}}w.appendTo("body");A.attachEvent?A.attachEvent("onload",D):A.addEventListener("load",D,false);v.submit()}finally{v.setAttribute("action",M);if(O){v.setAttribute("target",O)}else{s.removeAttr("target")}b(N).remove()}}if(B.forceSync){G()}else{setTimeout(G,10)}var K,L,J=50;function D(){L=A.contentWindow?A.contentWindow.document:A.contentDocument?A.contentDocument:A.document;if(!L||L.location.href==B.iframeSrc){return}A.detachEvent?A.detachEvent("onload",D):A.removeEventListener("load",D,false);var N=true;try{if(H){throw"timeout"}var R=B.dataType=="xml"||L.XMLDocument||b.isXMLDoc(L);a("isXml="+R);if(!R&&window.opera&&(L.body==null||L.body.innerHTML=="")){if(--J){a("requeing onLoad callback, DOM not available");setTimeout(D,250);return}}x.responseText=L.body?L.body.innerHTML:L.documentElement?L.documentElement.innerHTML:null;x.responseXML=L.XMLDocument?L.XMLDocument:L;x.getResponseHeader=function(T){var S={"content-type":B.dataType};return S[T]};var Q=/(json|script)/.test(B.dataType);if(Q||B.textarea){var M=L.getElementsByTagName("textarea")[0];if(M){x.responseText=M.value}else{if(Q){var P=L.getElementsByTagName("pre")[0];var n=L.getElementsByTagName("body")[0];if(P){x.responseText=P.textContent}else{if(n){x.responseText=n.innerHTML}}}}}else{if(B.dataType=="xml"&&!x.responseXML&&x.responseText!=null){x.responseXML=C(x.responseText)}}K=k(x,B.dataType,B)}catch(O){a("error caught:",O);N=false;x.error=O;B.error.call(B.context,x,"error",O);I&&b.event.trigger("ajaxError",[x,B,O])}if(x.aborted){a("upload aborted");N=false}if(N){B.success.call(B.context,K,"success",x);I&&b.event.trigger("ajaxSuccess",[x,B])}I&&b.event.trigger("ajaxComplete",[x,B]);if(I&&!--b.active){b.event.trigger("ajaxStop")}B.complete&&B.complete.call(B.context,x,N?"success":"error");setTimeout(function(){w.removeData("form-plugin-onload");w.remove();x.responseXML=null},100)}var C=b.parseXML||function(n,M){if(window.ActiveXObject){M=new ActiveXObject("Microsoft.XMLDOM");M.async="false";M.loadXML(n)}else{M=(new DOMParser()).parseFromString(n,"text/xml")}return(M&&M.documentElement&&M.documentElement.nodeName!="parsererror")?M:null};var q=b.parseJSON||function(n){return window["eval"]("("+n+")")};var k=function(Q,O,N){var M=Q.getResponseHeader("content-type")||"",n=O==="xml"||!O&&M.indexOf("xml")>=0,P=n?Q.responseXML:Q.responseText;if(n&&P.documentElement.nodeName==="parsererror"){b.error&&b.error("parsererror")}if(N&&N.dataFilter){P=N.dataFilter(P,O)}if(typeof P==="string"){if(O==="json"||!O&&M.indexOf("json")>=0){P=q(P)}else{if(O==="script"||!O&&M.indexOf("javascript")>=0){b.globalEval(P)}}}return P}}};b.fn.ajaxForm=function(c){if(this.length===0){var d={s:this.selector,c:this.context};if(!b.isReady&&d.s){a("DOM not ready, queuing ajaxForm");b(function(){b(d.s,d.c).ajaxForm(c)});return this}a("terminating; zero elements found by selector"+(b.isReady?"":" (DOM not ready)"));return this}return this.ajaxFormUnbind().bind("submit.form-plugin",function(f){if(!f.isDefaultPrevented()){f.preventDefault();b(this).ajaxSubmit(c)}}).bind("click.form-plugin",function(j){var i=j.target;var g=b(i);if(!(g.is(":submit,input:image"))){var f=g.closest(":submit");if(f.length==0){return}i=f[0]}var h=this;h.clk=i;if(i.type=="image"){if(j.offsetX!=undefined){h.clk_x=j.offsetX;h.clk_y=j.offsetY}else{if(typeof b.fn.offset=="function"){var k=g.offset();h.clk_x=j.pageX-k.left;h.clk_y=j.pageY-k.top}else{h.clk_x=j.pageX-i.offsetLeft;h.clk_y=j.pageY-i.offsetTop}}}setTimeout(function(){h.clk=h.clk_x=h.clk_y=null},100)})};b.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")};b.fn.formToArray=function(q){var p=[];if(this.length===0){return p}var d=this[0];var g=q?d.getElementsByTagName("*"):d.elements;if(!g){return p}var k,h,f,r,e,m,c;for(k=0,m=g.length;k<m;k++){e=g[k];f=e.name;if(!f){continue}if(q&&d.clk&&e.type=="image"){if(!e.disabled&&d.clk==e){p.push({name:f,value:b(e).val()});p.push({name:f+".x",value:d.clk_x},{name:f+".y",value:d.clk_y})}continue}r=b.fieldValue(e,true);if(r&&r.constructor==Array){for(h=0,c=r.length;h<c;h++){p.push({name:f,value:r[h]})}}else{if(r!==null&&typeof r!="undefined"){p.push({name:f,value:r})}}}if(!q&&d.clk){var l=b(d.clk),o=l[0];f=o.name;if(f&&!o.disabled&&o.type=="image"){p.push({name:f,value:l.val()});p.push({name:f+".x",value:d.clk_x},{name:f+".y",value:d.clk_y})}}return p};b.fn.formSerialize=function(c){return b.param(this.formToArray(c))};b.fn.fieldSerialize=function(d){var c=[];this.each(function(){var h=this.name;if(!h){return}var f=b.fieldValue(this,d);if(f&&f.constructor==Array){for(var g=0,e=f.length;g<e;g++){c.push({name:h,value:f[g]})}}else{if(f!==null&&typeof f!="undefined"){c.push({name:this.name,value:f})}}});return b.param(c)};b.fn.fieldValue=function(h){for(var g=[],e=0,c=this.length;e<c;e++){var f=this[e];var d=b.fieldValue(f,h);if(d===null||typeof d=="undefined"||(d.constructor==Array&&!d.length)){continue}d.constructor==Array?b.merge(g,d):g.push(d)}return g};b.fieldValue=function(c,j){var e=c.name,p=c.type,q=c.tagName.toLowerCase();if(j===undefined){j=true}if(j&&(!e||c.disabled||p=="reset"||p=="button"||(p=="checkbox"||p=="radio")&&!c.checked||(p=="submit"||p=="image")&&c.form&&c.form.clk!=c||q=="select"&&c.selectedIndex==-1)){return null}if(q=="select"){var k=c.selectedIndex;if(k<0){return null}var m=[],d=c.options;var g=(p=="select-one");var l=(g?k+1:d.length);for(var f=(g?k:0);f<l;f++){var h=d[f];if(h.selected){var o=h.value;if(!o){o=(h.attributes&&h.attributes.value&&!(h.attributes.value.specified))?h.text:h.value}if(g){return o}m.push(o)}}return m}return b(c).val()};b.fn.clearForm=function(){return this.each(function(){b("input,select,textarea",this).clearFields()})};b.fn.clearFields=b.fn.clearInputs=function(){return this.each(function(){var d=this.type,c=this.tagName.toLowerCase();if(d=="text"||d=="password"||c=="textarea"){this.value=""}else{if(d=="checkbox"||d=="radio"){this.checked=false}else{if(c=="select"){this.selectedIndex=-1}}}})};b.fn.resetForm=function(){return this.each(function(){if(typeof this.reset=="function"||(typeof this.reset=="object"&&!this.reset.nodeType)){this.reset()}})};b.fn.enable=function(c){if(c===undefined){c=true}return this.each(function(){this.disabled=!c})};b.fn.selected=function(c){if(c===undefined){c=true}return this.each(function(){var d=this.type;if(d=="checkbox"||d=="radio"){this.checked=c}else{if(this.tagName.toLowerCase()=="option"){var e=b(this).parent("select");if(c&&e[0]&&e[0].type=="select-one"){e.find("option").selected(false)}this.selected=c}}})};function a(){if(b.fn.ajaxSubmit.debug){var c="[jquery.form] "+Array.prototype.join.call(arguments,"");if(window.console&&window.console.log){window.console.log(c)}else{if(window.opera&&window.opera.postError){window.opera.postError(c)}}}}})(jQuery);

/*
	Watermark v3.1.3 (March 22, 2011) plugin for jQuery
	http://jquery-watermark.googlecode.com/
	Copyright (c) 2009-2011 Todd Northrop
	http://www.speednet.biz/
	Dual licensed under the MIT or GPL Version 2 licenses.
*/
(function(a,h,y){var w="function",v="password",j="maxLength",n="type",b="",c=true,u="placeholder",i=false,t="watermark",g=t,f="watermarkClass",q="watermarkFocus",l="watermarkSubmit",o="watermarkMaxLength",e="watermarkPassword",d="watermarkText",k=/\r/g,s="input:data("+g+"),textarea:data("+g+")",m="input:text,input:password,input[type=search],input:not([type]),textarea",p=["Page_ClientValidate"],r=i,x=u in document.createElement("input");a.watermark=a.watermark||{version:"3.1.3",runOnce:c,options:{className:t,useNative:c,hideBeforeUnload:c},hide:function(b){a(b).filter(s).each(function(){a.watermark._hide(a(this))})},_hide:function(a,r){var p=a[0],q=(p.value||b).replace(k,b),l=a.data(d)||b,m=a.data(o)||0,i=a.data(f);if(l.length&&q==l){p.value=b;if(a.data(e))if((a.attr(n)||b)==="text"){var g=a.data(e)||[],c=a.parent()||[];if(g.length&&c.length){c[0].removeChild(a[0]);c[0].appendChild(g[0]);a=g}}if(m){a.attr(j,m);a.removeData(o)}if(r){a.attr("autocomplete","off");h.setTimeout(function(){a.select()},1)}}i&&a.removeClass(i)},show:function(b){a(b).filter(s).each(function(){a.watermark._show(a(this))})},_show:function(g){var p=g[0],u=(p.value||b).replace(k,b),h=g.data(d)||b,s=g.attr(n)||b,t=g.data(f);if((u.length==0||u==h)&&!g.data(q)){r=c;if(g.data(e))if(s===v){var m=g.data(e)||[],l=g.parent()||[];if(m.length&&l.length){l[0].removeChild(g[0]);l[0].appendChild(m[0]);g=m;g.attr(j,h.length);p=g[0]}}if(s==="text"||s==="search"){var i=g.attr(j)||0;if(i>0&&h.length>i){g.data(o,i);g.attr(j,h.length)}}t&&g.addClass(t);p.value=h}else a.watermark._hide(g)},hideAll:function(){if(r){a.watermark.hide(m);r=i}},showAll:function(){a.watermark.show(m)}};a.fn.watermark=a.fn.watermark||function(p,o){var t="string";if(!this.length)return this;var s=i,r=typeof p===t;if(r)p=p.replace(k,b);if(typeof o==="object"){s=typeof o.className===t;o=a.extend({},a.watermark.options,o)}else if(typeof o===t){s=c;o=a.extend({},a.watermark.options,{className:o})}else o=a.watermark.options;if(typeof o.useNative!==w)o.useNative=o.useNative?function(){return c}:function(){return i};return this.each(function(){var B="dragleave",A="dragenter",z=this,i=a(z);if(!i.is(m))return;if(i.data(g)){if(r||s){a.watermark._hide(i);r&&i.data(d,p);s&&i.data(f,o.className)}}else{if(x&&o.useNative.call(z,i)&&(i.attr("tagName")||b)!=="TEXTAREA"){r&&i.attr(u,p);return}i.data(d,r?p:b);i.data(f,o.className);i.data(g,1);if((i.attr(n)||b)===v){var C=i.wrap("<span>").parent(),t=a(C.html().replace(/type=["']?password["']?/i,'type="text"'));t.data(d,i.data(d));t.data(f,i.data(f));t.data(g,1);t.attr(j,p.length);t.focus(function(){a.watermark._hide(t,c)}).bind(A,function(){a.watermark._hide(t)}).bind("dragend",function(){h.setTimeout(function(){t.blur()},1)});i.blur(function(){a.watermark._show(i)}).bind(B,function(){a.watermark._show(i)});t.data(e,i);i.data(e,t)}else i.focus(function(){i.data(q,1);a.watermark._hide(i,c)}).blur(function(){i.data(q,0);a.watermark._show(i)}).bind(A,function(){a.watermark._hide(i)}).bind(B,function(){a.watermark._show(i)}).bind("dragend",function(){h.setTimeout(function(){a.watermark._show(i)},1)}).bind("drop",function(e){var c=i[0],a=e.originalEvent.dataTransfer.getData("Text");if((c.value||b).replace(k,b).replace(a,b)===i.data(d))c.value=a;i.focus()});if(z.form){var w=z.form,y=a(w);if(!y.data(l)){y.submit(a.watermark.hideAll);if(w.submit){y.data(l,w.submit);w.submit=function(c,b){return function(){var d=b.data(l);a.watermark.hideAll();if(d.apply)d.apply(c,Array.prototype.slice.call(arguments));else d()}}(w,y)}else{y.data(l,1);w.submit=function(b){return function(){a.watermark.hideAll();delete b.submit;b.submit()}}(w)}}}}a.watermark._show(i)})};if(a.watermark.runOnce){a.watermark.runOnce=i;a.extend(a.expr[":"],{data:function(c,d,b){return!!a.data(c,b[3])}});(function(c){a.fn.val=function(){var e=this;if(!e.length)return arguments.length?e:y;if(!arguments.length)if(e.data(g)){var f=(e[0].value||b).replace(k,b);return f===(e.data(d)||b)?b:f}else return c.apply(e,arguments);else{c.apply(e,arguments);a.watermark.show(e);return e}}})(a.fn.val);p.length&&a(function(){for(var b,c,d=p.length-1;d>=0;d--){b=p[d];c=h[b];if(typeof c===w)h[b]=function(b){return function(){a.watermark.hideAll();return b.apply(null,Array.prototype.slice.call(arguments))}}(c)}});a(h).bind("beforeunload",function(){a.watermark.options.hideBeforeUnload&&a.watermark.hideAll()})}})(jQuery,window);

/* Simple Checkbox and Radio button Styling plugin
* @author Abdullah Rubiyath <http://www.itsalif.info/>
*/
(function($){$.fn.ezMark=function(options){options=options||{};var defaultOpt={checkboxCls:options.checkboxCls||'ez-checkbox',radioCls:options.radioCls||'ez-radio',checkedCls:options.checkedCls||'ez-checked',selectedCls:options.selectedCls||'ez-selected',hideCls:'ez-hide'};return this.each(function(){var $this=$(this);var wrapTag=$this.attr('type')=='checkbox'?'<div class="'+defaultOpt.checkboxCls+'">':'<div class="'+defaultOpt.radioCls+'">';if($this.attr('type')=='checkbox'){$this.addClass(defaultOpt.hideCls).wrap(wrapTag).change(function(){if($(this).is(':checked')){$(this).parent().addClass(defaultOpt.checkedCls);}
else{$(this).parent().removeClass(defaultOpt.checkedCls);}});if($this.is(':checked')){$this.parent().addClass(defaultOpt.checkedCls);}}
else if($this.attr('type')=='radio'){$this.addClass(defaultOpt.hideCls).wrap(wrapTag).change(function(){$('input[name="'+$(this).attr('name')+'"]').each(function(){if($(this).is(':checked')){$(this).parent().addClass(defaultOpt.selectedCls);}else{$(this).parent().removeClass(defaultOpt.selectedCls);}});});if($this.is(':checked')){$this.parent().addClass(defaultOpt.selectedCls);}}});}})(jQuery);

/* Cookie Plugin 
* @author Klaus Hartl/klaus.hartl@stilbuero.de
*/
jQuery.cookie=function(d,e,b){if(arguments.length>1&&(e===null||typeof e!=="object")){b=jQuery.extend({},b);if(e===null){b.expires=-1}if(typeof b.expires==="number"){var g=b.expires,c=b.expires=new Date();c.setDate(c.getDate()+g)}return(document.cookie=[encodeURIComponent(d),"=",b.raw?String(e):encodeURIComponent(String(e)),b.expires?"; expires="+b.expires.toUTCString():"",b.path?"; path="+b.path:"",b.domain?"; domain="+b.domain:"",b.secure?"; secure":""].join(""))}b=e||{};var a,f=b.raw?function(h){return h}:decodeURIComponent;return(a=new RegExp("(?:^|; )"+encodeURIComponent(d)+"=([^;]*)").exec(document.cookie))?f(a[1]):null}; 

/* File Input Plugin */
(function(a){a.fn.filestyle=function(b){var c={width:250};if(b){a.extend(c,b)}return this.each(function(){var e=this;var f=a("<div>").css({width:c.imagewidth+"px",height:c.imageheight+"px",background:"url("+c.image+") 0 0 no-repeat","background-position":"right",display:"inline",position:"absolute",overflow:"hidden"});var d=a('<input class="file">').addClass(a(e).attr("class")).css({display:"inline",width:c.width+"px"});a(e).before(d);a(e).wrap(f);a(e).css({position:"relative",height:c.imageheight+"px",width:c.width+"px",display:"inline",cursor:"pointer",opacity:"0.0"});if(a.browser.mozilla){if(/Win/.test(navigator.platform)){a(e).css("margin-left","-142px")}else{a(e).css("margin-left","-168px")}}else{a(e).css("margin-left",c.imagewidth-c.width+"px")}a(e).bind("change",function(){d.val(a(e).val())})})}})(jQuery);

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}(';(2($){$.k.z=2(d){4 e=$.k.z,c=e.c,$N=$([\'<O 1k="\',c.P,\'"> &#1l;</O>\'].g(\'\')),q=2(){4 a=$(3),l=A(a);Q(l.B);a.R().1m().r()},C=2(){4 a=$(3),l=A(a),o=e.9;Q(l.B);l.B=1n(2(){o.D=($.1o(a[0],o.$m)>-1);a.r();t(o.$m.E&&a.F([\'h.\',o.j].g(\'\')).E<1){q.8(o.$m)}},o.S)},A=2(a){4 b=a.F([\'5.\',c.G,\':T\'].g(\'\'))[0];e.9=e.o[b.U];u b},V=2(a){a.v(c.W).1p($N.1q())};u 3.n(2(){4 s=3.U=e.o.E;4 o=$.X({},e.Y,d);o.$m=$(\'h.\'+o.H,3).1r(0,o.Z).n(2(){$(3).v([o.j,c.I].g(\' \')).1s(\'h:10(5)\').11(o.H)});e.o[s]=e.9=o;$(\'h:10(5)\',3)[($.k.12&&!o.13)?\'12\':\'1t\'](q,C).n(2(){t(o.14)V($(\'>a:T-1u\',3))}).w(\'.\'+c.I).r();4 b=$(\'a\',3);b.n(2(i){4 a=b.15(i).F(\'h\');b.15(i).1v(2(){q.8(a)}).1w(2(){C.8(a)})});o.16.8(3)}).n(2(){4 a=[c.G];t(e.9.J&&!($.x.17&&$.x.18<7))a.1x(c.y);$(3).v(a.g(\' \'))})};4 f=$.k.z;f.o=[];f.9={};f.K=2(){4 o=f.9;t($.x.17&&$.x.18>6&&o.J&&o.L.19!=1y)3.1z(f.c.y+\'-1a\')};f.c={I:\'p-1A\',G:\'p-1B-1C\',W:\'p-1D-5\',P:\'p-1E-1F\',y:\'p-1G\'};f.Y={j:\'1H\',H:\'1I\',Z:1,S:1J,L:{19:\'1K\'},1b:\'1L\',14:M,J:M,13:1c,16:2(){},1d:2(){},1e:2(){},1f:2(){}};$.k.X({r:2(){4 o=f.9,w=(o.D===M)?o.$m:\'\';o.D=1c;4 a=$([\'h.\',o.j].g(\'\'),3).1M(3).w(w).11(o.j).1g(\'>5\').1N().1h(\'1i\',\'1j\');o.1f.8(a);u 3},R:2(){4 o=f.9,1O=f.c.y+\'-1a\',$5=3.v(o.j).1g(\'>5:1j\').1h(\'1i\',\'1P\');f.K.8($5);o.1d.8($5);$5.1Q(o.L,o.1b,2(){f.K.8($5);o.1e.8($5)});u 3}})})(1R);',62,116,'||function|this|var|ul|||call|op|||||||join|li||hoverClass|fn|menu|path|each||sf|over|hideSuperfishUl||if|return|addClass|not|browser|shadowClass|superfish|getMenu|sfTimer|out|retainPath|length|parents|menuClass|pathClass|bcClass|dropShadows|IE7fix|animation|true|arrow|span|arrowClass|clearTimeout|showSuperfishUl|delay|first|serial|addArrow|anchorClass|extend|defaults|pathLevels|has|removeClass|hoverIntent|disableHI|autoArrows|eq|onInit|msie|version|opacity|off|speed|false|onBeforeShow|onShow|onHide|find|css|visibility|hidden|class|187|siblings|setTimeout|inArray|append|clone|slice|filter|hover|child|focus|blur|push|undefined|toggleClass|breadcrumb|js|enabled|with|sub|indicator|shadow|sfHover|overideThisToUse|800|show|normal|add|hide|sh|visible|animate|jQuery'.split('|'),0,{}));

/* 
* Custom Select Box
*/
(function(a){a.fn.extend({customStyle:function(b){if(!a.browser.msie||(a.browser.msie&&a.browser.version>6)){return this.each(function(){var c=a(this).find(":selected");a(this).after('<span class="customStyleSelectBox"><span class="customStyleSelectBoxInner">'+c.text()+"</span></span>").css({position:"absolute",opacity:0,fontSize:a(this).next().css("font-size")});var g=a(this).next();var f=parseInt(a(this).width())-parseInt(g.css("padding-left"))-parseInt(g.css("padding-right"));var e=g.find(":first-child");g.css({display:"inline-block"});e.css({width:f,display:"inline-block"});var d=parseInt(g.height())+parseInt(g.css("padding-top"))+parseInt(g.css("padding-bottom"));a(this).height(d).change(function(){e.text(a(this).find(":selected").text()).parent().addClass("changed")})})}}})})(jQuery);

$(function(){
    $('.deps').change(function(){
            $('.menu_'+$(this).val()).show();
        })                           ;
    $('.enable_cust_permissions').click(function(){
        $('.deps').show();
    });
    $('.disable_cust_permissions').click(function(){
        $('.deps').hide();
    });
    $('.remove_menu').click(function(){
        $('.' + $(this).attr('menu')).find('input[value=n]').click();
        $('.' + $(this).attr('menu')).hide();
    });
})

function showMessage(status,message)
{
    status =   status.capitalize();
    var title ='Success!';
    switch (status.toLowerCase()) {
        case 'error':
            title= 'Error!'
            break;
       case 'alert':
            title= 'Alert!'
            break;
    }
    var elem = $('<div class="msg'+status+'"><span>'+title+'</span>'+message+'</div> ');
    $("#msgholder").hide().html(elem).customFadeIn(700,function(){});
    $("html, body").animate({
        scrollTop: 0
    }, 300,function(){
        setTimeout(function(){

            $("#msgholder").fadeOut('500',function(){
                $("#msgholder").html('');
            });

        },2000);

    });

}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

function showGroupActionsConfirm(text,title,buttons){
    if(text == undefined || title == undefined) return;
    $('.action_container').html(text);

    if(buttons == undefined) buttons = {};
    buttons.Cancel = function () {
         $(this).dialog('destroy').remove();
    };
    $('<div></div>')
     .html(text)
     .dialog({
        resizable: false,
        bgiframe: true,
        autoOpen: false,
        width: 400,
        height: "auto",
        zindex: 9998,
        modal: false,
        buttons: buttons,
        title: title

    }).dialog('open');
}
function restyle_select(selector) {
    $(selector).next('.customStyleSelectBox').remove();
    $(selector).customStyle();
}
function send_group_action(action,items){
    $.ajax({
        type: 'post',
        url: "ajax.php",
        data: 'group_action=1&action=' + action + '&items=' + items.join('_'),

        success: function (msg) {
            $("html, body").animate({scrollTop:0}, 600);
            $("#msgholder").html(msg);
        }
    });
}

function select_none(items ){
    if(items == undefined) items = '.to_be_checked';
    $('.to_be_checked,.check_all').attr('checked',false ).parents('.ez-checkbox').removeClass('ez-checked');
}
$(function(){
    $('.check_all').live('click',function(){
        if($(this).attr('checked')=='checked')
        $('.to_be_checked').attr('checked',true ).parents('.ez-checkbox').addClass('ez-checked');
        else
            $('.to_be_checked').attr('checked',false ).parents('.ez-checkbox').removeClass('ez-checked');
    })
    $('.group_actions').change(function(){
        var action = $(this).val();
        var items = $('.to_be_checked:checked');
		
        if($(items).length == 0)  {
            showGroupActionsConfirm('Select some items first.','Error');
            $(this).val('NA');
            restyle_select('.group_actions');
            return;
        }
		
		alert(items);

        if(action == 'delete'){
            showGroupActionsConfirm('Are you sure you want to <b>delete</b> selected items?','Delete selected items!',{Delete:function(){
                $(this).dialog('destroy').remove();
                showGroupActionsConfirm('Please confirm again that you are about to <b>DELETE</b> the selected items.','Confirm Delete!',{Delete:function(){
                    showMessage('ok','Deleted Successfully (TEST)');
                    $(this).dialog('destroy').remove();
                    $('.group_actions').val('NA');
                    restyle_select('.group_actions');
                    select_none();
                }});
            }});
        }
        else if(action == 'publish'){
            showGroupActionsConfirm('Please confirm again that you are about to <b>PUBLISH</b> the selected items!','Publish selected items!');
            $('.group_actions').val('NA');
            restyle_select('.group_actions');
        }
        else if(action == 'unpublish'){
            showGroupActionsConfirm('Please confirm again that you are about to <b>UNPUBLISH</b> the selected items!','Unpublish selected items!');
            $('.group_actions').val('NA');
            restyle_select('.group_actions');
        }

    })

})

