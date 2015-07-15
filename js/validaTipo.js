
$(function(){
			if($("select#tipoarticulo").val() == '2')
			{
			$("div#imagen2").hide();
			$("div#color").hide();
			}
			else
			{
			$("div#imagen2").show();
			$("div#color").show();
			}
			
  $("select#tipoarticulo").change(function(){
			if($("select#tipoarticulo").val() == '2')
			{
			$("div#imagen2").hide();
			$("div#color").hide();
			$("#negativo").hide();
			}
			else
			{
			$("div#imagen2").show();
			$("div#color").show();
			}

  });

});