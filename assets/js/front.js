jQuery(function($){

	var all_items = $('#to-do-lists li').length
	var done_items = $('#to-do-lists li.checked').length
	var item_left = parseInt(all_items) - parseInt(done_items);

	$('#to-do-lists li.checked').hide()

	if ( item_left = 0 ) {
		$('.ltd-nav').hide()
	}else if( item_left < 2 ){
		$('.count', '.ltd-nav').text( item_left + ' Item left' )
	}else if( item_left >= 2 ){
		$('.count', '.ltd-nav').text( item_left + ' Items left' )
	}

	console.log(item_left)

	function update_item_status( id, status ){
		$.ajax({
			url: LTD.ajaxurl,
			data: { action: 'update-status', id: id, status:status },
			type: 'POST',
			dataType: 'JSON',
			success: function( resp ) {
				console.log(resp);
			},
			error: function( resp ) {
				console.log(resp)
			}
		});
	};

	function delete_item( id ) {
		$.ajax({
			url: LTD.ajaxurl,
			data: { action: 'delete-item', id: id },
			type: 'POST',
			dataType: 'JSON',
			success: function( resp ) {
				console.log(resp)
			},
			error: function( resp ) {
				console.log(resp)
			}
		});
	}

	$('#ltd-form').on('submit', function(e){
		e.preventDefault();
		var $formData = $( this ).serializeArray();
		$.ajax({
			url: LTD.ajaxurl,
			data: $formData,
			type: 'POST',
			dataType: 'JSON',
			success: function( resp ) {
				if ( resp.list ) {
					$('#to-do-lists').html( resp.list )
				}
				$('#item').val( '' )
			},
			error: function( resp ) {
				console.log(resp)
			}
		});
	} );

	$(document).on( 'click', '#to-do-lists li .checkbox', function(e){
		var par = $(this).parent();
		if($(this).prop("checked") == true){
            par.addClass( 'checked' )
            par.hide()
            update_item_status( par.data('id'), 'completed' );
        }
        else if($(this).prop("checked") == false){
            par.removeClass( 'checked' )
            par.show()
            update_item_status( par.data('id'), '' );
        }
        done_items = $('#to-do-lists li.checked').length
        item_left = all_items - done_items;
	} );

	$(document).on( 'change', '.text', function() {
		var par = $(this).parent()
		$.ajax({
			url: LTD.ajaxurl,
			data: { action: 'update-item', id:par.data('id'), value: $(this).val() },
			type: 'POST',
			dataType: 'JSON',
			success: function( resp ) {
				console.log(resp)
			},
			error: function( resp ) {
				console.log(resp)
			}
		});
	} );

	$(document).on( 'click', '.rmv-btn', function() {
		var par = $(this).parent()
		par.remove();
		delete_item( par.data('id') );
	} );

	$(document).on( 'click', '.clear-completed', function() {
		var par = $(this).parent();
		var items = $('li.checked');

		items.each( function(){
			delete_item( $(this).data('id') )
			$(this).remove()
		} );
	} );


	$( '.ltd-nav .filter .ltd-button' ).on( 'click', function(e){

		var show = $(this).data('show');

		if ( show == 'all' ) {
			$('#to-do-lists li').show();
			$('#to-do-lists li.checked').show();
		}
		if ( show == 'active' ) {
			$('#to-do-lists li').show();
			$('#to-do-lists li.checked').hide();
		}
		if ( show == 'completed' ) {
			$('#to-do-lists li').hide();
			$('#to-do-lists li.checked').show();
		}

		$('.ltd-nav .filter .ltd-button').removeClass( 'active' );
		$(this).addClass( 'active' );
	} );
})