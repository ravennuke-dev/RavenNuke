<?php 
/* 
*    Writed by Setec Astronomy - setec@freemail.it 
*    Modified by Kevin Guske to support 2 dependent fields for nukeFEED 
*      (http://nukeSEO.com - home of nukeSEO, nukeWYSIWYG, nukeFEED and more)
*    This script is distributed  under the GPL License 
* 
*    This program is distributed in the hope that it will be useful, 
*    but WITHOUT ANY WARRANTY; without even the implied warranty of 
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
*    GNU General Public License for more details. 
* 
*    http://www.gnu.org/licenses/gpl.txt 
* 
*/ 

class CLinkedSelect
{ 
    var $formName;
    var $primaryFieldName;
    var $secondaryFieldName;
    var $secondaryFieldValue;
    var $thirdFieldName;
    var $thirdFieldValue;
	  var $fieldValues;
	  var $selectedPrimary;
     
    function __construct() 
    {
		$this->formName = ""; 
		$this->primaryFieldName = ""; 
		$this->secondaryFieldName = "";  
		$this->thirdFieldName = "";  
		$this->fieldValues = array ();  
	}

	function _safe_set (&$var_true, $var_false="")
	{
		if (!isset ($var_true))
		{ $var_true = $var_false; }
		return $var_true;
	}
	
	function get_function_js ()
	{
		ob_start ();
?>
<script language="JavaScript" type="text/JavaScript">

function <?php print ($this->get_function_name ()); ?> (code_item)
{
	// clear secondary_field	
	var secondary_field_length = document.<?php print ($this->formName); ?>.<?php print ($this->secondaryFieldName); ?>.length;
	for (i = secondary_field_length - 1; i >=0; i--) {
		document.<?php print ($this->formName); ?>.<?php print ($this->secondaryFieldName); ?>.options[i] = null;
	}
	// clear third_field	
	var third_field_length = document.<?php print ($this->formName); ?>.<?php print ($this->thirdFieldName); ?>.length;
	for (i = third_field_length - 1; i >=0; i--) {
		document.<?php print ($this->formName); ?>.<?php print ($this->thirdFieldName); ?>.options[i] = null;
	}

	var primary_field_index = document.<?php print ($this->formName); ?>.<?php print ($this->primaryFieldName); ?>.selectedIndex;

<?php 
	foreach ($this->fieldValues as $list)
	{
		$this->_safe_set ($list["value"], "");
		$this->_safe_set ($list["text"], "");
		$this->_safe_set ($list["selected"], false);
		$this->_safe_set ($list["items"], array ());
		$this->_safe_set ($list["items2"], array ());
?>
	if (document.<?php print ($this->formName); ?>.<?php print ($this->primaryFieldName); ?>.options[primary_field_index].value == '<?php print ($list["value"]); ?>') {
		document.<?php print ($this->formName); ?>.<?php print ($this->secondaryFieldName); ?>.length = <?php print (count ($list["items"])); ?>;
<?php 
		$i = 0;
		foreach ($list["items"] as $value => $text) 
		{
?>
			document.<?php print ($this->formName); ?>.<?php print ($this->secondaryFieldName); ?>.options[<?php print ($i); ?>].value = "<?php print (addslashes ($value)); ?>";
			document.<?php print ($this->formName); ?>.<?php print ($this->secondaryFieldName); ?>.options[<?php print ($i); ?>].text = "<?php print (addslashes ($text)); ?>";
<?php
			$i++;
		}  // foreach ($items as $item) 
?>		
		document.<?php print ($this->formName); ?>.<?php print ($this->thirdFieldName); ?>.length = <?php print (count ($list["items2"])); ?>;
<?php 
		$i = 0;
		foreach ($list["items2"] as $value => $text) 
		{
?>
			document.<?php print ($this->formName); ?>.<?php print ($this->thirdFieldName); ?>.options[<?php print ($i); ?>].value = "<?php print (addslashes ($value)); ?>";
			document.<?php print ($this->formName); ?>.<?php print ($this->thirdFieldName); ?>.options[<?php print ($i); ?>].text = "<?php print (addslashes ($text)); ?>";
<?php
			$i++;
		}  // foreach ($items as $item) 
?>		
	} 
<?php		
	} // foreach ($values as $value)
?>	
}
//-->
</script>
<?php
		$result = ob_get_contents ();
		ob_end_clean ();	
		return $result;
	}

