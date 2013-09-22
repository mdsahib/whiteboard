<html>
<head>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/jquery.noty.js"></script>

	<script type="text/javascript" src="assets/js/top.js"></script>
	<script type="text/javascript" src="assets/js/topCenter.js"></script>

	<!-- You can add more layouts if you want -->

	<script type="text/javascript" src="assets/js/default.js"></script>
</head>

<body>

<div class="page-header alert alert-success">
  <h1><center>Share your voice For Rampal Power Plant : Click to start</center></h1>
</div>

<?php

	$fp=fopen('database.csv','r');
	while($data=fgetcsv($fp,0,',')){
?>
	<div style="position: absolute; left: <?php echo $data[2]?>px; top: <?php echo $data[3]?>px;">
		<p><?php echo $data[1]; ?></p>
	</div>
<?php
	};
?>

<div class="modal fade" id='myModal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Share Your Thought</h4>
      </div>
      <div class="modal-body">
			<form class="form-horizontal">
				<fieldset>

					<!-- Text input-->
					<div class="control-group">
					  <label class="control-label" for="email">Email</label>
					  <div class="controls">
					    <input id="email" name="email" id="email" type="text" placeholder="email" class="input-xlarge" required="">
					    
					  </div>
					</div>

					<!-- Textarea -->
					<div class="control-group">
						  <label class="control-label" for="thought">Your Thought</label>
						  <div class="controls">                     
						    <textarea id="thought" name="thought" class="input-xlarge" placeholder="Share your words here"></textarea>
						  </div>
					</div>
					        
					

				</fieldset>
			</form>


      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	<button type="button" id="share-button" class="btn btn-primary">Lets Share</button>
	
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>


<script type="text/javascript">
	$(function(){
		var x=0;
		var y=0;
		var handler=function(e){
			console.log(e.pageX);
			console.log(e.pageY);
			x=e.pageX;
			y=e.pageY;
			$('#myModal').modal('toggle');
		};

		$('body').on('click',handler);
		$('#myModal').on('show.bs.modal',function(){
			$('body').off('click');
		});
		$('#myModal').on('hidden.bs.modal',function(){
			$('body').on('click',handler);
		});
		$('#share-button').click(function(){
			var div=$('<div><p>'+$('#thought').val()+'</p></div>');
			div.css({
				'position':'absolute',
				'left':x,
				'top':y
			});
			$('body').append(div);
			$.post('http://27.147.179.137/whiteboard/add.php',{
				'email':$('#email').val(),
				'text':$('#thought').val(),
				'x':x,
				'y':y
			},function(){
				var n = noty({
						text: 'Voila ! You have succefully spread your words',
						timeout: '3000',
						layout:'topCenter'
						
				});
     			});
			$('#myModal').modal('hide');
		})

	})
</script>
</html>
