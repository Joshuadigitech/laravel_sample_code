$.validator.setDefaults( {
    submitHandler: function (form) {
        form.submit();
       
    }
} );

$( document ).ready( function () {
	$( "#signupForm" ).validate( {
		rules: {
			f_name: {
				required: true,
				maxlength: 15,
			},
			l_name: {
				required: true,
				maxlength: 15,
			},
			country: {
				required: true,
				maxlength: 15,
			},
			company_name: {
				required: true,
				maxlength: 25,
			},
			company_address: {
				required: true,
				maxlength: 50,
			},
			Cnum_of_employee: {
				required: true,
				number:true,
			},
			company_zip: {
				required: true,
				number:true,
				minlength: 4,
			},
			phone_number: {
				required: true,
				number:true,
				maxlength: 25,
			},
			company_phone_number: {
				required: true,
				number:true,
			},
			password: {
				required: true,
				minlength: 8,
			},
			password_confirmation: {
				required: true,
				minlength: 8,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true,
			},

			experience_level: { required: true },
			services: { required: true },

			  mondayHours:{
                  required: function (element) {
                     if($("#ch1").is(':checked')){
                         true;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
              },
               tuesdayHours:{
                  required: function (element) {
                     if($("#ch2").is(':checked')){
                         true;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
              },
               wednesdayHour:{
                  required: function (element) {
                     if($("#ch3").is(':checked')){
                         true;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
              },
               thursdayHours:{
                  required: function (element) {
                     if($("#ch4").is(':checked')){
                         true;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
              },
               fridayHours:{
                  required: function (element) {
                     if($("#ch5").is(':checked')){
                         true;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
              },
               saturdayHours:{
                  required: function (element) {
                     if($("#ch6").is(':checked')){
                         true;                            
                     }
                     else
                     {
                         return false;
                     }  
                  }  
              },
              
              
              req_skills :{
              	required:true,
              },
       

		},
		messages: {
			//f_name: "Please enter your firstname",
			//l_name: "Please enter your lastname",
			// company_name: "Please enter your Company Name",
			// company_address: "Please enter your Company Address",
			// country:"Please enter your Country Name",
			// phone_number: {
			// 	required: "Please enter a phone number",
			// 	//minlength: "Your username must consist of at least 2 characters"
			// },
			// Cnum_of_employee: {
			// 	required: "Please enter a Number of Employes",
			// 	//minlength: "Your username must consist of at least 2 characters"
			// },
			company_zip: {
				minlength: "Enter atlest 4 digit code",
			},                    
			// company_phone_number: {
			// 	required: "Please enter a phone number",
			// 	//minlength: "Your username must consist of at least 2 characters"
			// },
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );

			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parent().addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parent().addClass( "has-success" ).removeClass( "has-error" );
		}
	});
} );
