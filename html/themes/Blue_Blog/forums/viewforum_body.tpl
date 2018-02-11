<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td class="nav" valign="top"><a class="maintitle" href="{U_VIEW_FORUM}" title="{FORUM_NAME}">{FORUM_NAME}</a><br />
{PAGINATION}</td>
<td class="gensmall" align="right" valign="bottom">{L_MODERATOR}: {MODERATORS}<br />
{LOGGED_IN_USER_LIST}<br />
<strong><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></strong></td>
</tr>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" width="82" height="25" /></a></td>
<td align="left" valign="middle" class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a>
<!-- BEGIN switch_parent_link -->
 -> <a class="nav" href="{PARENT_URL}">{PARENT_NAME}</a>
<!-- END switch_parent_link -->
 -> <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span></td>
</tr>
</table>
<!-- BEGIN switch_attached_list -->
   <br />
   <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">
     <tr>
		<th colspan="2" class="thCornerL" height="15" nowrap="nowrap">&nbsp;{switch_attached_list.L_ATTACHED_FORUM}&nbsp;</th>
		<th width="50" class="thTop" nowrap="nowrap">&nbsp;{switch_attached_list.L_ATTACHED_TOPICS}&nbsp;</th>
		<th width="50" class="thTop" nowrap="nowrap">&nbsp;{switch_attached_list.L_ATTACHED_POSTS}&nbsp;</th>
		<th width="50" class="thTop" nowrap="nowrap">&nbsp;{switch_attached_list.L_LAST_POST}&nbsp;</th>
     </tr>
	<!-- BEGIN switch_attached_present -->
	<tr>
		<td class="row1" align="center" valign="middle" height="38" width="50"><img src="{switch_attached_list.switch_attached_present.FORUM_FOLDER_IMG}" width="33" height="25" alt="{switch_attached_list.switch_attached_present.L_FORUM_FOLDER_ALT}" title="{switch_attached_list.switch_attached_present.L_FORUM_FOLDER_ALT}" /></td>
		<td class="row1" width="75%"><span class="forumlink"><a class="topictitle" href="{switch_attached_list.switch_attached_present.U_VIEWFORUM}">{switch_attached_list.switch_attached_present.FORUM_NAME}</a></span><br /><span class="genmed">{switch_attached_list.switch_attached_present.FORUM_DESC}</span></td>
		<td class="row2" align="center" valign="middle"><span class="gensmall">{switch_attached_list.switch_attached_present.TOPICS}</span></td>
		<td class="row2" align="center" valign="middle"><span class="gensmall">{switch_attached_list.switch_attached_present.POSTS}</span></td>
		<td class="row2" align="center" nowrap="nowrap" valign="middle"><span class="gensmall">{switch_attached_list.switch_attached_present.LAST_POST_ID}</span></td>
	</tr>
	<!-- END switch_attached_present -->
   </table>
   <br />
<!-- END switch_attached_list -->
<table border="0" cellpadding="2" cellspacing="1" width="100%" class="forumline">
<tr>
<th colspan="2">&nbsp;{L_TOPICS}&nbsp;</th>
<th width="50">&nbsp;{L_REPLIES}&nbsp;</th>
<th width="100">&nbsp;{L_AUTHOR}&nbsp;</th>
<th width="50">&nbsp;{L_VIEWS}&nbsp;</th>
<th>&nbsp;{L_LASTPOST}&nbsp;</th>
</tr>
<!-- BEGIN topicrow -->
<!-- BEGIN divider -->
<tr>
   <td class="cat" colspan="6" height="28"><span style="font-weight: bold; font-size: 12px ; letter-spacing: 1px; color : #006699;">{topicrow.divider.L_DIV_HEADERS}</span></td>
