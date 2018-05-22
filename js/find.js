$(document).ready(function(){

	$( "button[name='default_button']" ).click(function() {
  let id = this.id
  let MainValue = $(this).val();

	let arr = MainValue.split('&')

   $( "#input_miner_"+ id).val(arr[0]);
	 $( "#input_miner_parameters_"+ id).val(arr[1]);
	 $( "#input_comment_"+ id).val(arr[2]);
});

});
