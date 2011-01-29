<?php if (isset($error)) { ?>
<div class="warning"><?php echo $error; ?></div>
<?php } ?>
<form action="<?php echo str_replace('&', '&amp;', $action); ?>" method="post" id="checkout">
<b style="margin-bottom: 3px; display: block;"><?php echo $text_creditcard; ?></b>
<div id="offline_cc" style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
  <table width="100%">
    <tr>
      <td><?php echo $entry_cc_type; ?></td>
      <td><select name="cc_type"><option value="none"></option><option value="visa">Visa</option><option value="mastercard">Mastercard</option></select></td>
    </tr>
    <tr>
      <td><?php echo $entry_cc_owner; ?></td>
      <td><input type="text" name="cc_owner" value="" /></td>
    </tr>
    <tr>
      <td><?php echo $entry_cc_number; ?></td>
      <td><input type="text" name="cc_number" value="" /></td>
    </tr>
    <tr>
      <td><?php echo $entry_cc_expire; ?></td>
      <td><select name="cc_month">
          <?php foreach ($months as $month) { ?>
          <option value="<?php echo $month['value']; ?>"><?php echo $month['text']; ?></option>
          <?php } ?>
        </select>
        /
        <select name="cc_year">
          <?php foreach ($year_expire as $year) { ?>
          <option value="<?php echo $year['value']; ?>"><?php echo $year['text']; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr>
      <td><?php echo $entry_cc_cvv; ?></td>
      <td><input type="text" name="cc_cvv" value="" size="3" /></td>
    </tr>
  </table>
</div>

<div class="buttons">
  <table>
    <tr>
      <td align="left"><a onclick="location = '<?php echo str_replace('&', '&amp;', $back); ?>'" class="button"><span><?php echo $button_back; ?></span></a></td>
      <td align="right"><a onclick="$('#checkout').submit();" class="button"><span><?php echo $button_confirm; ?></span></a></td>
    </tr>
  </table>
</div></form>
<script type="text/javascript">
/*$('#checkout').click(function() {
	$.ajax({ 
		type: 'GET',
		url: 'index.php?route=payment/offline_cc/process',
		success: function() {
			location = '<?php echo $continue; ?>';
		}		
	});
	$.ajax({
		type: 'POST',
		url: 'index.php?route=payment/sagepay_us/send',
		data: $('#sagepay :input'),
		dataType: 'json',		
		beforeSend: function() {
			$('#sagepay_button').attr('disabled', 'disabled');
			
			$('#sagepay').before('<div class="wait"><img src="catalog/view/theme/default/image/loading_1.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		success: function(data) {
			if (data.error) {
				alert(data.error);
				
				$('#sagepay_button').attr('disabled', '');
			}
			
			$('.wait').remove();
			
			if (data.success) {
				location = data.success;
			}
		}
	});
});*/
</script>