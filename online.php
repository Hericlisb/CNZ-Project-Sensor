
<?php include_once "common.inc.php"; ?>

<?php get_html_header(); ?>

<script type="text/javascript">
function update_data() {
	$("#aqui").load("status.php");
}
$(document).ready(function() {
		update_data();
		$.timer(10000, update_data);
   });
</script>

</head>

<body>
<div style="padding: 50px;">
   <?php get_menu(0); ?>
   <div id="aqui"></div>
</div>
</body>
</html>