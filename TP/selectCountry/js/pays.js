$('#paysList').on('change', function(){
	var idPays = $(this).val();
	
	$.ajax({
	  type: 'GET',
	  url: '/projet/php/TP/selectCountry/ajaxpays.php',
	  // data to be added to query string:
	  data: { id: idPays },
	  // type of data we are expecting in return:
	  dataType: 'json',
	  timeout: 300,
	  // context: $('#detailsPays'),
	  success: function(data){
	    var $detailsPays = $('#detailsPays');
	    $detailsPays.find('.capitale').html('<strong>' + data.capitale + '</strong>');
	    $detailsPays.find('.habitants').html('<strong>' + data.nombrehab + '</strong>');
	    $detailsPays.find('.superficie').html('<strong>' + data.superficie + '</strong>');
	    $detailsPays.find('.langues').html('<strong>' + data.langues + '</strong>');
	    $detailsPays.find('.flag').attr('src', '/projet/php/TP/selectCountry/img/flags/' + data.pays + '.png');
	  },
	  error: function(xhr, type){
	    alert('Ajax error!')
	  }
	})
});