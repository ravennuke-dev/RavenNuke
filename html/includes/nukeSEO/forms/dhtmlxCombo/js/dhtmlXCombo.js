/*
Copyright Scand LLC http://www.scbr.com

*/ 

 

 
function dhtmlXComboFromSelect(parent){
 if(typeof(parent)=="string")
 parent=document.getElementById(parent);

 var size=parent.offsetWidth;
 var z=document.createElement("SPAN");
 parent.parentNode.insertBefore(z,parent);
 parent.style.display='none';

 var s_type = parent.getAttribute('opt_type');

 var w= new dhtmlXCombo(z,parent.name,size,s_type);

 var x=new Array();
 var sel=0;
 for(var i=0;i<parent.options.length;i++){
 if(parent.options[i].selected)sel=i;
 var label=parent.options[i].innerHTML;
 var val=parent.options[i].getAttribute("value");
 if((typeof(val)=="undefined")||(val===null))val=label;
 x[i]=[val,label];
}

 w.addOption(x);
 parent.parentNode.removeChild(parent);
 w.selectOption(sel);
 return w;
}

var dhtmlXCombo_optionTypes = [];
 
function dhtmlXCombo(parent,name,width,optionType){
 if(typeof(parent)=="string")
 parent=document.getElementById(parent);

 this.optionType =(optionType != window.undefined && dhtmlXCombo_optionTypes[optionType])? optionType : 'default';
 this._optionObject = dhtmlXCombo_optionTypes[this.optionType];

 this._disabled = false;

 if(!window.dhx_glbSelectAr){
 window.dhx_glbSelectAr=new Array();
 window.dhx_openedSelect=null;
 window.dhx_SelectId=1;
 dhtmlxEvent(document.body,"click",this.closeAll);
 dhtmlxEvent(document.body,"keydown",function(e){try{if((e||event).keyCode==9)window.dhx_glbSelectAr[0].closeAll();}catch(e){}return true;});
}

 if(parent.tagName=="SELECT")
 dhtmlXComboFromSelect(parent);
 else
 this._createSelf(parent,name,width);
 dhx_glbSelectAr.push(this);
}
 
 dhtmlXCombo.prototype.enableFilteringMode = function(mode,url,cache,autosubload){
 this._filter=convertStringToBoolean(mode);

 if(url){
 this._xml=url;
 this._autoxml=convertStringToBoolean(autosubload);
}
 if(convertStringToBoolean(cache))this._xmlCache=[];
 this.DOMelem_button.style.display=(this._filter?"none":"");
}
 
 dhtmlXCombo.prototype.disable = function(mode){
 var z=convertStringToBoolean(mode);
 if(this._disabled==z)return;
 this.DOMelem_input.disabled=z;
 this._disabled=z;
}
 
 dhtmlXCombo.prototype.readonly = function(mode){
 this.DOMelem_input.readOnly=mode ? true : false;
}
 
 dhtmlXCombo.prototype.getOption = function(value)
{
 for(var i=0;i<this.optionsArr.length;i++)
 if(this.optionsArr[i].value==value)
 return this.optionsArr[i];
 return null;
}
 
 dhtmlXCombo.prototype.getOptionByLabel = function(value)
{
 for(var i=0;i<this.optionsArr.length;i++)
 if(this.optionsArr[i].text==value)
 return this.optionsArr[i];
 return null;
}
 
 dhtmlXCombo.prototype.getOptionByIndex = function(ind){
 return this.optionsArr[ind];
}
 
 dhtmlXCombo.prototype.clearAll = function()
{
 this.optionsArr=new Array();
 this.redrawOptions();
}
 
 dhtmlXCombo.prototype.deleteOption = function(value)
{
 var ind=this.getIndexByValue(value);
 if(ind<0)return;
 this.optionsArr.splice(ind,1);
 this.redrawOptions();
}

 
 dhtmlXCombo.prototype.render=function(mode){
 this._skiprender=(!convertStringToBoolean(mode));
 this.redrawOptions();
}

 
 dhtmlXCombo.prototype.updateOption = function(oldvalue,avalue,atext,acss)
{
 var dOpt=this.getOption(oldvalue);
 if(typeof(avalue)!="object")avalue={text:atext,value:avalue,css:acss};
 dOpt.setValue(avalue);
 this.redrawOptions();
}
 
 dhtmlXCombo.prototype.addOption = function(options)
{
 if(!arguments[0].length)
 args = [arguments];
 else
 args = options;

 this.render(false);
 for(var i=0;i<args.length;i++){
 var attr = args[i];
 if(attr.length){
 attr.value = attr[0]||"";
 attr.text = attr[1]||"";
 attr.css = attr[2]||"";
}
 this._addOption(attr);
}
 this.render(true);
}

 dhtmlXCombo.prototype._addOption = function(attr)
{
 dOpt = new this._optionObject();
 this.optionsArr.push(dOpt);
 dOpt.setValue.apply(dOpt,[attr]);
 this.redrawOptions();
}


 
 dhtmlXCombo.prototype.getIndexByValue = function(val){
 for(var i=0;i<this.optionsArr.length;i++)
 if(this.optionsArr[i].value == val)return i;
 return -1;
}

 
 dhtmlXCombo.prototype.getSelectedValue = function(){
 return(this._selOption?this._selOption.value:null);
}
 
 dhtmlXCombo.prototype.getComboText = function(){
 return this.DOMelem_input.value;
}
 
 dhtmlXCombo.prototype.setComboText = function(text){
 this.DOMelem_input.value=text;
}
 
 dhtmlXCombo.prototype.getActualValue = function(){
 return this.DOMelem_hidden_input.value;
}
 
 dhtmlXCombo.prototype.getSelectedText = function(){
 return(this._selOption?this._selOption.text:"");
}
 
 dhtmlXCombo.prototype.getSelectedIndex = function(){
 for(var i=0;i<this.optionsArr.length;i++)
 if(this.optionsArr[i] == this._selOption)return i;
 return -1;
}
 
 dhtmlXCombo.prototype.setName = function(name){
 this.DOMforSbm.name = name;
 this.name = name;
}
 
 dhtmlXCombo.prototype.show = function(mode){
 if(convertStringToBoolean(mode))
 this.DOMelem.style.display = "";
 else
 this.DOMelem.style.display = "none";
}

 
 dhtmlXCombo.prototype.destructor = function()
{
 var _sID = this._inID;
 this.DOMParent.removeChild(this.DOMelem);
 this.DOMlist.parentNode.removeChild(this.DOMlist);
 var s=dhx_glbSelectAr;
 this.DOMParent=this.DOMlist=this.DOMelem=0;
 this.DOMlist.combo=this.DOMelem.combo=0;
 for(var i=0;i<s.length;i++)
{
 if(s[i]._inID == _sID)
{
 this._selectsArr[i] = null;
 this._selectsArr.splice(i,1);
 return;
}
}
}

 
 dhtmlXCombo.prototype._createSelf = function(selParent,name,width)
{
 width=width||100;
 this.ListPosition = "Bottom";
 this.DOMParent = selParent;
 this._inID = null;
 this.name = name;

 this._selOption = null;
 this.optionsArr = Array();

 var opt = new this._optionObject();
 opt.DrawHeader(this,name,width);
 
 this.DOMlist = document.createElement("DIV");
 this.DOMlist.className = 'dhx_combo_list';
 this.DOMlist.style.width=width-(_isIE?0:0)+"px";
 this.DOMlist.style.display = "none";
 document.body.insertBefore(this.DOMlist,document.body.firstChild);
 if(_isIE){
 this.DOMlistF = document.createElement("IFRAME");
 this.DOMlistF.style.border="0px";
 this.DOMlistF.className = 'dhx_combo_list';
 this.DOMlistF.style.width=width-(_isIE?0:0)+"px";
 this.DOMlistF.style.display = "none";
 document.body.insertBefore(this.DOMlistF,document.body.firstChild);
}



 this.DOMlist.combo=this.DOMelem.combo=this;

 this.DOMelem_input.onkeydown = this._onKey;
 this.DOMelem_input.onkeypress = this._onKeyF;
 this.DOMelem_input.onblur = this._onChange;
 this.DOMelem.onclick = this._toggleSelect;
 this.DOMlist.onclick = this._selectOption;
 this.DOMlist.onmouseover = this._listOver;
}

 dhtmlXCombo.prototype._listOver = function(e)
{
 e = e||event;
 e.cancelBubble = true;
 var node =(_isIE?event.srcElement:e.target);
 var that = this.combo;
 if(node.parentNode == that.DOMlist){
 that.unSelectOption();
 var i=0;
 for(i;i<that.DOMlist.childNodes.length;i++){
 if(that.DOMlist.childNodes[i]==node)break;
}
 var z=that.optionsArr[i];
 that._selOption=z;
 that._selOption.select();
}

}

 
 dhtmlXCombo.prototype._positList = function()
{
 var pos=this.getPosition(this.DOMelem);
 if(this.ListPosition == 'Bottom'){
 this.DOMlist.style.top = pos[1]+this.DOMelem.offsetHeight+"px";
 this.DOMlist.style.left = pos[0]+"px";
}
 else{
 this.DOMlist.style.top = pos[1]+"px";
 this.DOMlist.style.left = pos[0]+this.DOMelem.offsetWidth+"px";
}
}
 dhtmlXCombo.prototype.getPosition = function(oNode,pNode){

 if(!pNode)
 var pNode = document.body

 var oCurrentNode=oNode;
 var iLeft=0;
 var iTop=0;
 while((oCurrentNode)&&(oCurrentNode!=pNode)){
 iLeft+=oCurrentNode.offsetLeft-oCurrentNode.scrollLeft;
 iTop+=oCurrentNode.offsetTop-oCurrentNode.scrollTop;
 oCurrentNode=oCurrentNode.offsetParent;
}
 if(pNode == document.body){
 if(_isIE){
 if(document.documentElement.scrollTop)
 iTop+=document.documentElement.scrollTop;
 if(document.documentElement.scrollLeft)
 iLeft+=document.documentElement.scrollLeft;
}
 else
 if(!_isFF){
 iLeft+=document.body.offsetLeft;
 iTop+=document.body.offsetTop;
}
}
 return new Array(iLeft,iTop);
}
 
 dhtmlXCombo.prototype._correctSelection = function(){
 for(var i=0;i<this.optionsArr.length;i++)
 if(!this.optionsArr[i].isHidden())
 return this.selectOption(i,true);
}
 
 dhtmlXCombo.prototype.selectNext = function(step){
 var z=this.getSelectedIndex()+step;
 while(this.optionsArr[z]){
 if(!this.optionsArr[z].isHidden())
 return this.selectOption(z);
 z+=step;
}
}
 
 dhtmlXCombo.prototype._onKeyF = function(e){
 var that=this.parentNode.combo;
 var ev=e||event;
 if(ev.keyCode=="13" || ev.keyCode=="27"){
 that.closeAll();
 return false;
}
 return true;
}
 
 dhtmlXCombo.prototype._onKey = function(e){
 var that=this.parentNode.combo;
 var ev=(e||event).keyCode;

 if((that.DOMlist.style.display!="block")&&(ev!="13")&&(ev!="9"))
 that.DOMelem.onclick(e||event);

 window.setTimeout(function(){that._onKeyB(ev);},1);
}
 dhtmlXCombo.prototype._onKeyB = function(ev)
{
 if(ev=="40"){
 var z=this.selectNext(1);
}else if(ev=="38"){
 this.selectNext(-1);
}else{
 if(this._filter)return this.filterSelf((ev==8)||(ev==46));
 for(var i=0;i<this.optionsArr.length;i++)
 if(this.optionsArr[i].data()[1]==this.DOMelem_input.value){
 
 this.selectOption(i);
 return false;
}
 this.unSelectOption();
}
 return true;
}


 
 dhtmlXCombo.prototype._onChange = function()
{
 var self = this.parentNode._self;
 var z=self.getOptionByLabel(self.DOMelem_input.value);

 self.DOMelem_hidden_input.value = z?z.value:self.DOMelem_input.value;
 self.DOMelem_hidden_input2.value =(z==null);
}
 
 dhtmlXCombo.prototype.redrawOptions = function(){
 if(this._skiprender)return;
 for(var i=this.DOMlist.childNodes.length-1;i>=0;i--)
 this.DOMlist.removeChild(this.DOMlist.childNodes[i]);
 for(var i=0;i<this.optionsArr.length;i++)
 this.DOMlist.appendChild(this.optionsArr[i].render());
}
 
 dhtmlXCombo.prototype.loadXML = function(url){
 this._load=true;
 if((this._xmlCache)&&(this._xmlCache[url]))
 this._fillFromXML(this,null,null,null,this._xmlCache[url]);
 else{
 var xml=(new dtmlXMLLoaderObject(this._fillFromXML,this,true,true));
 xml._cPath=url;
 xml.loadXML(url);
}
}

 
 dhtmlXCombo.prototype.loadXMLString = function(astring){
 var xml=(new dtmlXMLLoaderObject(this._fillFromXML,this,true,true));
 xml.loadXMLString(astring);
}

 
 dhtmlXCombo.prototype._fillFromXML = function(obj,b,c,d,xml){
 if(obj._xmlCache)obj._xmlCache[xml._cPath]=xml;

 var top=xml.doXPath("//complete");
 var options=xml.doXPath("//option");
 obj.render(false);
 if((!top[0])||(!top[0].getAttribute("add"))){
 obj.clearAll();
 obj._lastLength=options.length;
}else
 obj._lastLength+=options.length;

 for(var i=0;i<options.length;i++){
 var attr = new Object();
 attr.text = options[i].firstChild?options[i].firstChild.nodeValue:"";
 for(var j=0;j<options[i].attributes.length;j++){
 var a = options[i].attributes[j];
 if(a)
 attr[a.nodeName] = a.nodeValue;
}
 obj._addOption(attr);
}
 obj.render(true);
 if((obj._load)&&(obj._load!==true))
 obj.loadXML(obj._load);
 else{
 obj._load=false;
 if((!obj._lkmode)&&(!obj._filter))
 obj._correctSelection();
}

}
 
 dhtmlXCombo.prototype.unSelectOption = function(){
 if(this._selOption)
 this._selOption.deselect();
 this._selOption=null;
}
 
 dhtmlXCombo.prototype.selectOption = function(ind,filter){
 this.unSelectOption();
 var z=this.optionsArr[ind];
 if(!z)return;
 this._selOption=z;
 this._selOption.select();

 var corr=this._selOption.content.offsetTop+this._selOption.content.offsetHeight-this.DOMlist.scrollTop-this.DOMlist.offsetHeight;
 if(corr>0)this.DOMlist.scrollTop+=corr;
 corr=this.DOMlist.scrollTop-this._selOption.content.offsetTop;
 if(corr>0)this.DOMlist.scrollTop-=corr;

 var data=this._selOption.data();

 this.DOMelem_hidden_input.value=data[0];
 this.DOMelem_hidden_input2.value = "false";
 if((this._autoxml)&&((ind+1)==this._lastLength))
 this._fetchOptions(ind+1,this._lasttext||"");

 if(filter){
 var text=this.getComboText();
 if(text!=data[1]){
 this.setComboText(data[1]);
 dhtmlXRange(this.DOMelem_input,text.length+1,data[1].length);
}
}
 else
 this.setComboText(data[1]);
 this._selOption.RedrawHeader(this);
}
 
 dhtmlXCombo.prototype._selectOption = function(e)
{
(e||event).cancelBubble = true;
 var node=(_isIE?event.srcElement:e.target);
 var that=this.combo;
 while(!node._self){
 node = node.parentNode;
 if(!node)
 return;
}

 var i=0;
 for(i;i<that.DOMlist.childNodes.length;i++){
 if(that.DOMlist.childNodes[i]==node)break;
}
 that.selectOption(i);
 that.closeAll();
}
 
 dhtmlXCombo.prototype.openSelect = function(){
 if(this._disabled)return;
 this.closeAll();
 this._positList();
 this.DOMlist.style.display="block";
 if(_isIE)this._IEFix(true);
 this.DOMelem_input.focus();

 if(this._filter)this.filterSelf();
}
 
 dhtmlXCombo.prototype._toggleSelect = function(e)
{
 var that=this.combo;
 if(that.DOMlist.style.display == "block"){
 that.closeAll();
}else{
 that.openSelect();
}
(e||event).cancelBubble = true;
}

 dhtmlXCombo.prototype._fetchOptions=function(ind,text){
 if(text=="")return this.clearAll();
 var url=this._xml+((this._xml.indexOf("?")!=-1)?"&":"?")+"pos="+ind+"&mask="+escape(text);
 this._lasttext=text;
 if(this._load)this._load=url;
 else this.loadXML(url);
}
 
 dhtmlXCombo.prototype.filterSelf = function(mode)
{
 var text=this.getComboText();
 if(this._xml){
 this._lkmode=mode;
 this._fetchOptions(0,text);
}
 try{var filter=new RegExp("^"+text,"i");}catch(e){var filter=new RegExp("^"+text.replace(/[\[\]\{\}\(\)]/g,"\\&1"));}

 var ind=-1;
 for(var i=0;i<this.optionsArr.length;i++)
 this.optionsArr[i].hide(!filter.test(this.optionsArr[i].text));

 if(!mode)
 this._correctSelection();
}


 
 dhtmlXCombo.prototype._IEFix = function(mode){
 this.DOMlistF.style.display=(mode?"block":"none");
 this.DOMlistF.style.top=this.DOMlist.style.top;
 this.DOMlistF.style.left=this.DOMlist.style.left;
}
 
 dhtmlXCombo.prototype.closeAll = function()
{
 if(window.dhx_glbSelectAr)
 for(var i=0;i<dhx_glbSelectAr.length;i++)
 if(dhx_glbSelectAr[i].DOMlist.style.display=="block"){
 dhx_glbSelectAr[i].DOMlist.style.display = "none";
 if(_isIE)dhx_glbSelectAr[i]._IEFix(false);
}
}
 
