///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// This file is part of GCalendar
// eventForm.js - Javascript for the event form.
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

function changeTextById(elem, changeVal)
{
   if (!hasInnerText)
   {
      elem.textContent = changeVal;
   }
   else
   {
      elem.innerText = changeVal;
   }
}

function timeClick(disable)
{
   document.submitForm.sh.disabled     = disable;
   document.submitForm.sm.disabled     = disable;
   document.submitForm.smer.disabled   = disable;
   document.submitForm.eh.disabled     = disable;
   document.submitForm.em.disabled     = disable;
   document.submitForm.emer.disabled   = disable;
}
function endOnClick(disable)
{
   document.submitForm.edy.disabled = disable;
   document.submitForm.edm.disabled = disable;
   document.submitForm.edd.disabled = disable;
}
function repeatChange(val)
{
   switch (val)
   {
      default:
         document.getElementById('gcalEveryRow').style.visibility = 'hidden';
         document.getElementById('gcalEndOnRow1').style.visibility = 'hidden';
         document.getElementById('gcalEndOnRow2').style.visibility = 'hidden';
         document.getElementById('gcalWeeklyRow').style.visibility = 'hidden';
         document.getElementById('gcalRepeatByRow').style.visibility = 'hidden';
         document.getElementById('gcalDivRepeat').style.display = 'none';
         break;

      case '1':
         changeTextById(document.getElementById('gcalEveryUnits'), lDays);
         document.getElementById('gcalEveryRow').style.visibility = 'visible';
         document.getElementById('gcalEndOnRow1').style.visibility = 'visible';
         document.getElementById('gcalEndOnRow2').style.visibility = 'visible';
         document.getElementById('gcalWeeklyRow').style.visibility = 'hidden';
         document.getElementById('gcalRepeatByRow').style.visibility = 'hidden';
         document.getElementById('gcalDivRepeat').style.display = 'inline';
         break;

      case '2':
         changeTextById(document.getElementById('gcalEveryUnits'), lWeeks);
         document.getElementById('gcalEveryRow').style.visibility = 'visible';
         document.getElementById('gcalEndOnRow1').style.visibility = 'visible';
         document.getElementById('gcalEndOnRow2').style.visibility = 'visible';
         document.getElementById('gcalWeeklyRow').style.visibility = 'visible';
         document.getElementById('gcalRepeatByRow').style.visibility = 'hidden';
         document.getElementById('gcalDivRepeat').style.display = 'inline';
         break;

      case '3':
         changeTextById(document.getElementById('gcalEveryUnits'), lMonths);
         document.getElementById('gcalEveryRow').style.visibility = 'visible';
         document.getElementById('gcalEndOnRow1').style.visibility = 'visible';
         document.getElementById('gcalEndOnRow2').style.visibility = 'visible';
         document.getElementById('gcalWeeklyRow').style.visibility = 'hidden';
         document.getElementById('gcalRepeatByRow').style.visibility = 'visible';
         document.getElementById('gcalDivRepeat').style.display = 'inline';
         break;

      case '4':
         changeTextById(document.getElementById('gcalEveryUnits'), lYears);
         document.getElementById('gcalEveryRow').style.visibility = 'visible';
         document.getElementById('gcalEndOnRow1').style.visibility = 'visible';
         document.getElementById('gcalEndOnRow2').style.visibility = 'visible';
         document.getElementById('gcalWeeklyRow').style.visibility = 'hidden';
         document.getElementById('gcalRepeatByRow').style.visibility = 'hidden';
         document.getElementById('gcalDivRepeat').style.display = 'inline';
         break;
   }
}

function monthlyByChange(value)
{
   switch (value)
   {
      case '0':
         changeTextById(document.getElementById('gcalRepeatByEx'), lByDateEx);
         break;

      default:
         changeTextById(document.getElementById('gcalRepeatByEx'), lByDayEx);
         break;
   }
}

function gcalEventSubmit()
{
   if (document.gcalPressed == 'delete')
   {
      return confirm(lDelEventConfirm);
   }
   return true;
}
