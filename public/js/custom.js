$(document).ready(function () {
	$(document.body).on('submit', '.js-confirm', function () {
		var $el = $(this)
		var text = $el.data('confirm') ? $el.data('confirm') : 'Anda yakin ingin melakukan tindakan ini?'
		var c = confirm(text);
		return c;
	});

	$('.js-selectize').selectize({
		sortField: 'text'
	});

	$(document.body).on('submit', '.js-review-delete', function () {
		var $el  = $(this);
		var text = $el.data('confirm') ? $el.data('confirm') : 'Anda yakin ingin melakukan tindakan ini?';
		var c    = confirm(text);

		if (c === false) return c;

		event.preventDefault();

		$.ajax({
			type     : 'POST',
			url      : $(this).attr('action'),
			dataType : 'json',
			data     : {
				_method : 'DELETE',
				_token  : $( this ).children( 'input[name=_token]' ).val()
			}
		}).done(function(data) {
			baris = $('#form-'+data.id).closest('tr');
			baris.fadeOut(300, function() {$(this).remove()});
		});
	});
});
