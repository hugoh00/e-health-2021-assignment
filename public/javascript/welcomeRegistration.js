var goodToSubmit = new Boolean(true)
	function formValidation() {
		// alert("check");
		// validating the form before sending to the controller
		goodToSubmit = true;
		//call the main function that will call all validation functions
		validateForm();
		
		//if none have failed goodToSubmit it will be true
		if (goodToSubmit == true) {
			document.register.submit();
		}
	}
	function validateForm() {
		//calling all validation functions
		validateUsernamePasswordEntry();
		validateEmail();	
	}
	function validateUsernamePasswordEntry(){
		let username = document.getElementById("regUsername");
		let email = document.getElementById("regEmail");
		let password = document.getElementById("regPassword");
		if (username.value.length == 0 || password.value.length == 0 || email.value.length == 0) {
			goodToSubmit = false;
			return false;
		} else {
			return true;
		}

	}
	function validateEmail() {
        //checking whether the email is valid through html5 email input type
        let email = document.getElementById("regEmail");
        if (email.checkValidity()) {
            return true;
        } else {
            goodToSubmit = false;
            return false;
        }
	}