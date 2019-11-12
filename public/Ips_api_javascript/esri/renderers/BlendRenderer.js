// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/3.17/esri/copyright.txt for details.
//>>built
define("esri/renderers/BlendRenderer","dojo/_base/declare dojo/_base/lang dojo/_base/array dojo/dom-construct dojo/has ../kernel ../Color ./Renderer".split(" "),function(d,l,f,n,p,q,m,r){d=d(r,{declaredClass:"esri.renderer.BlendRenderer",constructor:function(a){l.mixin(this,a);this.blendMode=this.blendMode||"source-over";(this._supportsCanvas=window.CanvasRenderingContext2D?!0:!1)||console.log("BlendRenderer requires a Canvas enabled Browser. Internet Explorer versions 8 and earlier do not support Canvas.");
this._updateCache()},setFields:function(a){this.fields=a;this._updateCache()},setSymbol:function(a){this.symbol=a},setBlendMode:function(a){this.blendMode=a},setOpacityStops:function(a){this.opacityStops=a;this._updateCache()},setNormalizationField:function(a){this.normalizationField=a;this._updateCache()},toJson:function(){},getSymbol:function(a){var b=this.fields,c=this._dataCache,g=this._opacityInfos;if(this._supportsCanvas&&c&&g){var e,h,d=[],k={};f.forEach(b,function(b,f){this._getColorComponent(a,
g[f],c[f],!0,k);h=b.color.toRgba();h[3]=k.value||0;e=new m(h);e._data=k.data;d.push(e)},this);d.sort(this._colorSorter);this.symbol.setColor(this._getBlendedColor(d));return this.symbol}},_colorSorter:function(a,b){var c=null!=a._data,g=null!=b._data;return c&&g?a._data-b._data:c?1:g?-1:0},_getBlendedColor:function(a){var b,c=this._canvas;c||(c=this._canvas=this._createCanvas(1,1));b=c.getContext("2d");b.globalCompositeOperation=this.blendMode;f.forEach(a,function(a){b.fillStyle=a.toCss(!0);b.fillRect(0,
0,1,1)});a=b.getImageData(0,0,1,1).data;b.clearRect(0,0,c.width,c.height);return new m([a[0],a[1],a[2],a[3]/255])},_createCanvas:function(a,b){return n.create("canvas",{width:a+"px",height:b+"px",style:"position: absolute; left: -10000px; top: 0px;"},document.body)},_updateCache:function(){var a=this.fields,b=this.opacityStops;this._dataCache=this._opacityInfos=null;if(a&&b){var c=this._dataCache=[],d=this._opacityInfos=[],e;f.forEach(a,function(a){e={field:a.field,normalizationField:this.normalizationField,
stops:b};d.push(e);c.push(this._processOpacityInfo(e))},this)}}});p("extend-esri")&&l.setObject("renderer.BlendRenderer",d,q);return d});