function dhtmlXRange(InputId,Start,End)
{
 var Input = typeof(InputId)=='object' ? InputId : document.getElementById(InputId);
 try{Input.focus();}catch(e){};
 var Length = Input.value.length;
 Start--;
 if(Start < 0 || Start > End || Start > Length)
 Start = 0;
 if(End > Length)
 End = Length;
 if(Input.setSelectionRange){
 Input.setSelectionRange(Start,End);
}else if(Input.createTextRange){
 var range = Input.createTextRange();
 range.moveStart('character',Start);
 range.moveEnd('character',End-Length);
 range.select();
}
}
 
 dhtmlXCombo_defaultOption = function(){
 this.init();
}
 
 dhtmlXCombo_defaultOption.prototype.init = function(){
 this.value = null;
 this.text = "";
 this.selected = false;
 this.css = "";
}
 
 dhtmlXCombo_defaultOption.prototype.select = function(){
 if(this.content);
 this.content.className="dhx_selected_option";
}
 
 dhtmlXCombo_defaultOption.prototype.hide = function(mode){
 this.render().style.display=mode?"none":"";
}
 
 dhtmlXCombo_defaultOption.prototype.isHidden = function(){
 return(this.render().style.display=="none");
}
 
 dhtmlXCombo_defaultOption.prototype.deselect = function(){
 if(this.content)this.render();
 this.content.className="";
}
 
