
<h1>{L_CONTROL_PANEL_TITLE}</h1>

<p>{L_CONTROL_PANEL_EXPLAIN}</p>

<form method="post" action="{S_MODE_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
	  <td align="right" nowrap="nowrap"><span class="genmed">{L_VIEW}:&nbsp;{S_VIEW_SELECT}&nbsp;&nbsp; 
		<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
		</span></td>
	</tr>
  </table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th width="50%" nowrap="nowrap" height="25" class="thCornerL">{L_STATISTIC}</th>
	<th width="50%" height="25" class="thCornerR">{L_VALUE}</th>
  </tr>
  <tr> 
	<td class="row1" nowrap="nowrap">{L_NUMBER_OF_ATTACHMENTS}:</td>
	<td class="row2 thick">{NUMBER_OF_ATTACHMENTS}</td>
  </tr>
  <tr> 
	<td class="row1" nowrap="nowrap">{L_TOTAL_FILESIZE}:</td>
	<td class="row2 thick">{TOTAL_FILESIZE}</td>
  </tr>
  <tr> 
	<td class="row1" nowrap="nowrap">{L_ATTACH_QUOTA}:</td>
	<td class="row2 thick">{ATTACH_QUOTA}</td>
  </tr>
  <tr> 
	<td class="row1" nowrap="nowrap">{L_NUMBER_OF_POSTS}:</td>
	<td class="row2 thick">{NUMBER_OF_POSTS}</td>
  </tr>
  <tr> 
	<td class="row1" nowrap="nowrap">{L_NUMBER_OF_PMS}:</td>
	<td class="row2 thick">{NUMBER_OF_PMS}</td>
  </tr>
  <tr> 
	<td class="row1" nowrap="nowrap">{L_NUMBER_OF_TOPICS}:</td>
	<td class="row2 thick">{NUMBER_OF_TOPICS}</td>
  </tr>
  <tr> 
	<td class="row1" nowrap="nowrap">{L_NUMBER_OF_USERS}:</td>
	<td class="row2 thick">{NUMBER_OF_USERS}</td>
  </tr>
</table>
</form>

<br />
<div align="center"><span class="copyright">{ATTACH_VERSION}</span></div>
