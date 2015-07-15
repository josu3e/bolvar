
$(function(){
if($("#arid").val() == '')
{
    $.ajax({
      type: "GET",
      contentType: "html",
      // url: "/bolivar/index.php/administrador/categorias/categorias_by_tipo/"+$("select#tipoarticulo").val(),
			url: "/index.php/administrador/categorias/categorias_by_tipo/"+$("select#tipoarticulo").val(),
      success: function(data){
        $("div#categoria").html(data);
      }
    });
}



  $("select#tipoarticulo").change(function(){
    $.ajax({
      type: "GET",
      contentType: "html",
      // url: "/bolivar/index.php/administrador/categorias/categorias_by_tipo/"+$(this).val(),
			url: "/index.php/administrador/categorias/categorias_by_tipo/"+$(this).val(),
      success: function(data){

        $("div#categoria").html(data);

      }
    });
  });
});