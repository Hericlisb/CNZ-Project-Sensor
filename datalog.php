<?php include_once "common.inc.php"; ?>

<?php get_html_header(); ?>
<link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css" />
<script src="jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
   	var now = new Date();
   	var str = "" + now.getDate() + "/" + (1 + now.getMonth()) + "/" + now.getFullYear();
   	$(".date_time").datetimepicker({
      	mask: true,
   		format: "d/m/Y H:i",
         lang: 'pt-br',
         value: str
   	});
   	$(".b_")
   	   .css("cursor", "pointer")
   	   .click(do_download);
   });

function do_download() {
   var id = $(this).attr("id").substr(2);
   var ini = $("#i_" + id).val();
   var fm = $("#f_" + id).val();

	var form = $("<form></form>");
	form
	   .attr("method", "post")
	   .attr("action", "get_csv.php");

   var addr = $("<input></input>");
   addr
      .attr("type", "hidden")
      .attr("name", "addr")
      .attr("value", id);

   var inicio = $("<input></input>");
   inicio
      .attr("type", "hidden")
      .attr("name", "inicio")
      .attr("value", ini);
   
   var fim = $("<input></input>");
   fim
      .attr("type", "hidden")
      .attr("name", "fim")
      .attr("value", fm);

   form
   	.append(addr)
   	.append(inicio)
   	.append(fim);

	$(document.body).append(form);
	form.submit();
}
</script>

</head>

<body>
<div style="padding: 50px;">
   <?php get_menu(2); ?>
   <div>
   <?php get_download_table();  ?>
   </div>
</div>

</body>
</html>