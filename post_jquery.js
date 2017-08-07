$(function() {
	var form = $('#post_form');
	var formMessages = $('#form-messages');
	
	$(form).submit(function(event) {
		event.preventDefault();
		var formData = $(form).serialize();
		
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		}).done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			$(formMessages).removeClass('error');
			$(formMessages).addClass('success');

			// Set the message text.
			$(formMessages).text(response);

			// Clear the form.
			$('#first_name').val('');
			$('#last_name').val('');
			$('#post_text').val('');
		}).fail(function(data) {
			// Make sure that the formMessages div has the 'error' class.
			$(formMessages).removeClass('success');
			$(formMessages).addClass('error');

			// Set the message text.
			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('Oops! An error occured and your message could not be sent.');
			}
		});
	
		setTimeout(getTable(), 150);
		
	});
});

$(function() {
	
	$('#db-info').submit(function(event) {
		event.preventDefault();
		getTable();
	});
});

function getTable()
{
	$.ajax({
		type: 'GET',
		url: $('#db-info').attr('action'),
		datatype: 'json'
	}).done(function(response) {
		var posts = jQuery.parseJSON(response);
		$('#data-table').html(createTable(posts));
	});
}

function createTable(posts)
{
	var table = '<table>';
	for(var i=0; i < posts.length; i++)
	{
		table += '<tr><td>' + posts[i].post_id + 
				 '</td><td>' + posts[i].first_name +
				 '</td><td>' + posts[i].last_name +
				 '</td><td>' + posts[i].post_text +
				 '</td><td><button id="'+ posts[i].post_id +'" onclick="deleteRow(this.id)">delete</button></td></tr>'
				 + '<tr><td></td></tr><tr><td></td></tr>';
	}
	table += "</table>";
	return table;
}

function deleteRow(id)
{
	alert(id);
	$.ajax({
		data: {'action': 'deleteRow', 'post_id' : id},
		type: 'POST',
		url: 'test.php'
	}).done(function(response) {
		$('#form-messages').text(response);
		
		setTimeout(getTable(), 300);
	});
}