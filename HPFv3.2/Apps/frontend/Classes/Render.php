<?php

class Render{
	public static function Modal($setting = [], $view, $size = "md"){
		try{
			echo '
				<div class="modal fade" id="'. $setting["id"] .'">
					<div class="modal-dialog modal-'. $size .'">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">'. $setting["title"] .'</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							
							<div class="modal-body">
							';
			Page::Load($view);
							echo '
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			';
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
}