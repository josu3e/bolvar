
<div id="left">
        	<div class="cuadros">
            	<h1 class="fondo01"><span>&iquest;Categor&iacute;a?</span></h1>
              <ul>
<?php echo (isset($categorias))?$categorias:'';?>
              </ul>
    </div>
            
<div class="cuadros">
      <h1 class="fondo02"><span>&iquest;Color?</span></h1>
        <ul>
				<?php echo (isset($coloresbyta))?$coloresbyta:'';?>
				<div id="colorcontent">

				</div>

        </ul>
      </div>
            
<div class="cuadros">
            	<h1 class="fondo03"><span>&iquest;Logotipo?</span></h1>
							<?php echo (isset($logosbyusu))?$logosbyusu:'';?>
      </div>
      </div>
			<div id="index-maquetar-06">
	<img src="img/titu_agregar.gif"/>
	<?php echo (isset($articulos))?$articulos:'';?>
</div>

