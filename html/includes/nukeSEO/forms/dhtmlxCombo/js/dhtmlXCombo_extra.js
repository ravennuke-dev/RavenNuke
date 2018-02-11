/*
Copyright Scand LLC http://www.scbr.com

*/ 
dhtmlXCombo_imageOption = function(){
 this.init();
}
dhtmlXCombo_imageOption.prototype = new dhtmlXCombo_defaultOption;

dhtmlXCombo_imageOption.prototype.setValue = function(attr){
 this.value = attr.value||"";
 this.text = attr.text||"";
 this.css = attr.css||"";
 this.img_src = attr.img_src||this.getDefImage();
}
dhtmlXCombo_imageOption.prototype.render = function(){
 if(!this.content){
 this.content=document.createElement("DIV");
 this.content._self = this;
 this.content.style.cssText='width:100%;overflow:hidden;'+this.css;
 var html = '';
 if(this.img_src != '')
 html+= '<img style="float:left;" src="'+this.img_src+'" />';
 html+= '<div style="float:left">'+this.text+'</div>';
 this.content.innerHTML=html;
 
}
 return this.content;
}
dhtmlXCombo_imageOption.prototype.data = function(){
 return [this.value,this.text,this.img_src];
}


dhtmlXCombo_imageOption.prototype.DrawHeader = function(self,name,width)
{
 var z=document.createElement("DIV");
 z.style.width = width+"px";
 z.className = 'dhx_combo_box';
 z._self = self;
 self.DOMelem = z;
 this._DrawHeaderImage(self,name,width);
 this._DrawHeaderInput(self,name,width-18);
 this._DrawHeaderButton(self,name,width);
 self.DOMParent.appendChild(self.DOMelem);
}

dhtmlXCombo_imageOption.prototype._DrawHeaderImage = function(self,name,width)
{
 var z= document.createElement('img');
 z.src='';
 z.className = 'dhx_combo_option_img';
 z.style.visibility = 'hidden';
 self.DOMelem.appendChild(z);
 self.DOMelem_image=z;
}

dhtmlXCombo_imageOption.prototype.RedrawHeader = function(self)
{
 self.DOMelem_image.style.visibility = 'visible';
 self.DOMelem_image.src = this.img_src;
}

dhtmlXCombo_imageOption.prototype.getDefImage = function(self){return "";}

 
dhtmlXCombo.prototype.setDefaultImage=function(url){
 dhtmlXCombo_imageOption.prototype.getDefImage=function(){
 return url;
}
}






dhtmlXCombo_optionTypes['image'] = dhtmlXCombo_imageOption;

 
dhtmlXCombo_checkboxOption = function(){
 this.init();
}
dhtmlXCombo_checkboxOption.prototype = new dhtmlXCombo_defaultOption;

dhtmlXCombo_checkboxOption.prototype.setValue = function(attr){
 this.value = attr.value||"";
 this.text = attr.text||"";
 this.css = attr.css||"";
}
dhtmlXCombo_checkboxOption.prototype.render = function(){
 if(!this.content){
 this.content=document.createElement("DIV");
 this.content._self = this;
 this.content.style.cssText='width:100%;overflow:hidden;'+this.css;
 var html = '';
 html+= '<input style="float:left;" type="checkbox" />';
 html+= '<div style="float:left">'+this.text+'</div>';
 this.content.innerHTML=html;
 this.content.firstChild.onclick = function(e){(e||event).cancelBubble=true;}
}
 return this.content;
}
dhtmlXCombo_checkboxOption.prototype.data = function(){
 return [this.value,this.text,this.render().firstChild.value];
}


dhtmlXCombo_checkboxOption.prototype.DrawHeader = function(self,name,width)
{
 self.DOMelem = document.createElement("DIV");
 self.DOMelem.style.width = width+"px";
 self.DOMelem.className = 'dhx_combo_box';
 self.DOMelem._self = self;
 this._DrawHeaderCheckbox(self,name,width);
 this._DrawHeaderInput(self,name,width-18);
 this._DrawHeaderButton(self,name,width);
 self.DOMParent.appendChild(self.DOMelem);
}

dhtmlXCombo_checkboxOption.prototype._DrawHeaderCheckbox = function(self,name,width)
{
 var z= document.createElement('input');
 z.type='checkbox';
 z.className = 'dhx_combo_option_img';
 z.style.visibility = 'hidden';
 z.onclick = function(e){(e||event).cancelBubble=true;}
 self.DOMelem.appendChild(z);
 self.DOMelem_checkbox = z;
}

dhtmlXCombo_checkboxOption.prototype.RedrawHeader = function(self)
{
 self.DOMelem_checkbox.style.visibility = 'visible';
 self.DOMelem_checkbox.checked = this.content.firstChild.checked;
}


dhtmlXCombo_optionTypes['checkbox'] = dhtmlXCombo_checkboxOption;

 

