//>>built
require({cache:{"dijit/main":function(){define(["dojo/_base/kernel"],function(a){return a.dijit})},"dojox/main":function(){define(["dojo/_base/kernel"],function(a){return a.dojox})},"dojox/mobile/compat":function(){define(["dojo/_base/lang","dojo/sniff"],function(a,e){var b=a.getObject("dojox.mobile",!0);(!(e("webkit")||10===e("ie"))||!e("ie")&&6<e("trident"))&&require(["dojox/mobile/_compat"]);return b})},"*noref":1}});
define("dojox/mobile/app/compat",["dojo","dijit","dojox","dojo/require!dojox/mobile/compat"],function(a,e,b){a.provide("dojox.mobile.app.compat");a.require("dojox.mobile.compat");a.extend(b.mobile.app.AlertDialog,{_doTransition:function(f){console.log("in _doTransition and this \x3d ",this);var c=a.marginBox(this.domNode.firstChild).h,d=this.controller.getWindowSize().h,c=d-c,d=a.fx.slideTo({node:this.domNode,duration:400,top:{start:0>f?c:d,end:0>f?d:c}}),c=a[0>f?"fadeOut":"fadeIn"]({node:this.mask,
duration:400}),d=a.fx.combine([d,c]),b=this;a.connect(d,"onEnd",this,function(){0>f&&(b.domNode.style.display="none",a.destroy(b.domNode),a.destroy(b.mask))});d.play()}});a.extend(b.mobile.app.List,{deleteRow:function(){console.log("deleteRow in compat mode",b);var b=this._selectedRow;a.style(b,{visibility:"hidden",minHeight:"0px"});a.removeClass(b,"hold");var c=a.contentBox(b).h;a.animateProperty({node:b,duration:800,properties:{height:{start:c,end:1},paddingTop:{end:0},paddingBottom:{end:0}},onEnd:this._postDeleteAnim}).play()}});
b.mobile.app.ImageView&&!a.create("canvas").getContext&&a.extend(b.mobile.app.ImageView,{buildRendering:function(){this.domNode.innerHTML="ImageView widget is not supported on this browser.Please try again with a modern browser, e.g. Safari, Chrome or Firefox";this.canvas={}},postCreate:function(){}});b.mobile.app.ImageThumbView&&a.extend(b.mobile.app.ImageThumbView,{place:function(b,c,d){a.style(b,{top:d+"px",left:c+"px",visibility:"visible"})}})});