dhtmlXCombo_defaultOption.prototype.setValue = function(attr){
 this.value = attr.value||"";
 this.text = attr.text||"";
 this.css = attr.css||"";
 this.content=null;
}
 
 dhtmlXCombo_defaultOption.prototype.render = function(){
 if(!this.content){
 this.content=document.createElement("DIV");
 this.content._self = this;
 this.content.style.cssText='width:100%;overflow:hidden;"+this.css+"';
 this.content.innerHTML=this.text;
}
 return this.content;
}
 
 dhtmlXCombo_defaultOption.prototype.data = function(){
 return [this.value,this.text];
}

dhtmlXCombo_defaultOption.prototype.DrawHeader = function(self,name,width)
{
 var z=document.createElement("DIV");
 z.style.width = width+"px";
 z.className = 'dhx_combo_box';
 z._self = self;
 self.DOMelem = z;
 this._DrawHeaderInput(self,name,width);
 this._DrawHeaderButton(self,name,width);
 self.DOMParent.appendChild(self.DOMelem);
}

dhtmlXCombo_defaultOption.prototype._DrawHeaderInput = function(self,name,width)
{
 var z=document.createElement('input');
 z.className = 'dhx_combo_input';
 z.type = 'text';
 z.style.width =(width-19)+'px';
 self.DOMelem.appendChild(z);
 self.DOMelem_input = z;

 z = document.createElement('input');
 z.type = 'hidden';
 z.name = name;
 self.DOMelem.appendChild(z);
 self.DOMelem_hidden_input = z;

 z = document.createElement('input');
 z.type = 'hidden';
 z.name = name+"_new_value";
 z.value="true";
 self.DOMelem.appendChild(z);
 self.DOMelem_hidden_input2 = z;
}

dhtmlXCombo_defaultOption.prototype._DrawHeaderButton = function(self,name,width)
{
 var z=document.createElement('img');
 z.className = 'dhx_combo_img';
 z.src =(window.dhx_globalImgPath?dhx_globalImgPath:"")+'combo_select.gif';
 self.DOMelem.appendChild(z);
 self.DOMelem_button=z;
}

dhtmlXCombo_defaultOption.prototype.RedrawHeader = function(self)
{
}


dhtmlXCombo_optionTypes['default'] = dhtmlXCombo_defaultOption;

