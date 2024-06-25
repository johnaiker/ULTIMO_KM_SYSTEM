$().ready(function () { 

	
	// Inputmask("####-##-##", {
	// 	placeholder: "-",
	// 	greedy: false,
	// 	casing: "upper",
	// 	jitMasking: true
	// }).mask('#fecha_n');

	Inputmask("##/##", {
		placeholder: "-",
		greedy: false,
		casing: "upper",
		jitMasking: true
	}).mask('#fecha_pago');
	
	$(":input").inputmask();

	// Fecha de Nacimiento
	$(function () {
		$("#fecha_n").
		datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
	});
	
	$(function () {
		$(".fecha_input").
		datepicker({
			dateFormat: 'yy-mm-dd',
		});
	});

	$('#fecha_ida').change(function() { 
		startDate = $(this).
		datepicker('getDate'); 
		$("#fecha_ret").
		datepicker("option", "minDate", startDate); 
	});
	

	$('#fecha_ret').change(function() { 
		endDate = $(this).
		datepicker('getDate'); 
		$("#fecha_ida").
		datepicker("option", "maxDate", endDate); 
	}) 

	$("#signupForm").validate({ 
		rules: { 
			firstname: "required", 
			lastname: "required", 
			username: { 
				required: true, 
				minlength: 2 // For length of lastname 
			}, 
			password: { 
				required: true, 
				minlength: 5 
			}, 
			confirm_password: { 
				required: true, 
				minlength: 5, 

				// For checking both passwords are same or not 
				equalTo: "#password"
			}, 
			email: { 
				required: true, 
				email: true
			}, 
			agree: "required"
		}, 
		// In 'messages' user have to specify message as per rules 
		messages: { 
			firstname: " Please enter your firstname", 
			lastname: " Please enter your lastname", 
			username: { 
				required: " Please enter a username", 
				minlength: 
					" Your username must consist of at least 2 characters"
			}, 
			password: { 
				required: " Please enter a password", 
				minlength: 
					" Your password must be consist of at least 5 characters"
			}, 
			confirm_password: { 
				required: " Please enter a password", 
				minlength: 
					" Your password must be consist of at least 5 characters", 
				equalTo: " Please enter the same password as above"
			}, 
			agree: "Please accept our policy"
		} 
	}); 

	$('#search_flights').submit((event)=> {
		// event.preventDefault();
		
		// alert("Buscando Vuelos...");
	});
	
});