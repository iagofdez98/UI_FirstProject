<!--
Footer
Fecha: 28/10/2019
Creado por: stwgno 
-->

</article>
</div>
<footer>

<script type="text/javascript">
	var translator = $('body').translate({lang: "es", t: dict}); //use English
	
	$(".lang_selector").on('click', function(e) {
    e.preventDefault();
    var elLanguage = $(this).attr("data-value");
    translator.lang(elLanguage);
  })
	
</script>

  <span class="trn">Hoy es</span> <?php echo date("d-M-Y", mktime()); ?> <span class="trn">Autor</span>
</footer>
</body>
</html>

		