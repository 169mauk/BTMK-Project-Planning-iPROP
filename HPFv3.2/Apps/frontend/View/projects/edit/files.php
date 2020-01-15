<div id="file_form">
	<label id="" for="files" style="width: 100%; background-color: #f7f7f7; text-align: center; border: 1px dashed #ccc; padding: 20px;">
		<h3 style="font-size: 1.14286rem !important">
			<span class="icon-upload3"></span> Select add Files
		</h3>
	</label>
	<input id="files" type="file" style="display: none;" accept="image/*" name="files[]" onchange="pre_upload(this.files)" multiple />
</div>
<br />
<table class="table table-hover table-fluid dataTable">
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">Date</th>
			<th>File</th>
			<th class="text-center">Type</th>
			<th class="text-center">User</th>
			<th class="text-right">:::</th>
		</tr>
	</thead>
	
	<tbody>
	<?php
		$no = 1;
		foreach(files::list(["where" => "f_id IN (SELECT pf_file FROM project_file WHERE pf_project = ". url::get(3) .")"]) as $f){
		?>
		<tr>
			<td class="text-center"><?= $no++ ?></td>
			<td class="text-center"><?= $f->f_date ?></td>
			<td>
				<input type="text" class="form-control file-title" data-file="<?= $f->f_id ?>" placeholder="File Title" value="<?= $f->f_title ?>" />
				<textarea class="form-control file-description" placeholder="File Description" data-file="<?= $f->f_id ?>"><?= $f->f_description ?></textarea>
			</td>
			<td>
				<select class="form-control file-type" data-project="<?= url::get(3) ?>" data-file="<?= $f->f_id ?>">
				<?php
					foreach(settings::getBy(["s_key" => "project_file_type"]) as $t){
					?>
					<option value="<?= $t->s_value ?>" <?= $t->s_value == $f->f_type ? "selected" : "" ?>><?= $t->s_name ?></option>
					<?php
					}
				?>
				</select>
			</td>
			<td class="text-center"><?= count(users::getBy(["user_id" => $f->f_user])) ? users::getBy(["user_id" => $f->f_user])[0]->user_name : "UNKNOWN" ?></td>
			<td class="text-right">
				<a href="<?= PORTAL ?>download/project_file/<?= $f->f_name ?>" target="_blank" class="btn btn-sm btn-primary">
					Download
				</a>
			</td>
		</tr>
		<?php
		}
	?>
	</tbody>
</table>
<?php
$p_id = url::get(3);
Page::bodyAppend(<<<SCRIPT
<script>
$(".file-title").on("keyup", function(){
	title = $(this).val();
	fid = $(this).attr("data-file");
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/files/updateBy/f_id=" + fid,
		data: {
			f_title: title
		}
	});
});

$(".file-description").on("keyup", function(){
	description = $(this).val();
	fid = $(this).attr("data-file");
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/files/updateBy/f_id=" + fid,
		data: {
			f_description: description
		}
	});
});

$(".file-type").on("change", function(){
	fid = $(this).attr("data-file");
	ftype = $(this).val();
	$.ajax({
		method: "POST",
		url: PORTAL + "webservice/files/updateBy/f_id=" + fid,
		data: {
			f_type: ftype
		}
	});
});

$("#file_form").on("dragenter", function(e){
	e.preventDefault();
	e.stopPropagation()
});
$("#file_form").on("dragleave", function(e){
	e.preventDefault();
	e.stopPropagation()
});
$("#file_form").on("dragover", function(e){
	e.preventDefault();
	e.stopPropagation()
});
$("#file_form").on("drop", function(ev){
	ev.preventDefault();
	ev.stopPropagation();
});

uploading = false;
nupload = 0;
tupload = 0;
function pre_upload(files){
	for(i = 0; i < files.length; i++){
		upload(files[i]);
		nupload += 1;
	}
}

function upload(file){
	var blob;
	var reader = new FileReader();
	reader.readAsArrayBuffer(file);
	reader.onloadend  = function(evt)
	{
		xhr = new XMLHttpRequest();
		xhr.open("POST", PORTAL + "upload/project_file/" + file.name + "/&id=" + $p_id, true);
		
		XMLHttpRequest.prototype.mySendAsBinary = function(text){
			var ui8a = new Uint8Array(new Int8Array(text));
			if(typeof window.Blob == "function")
			{
				blob = new Blob([ui8a]);
			}else{
				var bb = new (window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder)();
				bb.append(ui8a);
				blob = bb.getBlob();
			}
			
			this.send(blob);
		}
		
		var eventSource = xhr.upload || xhr;
		eventSource.addEventListener("progress", function(e) {
			var position = e.position || e.loaded;
			var total = e.totalSize || e.total;
			var percentage = Math.round((position/total)*100);
		});
		
		xhr.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)
			{
				console.log("Upload done!");
				
				tupload += 1;
				
				if(tupload == nupload){
					window.location = window.location;
				}
			}
		};
		
		xhr.mySendAsBinary(evt.target.result);
	};
}

</script>
SCRIPT
);
?>