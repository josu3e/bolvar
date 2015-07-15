$(function(){

$("#fec_nac").datepicker(
{
			changeMonth: true,
			changeYear: true
});	
	
$('#fec_nac').datepicker('option', 'yearRange', '1900:2010');
$('#fec_nac').datepicker('option', {dateFormat: 'yy-mm-dd'}); 

var x = $('#fec_naci').val();

if($('#fec_naci').val())
{

  x = $('#fec_naci').val();
	var fecnaci = x.split("-");

	var YourDateObj = new Date(fecnaci[0],parseInt(fecnaci[1]-1),fecnaci[2]);
	$('#fec_nac').datepicker('setDate', YourDateObj);
}

	////////////////////////////////
	////////////////////////////////
	////////////////////////////////
	
	var x = $('[name=negativo]').val();
 if(x == 1)
 {
 $('#radio_si').attr("checked","true");
 }
 else
 {
  $('#radio_no').attr("checked","true");
 }
 
	
});
