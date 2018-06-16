<?php
	$key = $_GET['key'];
	$project = $_GET['project'];
	$pages = 1;

	$page = $_GET['page'];
	$limit = $_GET['limit'];
	$offset = ($page - 1)*$limit;
?>


<?php
	for($a = 1; $a <= 15; $a++)
	{
?>
		<div class="row item-row">
				<div class="col-xs-2 col-sm-1 pull-right align-right">
					<a href="#"><i class="fa fa-gear"></i></a>
				</div>
			<div class="col-xs-10 col-sm-11 plr10">
				<div class="hidden-xs col-sm-1 plr5">
					<?=$a;?>
				</div>
				<div class="col-xs-11 col-sm-7 plr5">
					<span class="blocked">Item name 1 4x4</span>
				</div>
				<div class="col-xs-6 col-sm-2 plr5 align-right-sm text-gray-xs-only small-xs-only">
					x 400 pcs
				</div>
				<div class="col-xs-6 col-sm-2 plr5 align-right-xs-only text-gray-xs-only small-xs-only">
					Project 1
				</div>
			</div>
		</div>
<?php
	}
?>

<div class="row mt30">
	<div class="col-xs-12 align-center">
		<button
			onClick="load_inventory_list(<?=$page-1;?>);"
			type="button"
			class="btn-paginate chevs 
			<?=$page <= 1 ? 'disabled' : '';?>"
			<?=$page <= 1 ? 'disabled' : '';?>
		>
			<i class="ion-chevron-left"></i> PREV
		</button>
<?php
	for($a = 1; $a<=$pages;$a++)
	{
?>
		<button
			onClick="load_inventory_list(<?=$a?>);"
			type="button"
			class="btn-paginate nums 
			<?=$a == $page ? 'active' : '';?>"
		>
			<?=$a;?>	
		</button>
<?php
	}
?>
		<button
			onClick="load_inventory_list(<?=$page+1;?>);"
			type="button"
			class="btn-paginate chevs 
			<?=$page >= $pages ? 'disabled' : '';?>"
			<?=$page >= $pages ? 'disabled' : '';?>
		>
			NEXT <i class="ion-chevron-right"></i>
		</button>
	</div>
</div>
<script type="text/javascript">
	$(".employee-data-toggler ").click(function()
	{
		$(this).closest(".employee-row").find(".extra-details").toggleClass("hidden-xs");
	});
</script>