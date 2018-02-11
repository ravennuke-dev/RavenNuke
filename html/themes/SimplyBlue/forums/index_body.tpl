<table width="100%" cellspacing="3" cellpadding="0" border="0">
<tr>
<td valign="bottom" class="gensmall">
<!-- BEGIN switch_user_logged_in -->
{LAST_VISIT_DATE}<br />
<!-- END switch_user_logged_in -->
{CURRENT_TIME}<br />
<a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
<td align="right" valign="bottom" class="gensmall">
<!-- BEGIN switch_user_logged_in -->
<a href="{U_SEARCH_NEW}">{L_SEARCH_NEW}</a><br />
<!-- END switch_user_logged_in -->
<a href="{U_SEARCH_UNANSWERED}">{L_SEARCH_UNANSWERED}</a><br />
<a href="{U_MARK_READ}"><strong>{L_MARK_FORUMS_READ}</strong></a></td>
</tr>
</table>
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
<th colspan="2">&nbsp;{L_FORUM}&nbsp;</th>
<th>&nbsp;{L_TOPICS}&nbsp;</th>
<th>&nbsp;{L_POSTS}&nbsp;</th>
<th>&nbsp;{L_LASTPOST}&nbsp;</th>
</tr>
<!-- BEGIN catrow -->
<tr>
<td class="cat" colspan="2"><a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></td>
<td class="rowpic" colspan="3">&nbsp;</td>
</tr>
<!-- BEGIN forumrow -->
<tr>
<td class="row1" height="48"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
<td class="row1" width="100%"><a href="{catrow.forumrow.U_VIEWFORUM}" class="nav">{catrow.forumrow.FORUM_NAME}</a><br />
<span class="genmed">{catrow.forumrow.FORUM_DESC}<br />
</span><span class="gensmall">{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}</span>
<!-- BEGIN switch_attached_forums -->
<!-- BEGIN br -->
<br />
<!-- END br -->
<span class="genmed">{catrow.forumrow.switch_attached_forums.L_ATTACHED_FORUMS}:
<!-- BEGIN attached_forums -->
<a class="nav" href="{catrow.forumrow.switch_attached_forums.attached_forums.U_VIEWFORUM}"><img alt="{catrow.forumrow.switch_attached_forums.attached_forums.L_FORUM_IMAGE}" border="0" src="{catrow.forumrow.switch_attached_forums.attached_forums.FORUM_IMAGE}" title="{catrow.forumrow.switch_attached_forums.attached_forums.L_FORUM_IMAGE}" />{catrow.forumrow.switch_attached_forums.attached_forums.FORUM_NAME}</a>
<!-- END attached_forums -->
</span>
<!-- END switch_attached_forums -->
</td>
<td class="row2" align="center"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
<td class="row2" align="center"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
<td class="row2" align="center" nowrap="nowrap"><span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
</tr>
<!-- END forumrow -->
<!-- END catrow -->
</table>
<br />
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
<td class="cat" colspan="2"><a href="{U_VIEWONLINE}">{L_WHO_IS_ONLINE}</a></td>
</tr>
<tr>
<td class="row1" rowspan="3"><img src="themes/SimplyBlue/forums/images/whosonline.gif" alt="{L_WHO_IS_ONLINE}" title="{L_WHO_IS_ONLINE}" />
</td>
<td class="row1" width="100%"><span class="gensmall">{TOTAL_POSTS}<br />
{TOTAL_USERS}<br />
{NEWEST_USER}</span></td>
</tr>
<tr>
<td class="row1"><span class="gensmall">{TOTAL_USERS_ONLINE} &nbsp; [ <strong>{L_WHOSONLINE_ADMIN}</strong>
] &nbsp; [ <strong>{L_WHOSONLINE_MOD}</strong> ]<br />
{RECORD_USERS}<br />
{LOGGED_IN_USER_LIST}</span></td>
</tr>
<tr>
<td class="row1"><span class="gensmall">{L_ONLINE_EXPLAIN}</span></td>
</tr>
</table>
<!-- BEGIN switch_user_logged_out -->

<!-- END switch_user_logged_out -->

<table align="center" cellspacing="3" border="0" cellpadding="0">
<tr>
<td><img src="themes/SimplyBlue/forums/images/folder_new.gif" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}" /></td>
<td class="gensmall">{L_NEW_POSTS}</td>
<td>&nbsp;</td>
<td><img src="themes/SimplyBlue/forums/images/folder.gif" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}" /></td>
<td class="gensmall">{L_NO_NEW_POSTS}</td>
<td>&nbsp;</td>
<td><img src="themes/SimplyBlue/forums/images/folder_lock.gif" alt="{L_FORUM_LOCKED}" title="{L_FORUM_LOCKED}" /></td>
<td class="gensmall">{L_FORUM_LOCKED}</td>
</tr>
</table>
