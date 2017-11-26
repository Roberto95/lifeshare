var postId = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('.edit').on('click', function (event) {
    event.preventDefault();
    postBodyElement=event.target.parentNode.parentNode.childNodes[1];
    //obtener el texto que se va a editar
    var postBody=postBodyElement.textContent;
    postId=event.target.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click', function(){
	$.ajax({
		method: 'POST',
		url: urlEdit,
		data: {body: $('#post-body').val(), postId: postId, _token: token }
	})
	.done(function (msg){
		$(postBodyElement).text(msg['new_body']);
		$('#edit-modal').modal('hide');
	});

});

$('.like').on('click', function(event){
	event.preventDefault();
	postId=event.target.parentNode.parentNode.dataset['postid'];
	var isLike=event.target.previousElementSibling == null ? true : false;
	$.ajax({
		method: 'POST',
		url: urlLike,
		data: {isLike: isLike, postId: postId, _token: token}
	})

	.done(function(){
		//cambia la pagina sin recargar
		event.target.innerText=isLike ? event.target.innerText=='Me gusta' ? 'Te gusta este post' : 'Me gusta' : event.target.innerText=='No me gusta' ? 'No te gusta este post' : 'No me gusta';
		if(isLike){
			event.target.nextElementSibling.innerText='No me gusta';
		}else{
			event.target.previousElementSibling.innerText='Me gusta';
		}

	})

	;
});