<?php
	$key = $_GET['key'];
	$fromproject = $_GET['fromproject'];
	$toproject = $_GET['toproject'];
	$dates			= explode(" - ", $_GET['daterange']);
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
				<div class="col-xs-11 col-sm-6 plr5">
					<span class="blocked">Project <?=$a."a";?>&emsp;<i class="fa fa-arrow-right" style="font-size: 10px;"></i>&emsp;Project <?=$a."b";?></span>
				</div>
				<div class="col-xs-8 col-sm-3 plr5 text-gray-xs-only">
					12 <small><i class="fa fa-cubes"></i></small> 
					&nbsp;<span class="text-gray">worth</span>&nbsp; &#8369; <?=number_format($a*2,2);?>
				</div>
				<div class="col-xs-4 col-sm-2 plr5 align-right text-gray-xs-only">
					2017-11-07
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