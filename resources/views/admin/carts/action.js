$(document).ready(function(){
	$('#manage_user').submit(function(e){
		e.preventDefault()

		$.ajax({
			url: "{{ url('admin/carts')}}",
			data: $(this).serialize(),
			method: 'POST',
			success: function(resp) {
				$('#error_msg').html(resp);
			}
		})
	})
})


