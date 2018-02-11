			<tr>
				<td class="row2" colspan="2"><br clear="all" /><form method="post" action="{S_POLL_ACTION}"><table cellspacing="0" cellpadding="4" border="0" align="center">
					<tr>
						<td align="center"><span class="gen thick">{POLL_QUESTION}</span></td>
					</tr>
					<tr>
						<td align="center"><table cellspacing="0" cellpadding="2" border="0">
							<!-- BEGIN poll_option -->
							<tr>
								<td align="left"><input type="radio" name="vote_id" value="{poll_option.POLL_OPTION_ID}" />&nbsp;</td>
								<td align="left"><span class="gen">{poll_option.POLL_OPTION_CAPTION}</span></td>
							</tr>
							<!-- END poll_option -->
						</table></td>
					</tr>
					<tr>
						<td align="center">
			<input type="submit" name="submit" value="{L_SUBMIT_VOTE}" class="liteoption" />
		  </td>
					</tr>
					<tr>
						
		  <td align="center"><span class="gensmall thick"><a href="{U_VIEW_RESULTS}" class="gensmall">{L_VIEW_RESULTS}</a></span></td>
					</tr>
				</table>{S_HIDDEN_FIELDS}</form></td>
			</tr>