</tr>
<!-- END divider -->
<tr>
<td height="34" class="row1"><a href="{topicrow.U_VIEW_TOPIC}"><img src="{topicrow.TOPIC_FOLDER_IMG}" width="33" height="25" alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}" border="0" /></a></td>
<td class="row1" width="100%">{topicrow.NEWEST_POST_IMG}{topicrow.TOPIC_ATTACHMENT_IMG}<!-- span class="topictitle">{topicrow.TOPIC_TYPE}</span --><a href="{topicrow.U_VIEW_TOPIC}" class="topictitle" title="{topicrow.TOPIC_TITLE}">{topicrow.TOPIC_TITLE}</a><span class="gensmall"><br />
{topicrow.GOTO_PAGE}</span></td>
<td class="row2" align="center"><span class="postdetails">{topicrow.REPLIES}</span></td>
<td class="row3" align="center" valign="middle" nowrap="nowrap"><span class="name">{topicrow.TOPIC_AUTHOR}</span><br /><span class="postdetails">{topicrow.FIRST_POST_TIME}</span></td>
<td class="row2" align="center"><span class="postdetails">{topicrow.VIEWS}</span></td>
<td class="row3" align="center" nowrap="nowrap"><span class="postdetails">&nbsp;{topicrow.LAST_POST_TIME}&nbsp;<br />
{topicrow.LAST_POST_AUTHOR} {topicrow.LAST_POST_IMG}</span></td>
</tr>
<!-- END topicrow -->
<!-- BEGIN switch_no_topics -->
<tr>
<td class="row1" colspan="6" align="center">{L_NO_TOPICS}</td>
</tr>
<!-- END switch_no_topics -->
<tr>
<td class="cat" align="center" colspan="6">
<form method="post" action="{S_POST_DAYS_ACTION}">
<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td class="genmed">{L_DISPLAY_TOPICS}:&nbsp;</td>
<td>{S_SELECT_TOPIC_DAYS}&nbsp;&nbsp;</td>
<td><input type="submit" class="catbutton" value="{L_GO}" name="submit" /></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" width="82" height="25" /></a></td>
<td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a>
<!-- BEGIN switch_parent_link -->
 -> <a class="nav" href="{PARENT_URL}">{PARENT_NAME}</a>
<!-- END switch_parent_link -->
 -> <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td class="nav" valign="top">{PAGINATION}<br />
<br />
{JUMPBOX}<br />
</td>
<td class="gensmall" align="right" valign="top"><strong><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></strong><br />
{L_MODERATOR}: {MODERATORS}<br />
{LOGGED_IN_USER_LIST}
</td>
</tr>
</table>
<table width="100%" cellspacing="0" border="0" align="center" cellpadding="0">
<tr>
<td valign="top">
<table border="0" cellspacing="3" cellpadding="0">
<tr>
<td><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}" width="33" height="25" /></td>
<td class="gensmall">&nbsp;{L_NEW_POSTS}</td>
<td>&nbsp;&nbsp;</td>
<td><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}" width="33" height="25" /></td>
<td class="gensmall">&nbsp;{L_NO_NEW_POSTS}</td>
<td>&nbsp;&nbsp;</td>
<td><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" title="{L_ANNOUNCEMENT}" width="33" height="25" /></td>
<td class="gensmall">{L_ANNOUNCEMENT}</td>
</tr>
<tr>
<td><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" title="{L_NEW_POSTS_HOT}" width="33" height="25" /></td>
<td class="gensmall">{L_NEW_POSTS_HOT}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" title="{L_NO_NEW_POSTS_HOT}" width="33" height="25" /></td>
<td class="gensmall">{L_NO_NEW_POSTS_HOT}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" title="{L_STICKY}" width="33" height="25" /></td>
<td class="gensmall">{L_STICKY}</td>
</tr>
<tr>
<td><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" title="{L_NEW_POSTS_LOCKED}" width="33" height="25" /></td>
<td class="gensmall">{L_NEW_POSTS_LOCKED}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" title="{L_NO_NEW_POSTS_LOCKED}" width="33" height="25" /></td>
<td class="gensmall">{L_NO_NEW_POSTS_LOCKED}</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
</td>
<td align="right" valign="top"><span class="gensmall">{S_AUTH_LIST}</span></td>
</tr>
</table>
