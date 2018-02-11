///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// This file is part of GCalendar
// displayCatLegend.js - Javascript for the categories legend.
///////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
///////////////////////////////////////////////////////////////////////

// This routine by Mark "Tarquin" Wilton-Jones
// http://www.howtocreate.co.uk/tutorials/javascript/dhtml

function changeDisplay( elementId, setTo ) {
   var theElement;
  if( document.getElementById ) {
    //DOM
    theElement = document.getElementById( elementId );
  } else if( document.all ) {
    //Proprietary DOM
    theElement = document.all[ elementId ];
  }
  if( !theElement ) {
    /* The page has not loaded, or the browser claims to
    support document.getElementById or document.all but
    cannot actually use either */
    return;
  }
  //Reference the style ...
  if( theElement.style ) { theElement = theElement.style; }
  if( typeof( theElement.display ) == 'undefined' ) {
    //The browser does not allow us to change the display style
    return;
  }
  //Change the display style
  theElement.display = setTo;
}

function gcalCatClick(box, value)
{
   var propValue = value ? 'inline' : 'none';
   for (var id in gcalCatMap[box])
   {
      var elemId = 'gcalid-' + gcalCatMap[box][id];
      changeDisplay(elemId, propValue);
   }
}

function gcalCatSetAll(state)
{
   var byId = document.getElementById;
   var byAll = document.all;
   if (!byId && !byAll)
   {
      return;
   }
   for (var chkBoxName in gcalCatMap)
   {
      var chkBox = byId ? document.getElementById(chkBoxName)
                        : document.all[chkBoxName];
      
      if (chkBox.checked != state)
      {
         chkBox.click();
      }
   }
}
