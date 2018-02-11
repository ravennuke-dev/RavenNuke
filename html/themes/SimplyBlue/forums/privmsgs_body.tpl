<script language="javascript" type="text/javascript">
//<![CDATA[
	//
	// Should really check the browser to stop this whining ...
	//
	function select_switch(status)
	{
		for (i = 0; i < document.privmsg_list.length; i++)
		{
			document.privmsg_list.elements[i].checked = status;
		}
	}
//]]>
</script>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
  <tr> 
	<td align="right"> 
	<!-- BEGIN switch_box_size_notice -->
	<table width="175" cellspacing="1" cellpadding="2" border="0" class="bodyline">
	<tr> 
		<td colspan="3" width="175" class="row1" nowrap="nowrap"><span class="gensmall">{ATTACH_BOX_SIZE_STATUS}</span></td>
	</tr>
	<tr> 
		<td colspan="3" width="175" class="row2">
			<table cellspacing="0" cellpadding="1" border="0">
			<tr> 
				<td bgcolor="{T_TD_COLOR2}"><img src="{SPACE_IMG}" width="{ATTACHBOX_LIMIT_IMG_WIDTH}" height="8" alt="{ATTACH_LIMIT_PERCENT}" /></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<td width="33%" class="row1"><span class="gensmall">0%</span></td>
		<td width="34%" align="center" class="row1"><span class="gensmall">50%</span></td>
		<td width="33%" align="right" class="row1"><span class="gensmall">100%</span></td>
	</tr>
	</table>
	<!-- END switch_box_size_notice -->
	</td>
  </tr>
</table>
<table cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td>{INBOX_IMG}</td>
<td class="nav">{INBOX} &nbsp;</td>
<td>{SENTBOX_IMG}</td>
<td class="nav">{SENTBOX} &nbsp;</td>
<td>{OUTBOX_IMG}</td>
<td class="nav">{OUTBOX} &nbsp;</td>
<td>{SAVEBOX_IMG}</td>
<td class="nav">{SAVEBOX} &nbsp;</td>
</tr>
</table>
<form method="post" name="privmsg_list" action="{S_PRIVMSGS_ACTION}">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td>{POST_PM_IMG}</td>
<td class="nav" width="100%">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a></td>
<td align="right" nowrap="nowrap"><table border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="gensmall" nowrap="nowrap">{L_DISPLAY_MESSAGES}:&nbsp;</td>
<td><select name="msgdays">{S_SELECT_MSG_DAYS}</select>&nbsp;</td>
<td><input type="submit" value="{L_GO}" name="submit_msgdays" class="catbutton" /></td>
</tr>
</table>
</td>
</tr>
</table>
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th>&nbsp;{L_FLAG}&nbsp;</th>
<th width="55%">&nbsp;{L_SUBJECT}&nbsp;</th>
<th width="20%">&nbsp;{L_FROM_OR_TO}&nbsp;</th>
<th width="15%">&nbsp;{L_DATE}&nbsp;</th>
<th width="5%">&nbsp;{L_MARK}&nbsp;</th>
</tr>
<!-- BEGIN listrow -->
<tr>
<td class="{listrow.ROW_CLASS}" align="center" height="30">{listrow.PRIVMSG_ATTACHMENTS_IMG}<a href="{listrow.U_READ}"><img src="{listrow.PRIVMSG_FOLDER_IMG}" width="33" height="25" alt="{listrow.L_PRIVMSG_FOLDER_ALT}" title="{listrow.L_PRIVMSG_FOLDER_ALT}" border="0" /></a></td>
<td class="{listrow.ROW_CLASS}">&nbsp;<a href="{listrow.U_READ}" class="topictitle">{listrow.SUBJECT}</a></td>
<td width="20%" align="center" class="{listrow.ROW_CLASS}">&nbsp;<a href="{listrow.U_FROM_USER_PROFILE}" class="postdetails">{listrow.FROM}</a></td>
<td width="15%" align="center" class="{listrow.ROW_CLASS}"><span class="postdetails">{listrow.DATE}</span></td>
<td width="5%" align="center" class="{listrow.ROW_CLASS}"><span class="postdetails">
<input type="checkbox" name="mark[]2" value="{listrow.S_MARK_ID}" />
</span></td>
</tr>
<!-- END listrow -->
<!-- BEGIN switch_no_messages -->
<tr>
<td class="row1" colspan="5" align="center"><span class="genbold">{L_NO_MESSAGES}</span></td>
</tr>
<!-- END switch_no_messages -->
<tr>
<td class="cat" colspan="5" align="right"> {S_HIDDEN_FIELDS}
<input type="submit" name="save" value="{L_SAVE_MARKED}" class="mainoption" />&nbsp;
<input type="submit" name="delete" value="{L_DELETE_MARKED}" class="button" />	&nbsp;
<input type="submit" name="deleteall" value="{L_DELETE_ALL}" class="button" />
</td>
</tr>
</table>
<table width="100%" cellspacing="2" border="0" cellpadding="2">
<tr>
<td>{POST_PM_IMG}</td>
<td class="nav" width="100%">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a></td>
<td class="gensmall" align="right" valign="top" nowrap="nowrap"><strong>
<!-- BEGIN switch_box_size_notice -->
{BOX_SIZE_STATUS} ::
<!-- END switch_box_size_notice -->
<a href="javascript:select_switch(true);">{L_MARK_ALL}</a> :: <a href="javascript:select_switch(false);">{L_UNMARK_ALL}</a></strong></td>
</tr>
<tr>
<td class="nav" colspan="3">{PAGINATION}</td>
</tr>
</table>
</form>
<div align="left">{JUMPBOX}</div>
