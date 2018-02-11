
/* DHTML Color Sphere v1.0.1, Programming by Ulyses, ColorJack.com */
/* Updated August 24th, 2007 */
/* Enhanced for nukeFEED */

function $(v) { return(document.getElementById(v)); }
function $S(v) { return(document.getElementById(v).style); }
function absPos(e) { var r={x:e.offsetLeft,y:e.offsetTop}; if(e.offsetParent) { var v=absPos(e.offsetParent); r.x+=v.x; r.y+=v.y; } return(r); }
function agent(v) { return(Math.max(navigator.userAgent.toLowerCase().indexOf(v),0)); }
function isset(v) { return((typeof(v)=='undefined' || v.length==0)?false:true); }
function toggle(i,t,xy) { var v=$S(i); v.display=t?t:(v.display=='none'?'block':'none'); if(xy) { v.left=xy[0]; v.top=xy[1]; } }
function XY(e,v) { var z=agent('msie')?Array(event.clientX+document.body.scrollLeft,event.clientY+document.body.scrollTop):Array(e.pageX,e.pageY); return(v==3?z:z[zero(v)]); }
function XYwin(v) { var z=agent('msie')?[document.body.clientHeight,document.body.clientWidth]:[window.innerHeight,window.innerWidth]; return(!isNaN(v)?z[v]:z); }
function zero(v) { v=parseInt(v); return(!isNaN(v)?v:0); }
function zindex(d) { d.style.zIndex=zINDEX++; }	

function changeAttributeColor(o,s,a) {	
  if ($(o).value.substring(6) > '') return false;
  if (a=='background') $S(s).background='#'+$(o).value;
  if (a=='color')	$S(s).color='#'+$(o).value; 
}
/* PLUGIN */

var stop=1;

function cords(o,W) {

	var W2=W/2, rad=(hsv[0]/360)*(Math.PI*2), hyp=(hsv[1]+(100-hsv[2]))/100*(W2/2);

	$S(o+'_Cur').left=Math.round(Math.abs(Math.round(Math.sin(rad)*hyp)+W2+3))+'px';
	$S(o+'_Cur').top=Math.round(Math.abs(Math.round(Math.cos(rad)*hyp)-W2-21))+'px';

}

function coreXY(o,a,e,xy,z,fu) {
	function point(a,b,e) { eZ=XY(e,3); commit([eZ[0]+a,eZ[1]+b]); }
	function M(v,a,z) { return(Math.max(!isNaN(z)?z:0,!isNaN(a)?Math.min(a,v):v)); }

	function commit(v) { 
    if(fu) fu(v);
	
		if(a=='_Cur') { 
      var W=parseInt($S(o+'_Spec').width), W2=W/2, W3=W2/2; 
			var x=v[0]-W2-3, y=W-v[1]-W2+21, SV=Math.sqrt(Math.pow(x,2)+Math.pow(y,2)), hue=Math.atan2(x,y)/(Math.PI*2);
			hsv=[hue>0?(hue*360):((hue*360)+360), SV<W3?(SV/W3)*100:100, SV>=W3?Math.max(0,1-((SV-W3)/(W2-W3)))*100:100];
			$(o+'_HEX').innerHTML=hsv2hex(hsv); document.getElementById(o.substring(2)).value=$(o+'_HEX').innerHTML; document.getElementById(o.substring(2)).style.color='#'+$(o+'_HEX').innerHTML; cords(o,W);
      changeAttributeColor(o.substring(2), document.getElementById(o.substring(2)+'_disp').value, document.getElementById(o.substring(2)+'_attr').value);

		}
		else if(a=='_Size') { 
      var b=Math.max(Math.max(v[0],v[1])+oH,75); cords(o,b);
			$S(o).height=(b+28)+'px'; $S(o).width=(b+20)+'px';
			$S(o+'_Spec').height=b+'px'; $S(o+'_Spec').width=b+'px';

		}
		else {
			if(xy) v=[M(v[0],xy[0],xy[2]), M(v[1],xy[1],xy[3])]; // XY LIMIT
			if(!xy || xy[0]) d.left=v[0]+'px'; if(!xy || xy[1]) d.top=v[1]+'px';

		}
	}

	if(stop) { 
    stop=''; var d=$S(o+a), eZ=XY(e,3); if(!z) zindex($(o+a));
		if(a=='_Cur') { var ab=absPos($(o+'_Cur').parentNode); point(-(ab['x']-5),-(ab['y']-28),e); }
		if(a=='_Size') { var oH=parseInt($S(o+'_Spec').height), oX=-XY(e), oY=-XY(e,1); } else { var oX=parseInt(d.left)-eZ[0], oY=parseInt(d.top)-eZ[1]; }
		document.onmousemove=function(e){ if(!stop) point(oX,oY,e); };
		document.onmouseup=function(){ stop=1; document.onmousemove=''; document.onmouseup=''; };

	}
}

/* CONVERSIONS */

function toHex(v) { v=Math.round(Math.min(Math.max(0,v),255)); return("0123456789ABCDEF".charAt((v-v%16)/16)+"0123456789ABCDEF".charAt(v%16)); }
function rgb2hex(r) { return(toHex(r[0])+toHex(r[1])+toHex(r[2])); }
function hsv2hex(h) { return(rgb2hex(hsv2rgb(h))); }
function hex2hsv(x) {return(rgb2hsv(hex2rgb(x))); }
function hex2rgb(h) { return [parseInt(h.substring(0,2), 16), parseInt(h.substring(2,4), 16), parseInt(h.substring(4,6), 16)]; }

function rgb2hsv(rgb) {
    var r = (rgb[0] / 255);                     //RGB values = 0 ÷ 255
    var g = (rgb[1] / 255);
    var b = (rgb[2] / 255);
    
    var min = Math.min(r, g, b)    //Min. value of RGB
    var max = Math.max(r, g, b)    //Max. value of RGB
    var delta = max - min          //Delta RGB value
    
    var v = max, s, h;
    
    if (delta == 0) {                    //This is a gray, no chroma...
       h = 0;                            //HSV results = 0 ÷ 1
       s = 0;
    } else {                             //Chromatic data...
       s = delta / max;
       
       var dr = r / delta;
       var dg = g / delta;
       var db = b / delta;
       
       if      (r == max) h = db - dg;
       else if (g == max) h = (1 / 3) + db - dr;
       else if (b == max) h = (2 / 3) + dr - dg;
       
       if (h < 0) h += 1;
       if (h > 1) h -= 1;
    }
    
    return [h*360, s*100, v*100];
  }

function hsv2rgb(r) { // easyrgb.com/math.php?MATH=M21#text21

    var R,B,G,S=r[1]/100,V=r[2]/100,H=r[0]/360;

    if(S>0) { 
        if(H>=1) H=0;

        H=6*H; F=H-Math.floor(H);
        A=Math.round(255*V*(1.0-S));
        B=Math.round(255*V*(1.0-(S*F)));
        C=Math.round(255*V*(1.0-(S*(1.0-F))));
        V=Math.round(255*V); 

        switch(Math.floor(H)) {

            case 0: R=V; G=C; B=A; break;
            case 1: R=B; G=V; B=A; break;
            case 2: R=A; G=V; B=C; break;
            case 3: R=A; G=B; B=V; break;
            case 4: R=C; G=A; B=V; break;
            case 5: R=V; G=A; B=B; break;

        }

        return([R?R:0,G?G:0,B?B:0]);

    }
    else return([(V=Math.round(V*255)),V,V]);

}

/* GLOBALS */

var zINDEX=1000, hsv=[0,0,100];