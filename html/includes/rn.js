/******************************************************/
/* A simple show/hide dhtml script by Raven                                */
/******************************************************/
/*<![CDATA[*/
function hideshow(which) {
  if (!document.getElementById) {
	 return;
  }
  if (which.style.display=="block") {
	 which.style.display="none";
  }
  else {
	 which.style.display="block";
  }
}

function gotoURL(dropDown) {
	URL=dropDown.options[dropDown.selectedIndex].value;
	if(URL.length>0) {
		top.location.href = URL;
	}
}
/*]]>*/