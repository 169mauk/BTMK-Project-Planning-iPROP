<?php
new Controller();
?>
<div class="card">
	<div class="card-header">
		<span class="icon-setting"></span> Project Setting
	</div>
	<div class="card-body">
		<div class="row gutters">
		<?php
			$menus = ["Category", "Tags"];
			
			$view = F::URLSlugDecode(url::get(2));
			if(empty($view)){
				$view = $menus[0];
			}
			
			?>
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
					<?php
						foreach($menus as $menu){
							if($menu == $view){
								$active = "active";
							}else{
								$active = "";
							}
						?>
						<li class="nav-item">
							<a class="nav-link <?= $active ?>" href="<?= PORTAL ?>settings/project-setting/<?= F::URLSlugEncode($menu) ?>" role="tab" aria-controls="home1" aria-selected="true"><?= $menu ?></a>
						</li>
						<?php
						}
					?>
				</ul>
				
				<div class="tab-content" id="">
					<?php
					switch($view){
						default:
						case "Category":
							Page::Load("settings/projects/category");
						break;
						
						case "Tags":
							Page::Load("settings/projects/tags");
						break;
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>