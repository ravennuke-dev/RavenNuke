<?php
if (!defined('NUKE_FILE')) die ('You can\'t access this file directly...');
/************************************************************/
/* OpenTable Functions                                      */
/*                                                          */
/* Define the tables look&feel for you whole site. For this */
/* we have two options: OpenTable and OpenTable2 functions. */
/* Then we have CloseTable and CloseTable2 function to      */
/* properly close our tables. The difference is that        */
/* OpenTable has a 100% width and OpenTable2 has a width    */
/* according with the table content                         */
/************************************************************/

function OpenTable() {
    global $bgcolor1, $bgcolor2;
    echo '<table width="100%" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="1">
        <tr>
          <td bgcolor="#486386"><table width="100%" border="0" cellspacing="0" cellpadding="1">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                    <tr>
                      <td bgcolor="#F4F6FB"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                          <tr>
                            <td>';
}

function CloseTable() {
    echo '</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>';
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;
    echo '<table width="100%" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="1">
        <tr>
          <td bgcolor="#486386"><table width="100%" border="0" cellspacing="0" cellpadding="1">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                    <tr>
                      <td bgcolor="#F4F6FB"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                          <tr>
                            <td>';
}

function CloseTable2() {
    echo '</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>';
}

?>
