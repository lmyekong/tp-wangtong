/*! Copyright (c) 2013 Brandon Aaron (http://brandon.aaron.sh)
* Licensed under the MIT License (LICENSE.txt).
*
* Version 3.0.1
*
* Requires jQuery >= 1.2.6
*/
(function(a){if(typeof define==="function"&&define.amd){define(["jquery"],a)}else{if(typeof exports==="object"){module.exports=a}else{a(jQuery)}}}(function(a){a.fn.bgiframe=function(c){c=a.extend({top:"auto",left:"auto",width:"auto",height:"auto",opacity:true,src:"javascript:false;",conditional:/MSIE 6\.0/.test(navigator.userAgent)},c);if(!a.isFunction(c.conditional)){var e=c.conditional;c.conditional=function(){return e}}var d=a('<iframe class="bgiframe"frameborder="0"tabindex="-1"src="'+c.src+'"style="display:block;position:absolute;z-index:-1;"/>');return this.each(function(){var h=a(this);if(c.conditional(this)===false){return}var g=h.children("iframe.bgiframe");var f=g.length===0?d.clone():g;f.css({top:c.top=="auto"?((parseInt(h.css("borderTopWidth"),10)||0)*-1)+"px":b(c.top),left:c.left=="auto"?((parseInt(h.css("borderLeftWidth"),10)||0)*-1)+"px":b(c.left),width:c.width=="auto"?(this.offsetWidth+"px"):b(c.width),height:c.height=="auto"?(this.offsetHeight+"px"):b(c.height),opacity:c.opacity===true?0:undefined});if(g.length===0){h.prepend(f)}})};a.fn.bgIframe=a.fn.bgiframe;function b(c){return c&&c.constructor===Number?c+"px":c}}));
