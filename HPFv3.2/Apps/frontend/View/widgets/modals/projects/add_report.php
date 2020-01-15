
<form action="" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			Title:
			<input type="text" class="form-control" placeholder="Report Title" name="title" /><br />
			
			Images:
			<input type="file" name="images[]" multiple /><br /><br />
			
			Description:
			<textarea class="form-control" placeholder="Description" name="description"></textarea><br />
		</div>
		
		<div class="col-md-6">
			<strong><u>Payment Claim (If any)</u></strong><br /><br />
			
			Amount to Claim:
			<input type="text" class="form-control" placeholder="0.00" value="0.00" name="claim" /><br />
			
			Invoice No:
			<input type="text" class="form-control" placeholder="Invoice Number" name="invoiceNo" /><br />
			
			Invoice Date:
			<input type="date" class="form-control" placeholder="Invoice Number" name="invoiceDate" /><br />
			
			Invoice Acknowldgement Date:
			<input type="date" class="form-control" placeholder="Invoice Number" name="invoiceAcknowledgeDate" /><br />
			
			LO No:
			<input type="text" class="form-control" placeholder="Invoice Number" name="loNo" /><br />
		</div>
		
		<div class="col-md-12 mt-3">
			Content:
			<textarea class="form-control summernote" name="content"></textarea><br /> 
		</div>
		
		<div class="col-md-12 text-center">
			<?= Controller::form("projects/report", ["action" => "add"]) ?>
			<button class="btn btn-sm  btn-success">
				<span class="icon-save"></span> Save Information
			</button>
		</div>
	</div>
</form>