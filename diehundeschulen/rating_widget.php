<?php
/**
 * @author		Juri Oll
 * @copyright	Copyright (c) 2013, Juri Oll | The Next Level - nexle.de | http://www.nexle.de
 * @version		1.0.0
 */
?>

<script type="text/javascript">
	var formidable_referenz_id = document.getElementById("field_d6ws4k").value;
<!--	var formidable_referenz_id = document.getElementById("field_z178dj").value;-->
	
	if (!isNaN(formidable_referenz_id)) {
		var frm_form_fields = document.getElementsByClassName("frm_form_fields")[0];
		var frm_form_fields_fieldset = frm_form_fields.getElementsByTagName('fieldset')[0];
		var frm_form_fields_fieldset_innerHTML = frm_form_fields_fieldset.innerHTML;
		
		var iframe_output =	'<div class="frm_form_field form-field ">';
		iframe_output +=	'	<h3 class="frm_pos_top">dieHundeschulen.de G&uuml;tesiegel</h3>';
		iframe_output +=	'	<p> Kopieren Sie den Quellcode rechts neben dem G&uuml;tesiegel in Ihre Website: </p>';
		iframe_output +=	'	<div class="frm_form_field form-field  frm_required_field frm_top_container">';
		iframe_output +=	'		<table>';
		iframe_output +=	'			<tr>';
		iframe_output +=	'				<td>';
		iframe_output +=	'					<iframe src="https://stage2.diehundeschulen.de/rating_hundeschule.php?school=' + formidable_referenz_id + '&scale=0.7" width="220" height="210" name="rating_298_x_285_scale_0_7" scrolling="no" frameborder="0"></iframe>';
		iframe_output +=	'				</td>';
		iframe_output +=	'				<td>';
		iframe_output +=	'					<textarea cols="250" rows="10" style="resize: none;" readonly="readonly"><iframe src="https://stage2.diehundeschulen.de/rating_hundeschule.php?school=' + formidable_referenz_id + '&scale=0.7" width="220" height="210" name="rating_298_x_285" scrolling="no" frameborder="0"></iframe></textarea>';
		iframe_output +=	'				</td>';
		iframe_output +=	'			</tr>';
		iframe_output +=	'		</table>';
		iframe_output +=	'	</div>';
		iframe_output +=	'</div>';
		
		frm_form_fields_fieldset.innerHTML = iframe_output + frm_form_fields_fieldset_innerHTML;
	}
</script>
