$( document ).ready(function() {
	$('[id^="moreInfo"]').click(function() {		
		idNumber = this.id.match(/\d+/);
		var url = 'http://swapi.co/api/starships/';

		$.ajax(
		{
			type : 'GET',
			url : url,
			dataType : 'json',
			success : function(data)
			{
				console.log(data['results'][idNumber]);
				var obj = data['results'][idNumber];
				
				$('.modalDialog').empty();
				$('#modalTitle').html(obj['name']);
				$('#manufacturer').append(obj['manufacturer']);
				$('#starshipClass').append(obj['starship_class']);
				$('#hyperdriveRating').append(obj['hyperdrive_rating']);
				$('#cargoCapacity').append(obj['cargo_capacity']);
				$('#maxAtmospheringSpeed').append(obj['max_atmosphering_peed']);
				$('#MGLT').append(obj['MGLT']);
			}
		});
	});
});