	function get_function_name ()
	{
		if (empty ($this->formName) || empty ($this->primaryFieldName))
		{ return false; }
		return "Modify" . ucfirst ($this->formName) . ucfirst ($this->primaryFieldName);
	}

	function get_reset_js ()
	{
		if (empty ($this->formName) || empty ($this->primaryFieldName))
		{ return false; }

		ob_start ();
?>
<script language="JavaScript" type="text/JavaScript">

	<?php print ($this->get_function_name ()); ?> (-1);
//-->
</script>
<?php
		$result = ob_get_contents ();
		ob_end_clean ();	
		return $result;
	}
	
	function get_primary_field ($attributes = "")
	{
		if (empty ($this->primaryFieldName) || empty ($this->fieldValues))
		{ return false; }

		ob_start ();
?>		
<select onchange="<?php print ($this->get_function_name ()); ?>(-1)" name="<?php print ($this->primaryFieldName); ?>"<?php print (" " . $attributes); ?>>
<?php
  $sp = 0;
	foreach ($this->fieldValues as $list)
	{
		$this->_safe_set ($list["value"], "");
		$this->_safe_set ($list["text"], "");
		$this->_safe_set ($list["selected"], false);

		$attribute = '';
		if ($list['selected'])
		{ $attribute = ' selected="selected"'; $this->selectedPrimary = $sp;}

		print ("	<option value=\"" . $list["value"] . "\"" . $attribute . ">" . $list["text"] . "</option>\n");
		$sp = $sp +1;
	} // foreach ($this->fieldValues as $list)
?>
</select>
<?php
		$result = ob_get_contents ();
		ob_end_clean ();	
		return $result;
	}
	
	function get_secondary_field ($attributes = "", $default_value = "-1", $default_caption = "")
	{
		if (empty ($this->secondaryFieldName))
		{
      return false; 
    }

		ob_start ();
?>		
<select name="<?php print ($this->secondaryFieldName); ?>"<?php print (" " . $attributes); ?>>
<?php
  # For edit mode, add default array, selected value
	if (!empty ($default_caption))
	{ print ("	<option value=\"" . $default_value . "\">" . $default_caption . "</option>\n"); }
	if (!empty($this->fieldValues[$this->selectedPrimary]['items']))
	{
  	foreach ($this->fieldValues[$this->selectedPrimary]['items'] as $value => $text)
  	{
  		$attribute = "";
	   	if ($value == $this->secondaryFieldValue) $attribute = ' selected="selected"';
  		print ("	<option value=\"" . $value . "\"" . $attribute . ">" . $text . "</option>\n");
  	} // foreach ($this->fieldValues as $list)
  }
?>
</select>
<?php
		$result = ob_get_contents ();
		ob_end_clean ();	
		return $result;
	}
	
	function get_third_field ($attributes = "", $default_value = "-1", $default_caption = "")
	{
  # For edit mode, add default array, selected value
		if (empty ($this->thirdFieldName))
		{ return false; }

		ob_start ();
?>		
<select name="<?php print ($this->thirdFieldName); ?>"<?php print (" " . $attributes); ?>>
<?php
	if (!empty ($default_caption))
	{ print ("	<option value=\"" . $default_value . "\">" . $default_caption . "</option>\n"); }
	if (!empty($this->fieldValues[$this->selectedPrimary]['items2']))
	{
  	foreach ($this->fieldValues[$this->selectedPrimary]['items2'] as $value => $text)
  	{
  		$attribute = "";
  		if ($value == $this->thirdFieldValue) $attribute = ' selected="selected"';
  		print ("	<option value=\"" . $value . "\"" . $attribute . ">" . $text . "</option>\n");
  	} // foreach ($this->fieldValues as $list)
  }
?>
</select>
<?php
		$result = ob_get_contents ();
		ob_end_clean ();	
		return $result;
	}
}
?>
