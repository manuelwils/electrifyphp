<div class="row">
	<div class="col-md-12">
		<!-- echo display message -->
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" method="post" name="registration_form" action="./store" id="reg_form" enctype="multipart/formdata">
			<h2>Please Sign Up <small>It's free and always will be.</small></h2>
			<hr class="colorgraph">
			<div id="errorss"> <!-- generate errors from js --></div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1"> </div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2"> </div>
				</div>
			</div>
			<div class="form-group">
				<input type="text" name="display_name" id="display_name" class="form-control input-lg" placeholder="Display Name" tabindex="3"> </div>
			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4"> </div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12" id="pass_str"></div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5"> </div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="confirm_password" id="confirm_password" class="form-control input-lg" placeholder="Confirm Password" tabindex="6"> </div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12" id="pass_req"><small>password must contain at least an uppercase, lowercase, number and special character(symbol)</small></div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<div class="captcha">
							<img src="<?php echo assets('images/captcha.jpg'); ?>" />
							<div class="captcha-text"><?php echo rand_session_integers(); ?></div>
						</div>
						<br />
						<br />
						<input type="text" name="captcha" class="form-control input-lg" tabindex="3" placeholder="Enter Captcha Code">
					</div>
				</div>
			</div>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
				</div>
				<div class="col-xs-12 col-md-6"><a href="./login" class="btn btn-success btn-block btn-lg">Sign In</a></div>
			</div>
		</form>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
			</div>
			<div class="modal-body">
				<p>This is a dempo Terms and Conditions and Will be replaced by the original one</p>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	/**
	 * IIFE
	 */
	!(function() {

		let register_form = document.getElementById('reg_form');

		// form submit function
		let formSubmitDriver = (e) => {

			//prevent page reload
			e.preventDefault();

			//query all input files
			let inputs = document.querySelectorAll('input');

			// get all erros
			let errors = [];

			let password_strength = "";

			//loop through inputs and check for any empty field
			[].forEach.call(inputs, function(e) {

				//console.log(e.getAttribute('type') == 'text' ? e : '')

				if((e.getAttribute('type') == 'text' || e.getAttribute('type') == 'email') && e.value.trim() == '') {

					//console.log(`${e.getAttribute('name')} cannot be empty`)

					errors.push(`${e.getAttribute('name')} cannot be empty`)

				}
			});

			let regEx = /^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[~!@#$%^&\*\(\)\_\-\+\=\{\}\|\:\;\"\'\?\>\<\.\,]).{8,}$/

			let password = document.getElementById('password').value
			let confirm_password = document.getElementById('confirm_password').value

			if(password !== confirm_password) {
				errors.push("password confirmation not match")
			}

			let pass_str_view = document.getElementById('pass_str');

			if(regEx.test(password)) {
				password_strength = "Strong";
			} else {
				errors.push("password too weak");
				password_strength = "Weak";
			}

			pass_str_view.innerHTML = `Password strength: ${password_strength}`;

			if(errors.length !== 0) {
				for(let i = 0; i < errors.length; i++) {
					//document.getElementById('errorss').innerHTML += `<div class="border text-danger m-1 p-1"><small>${errors[i]}</small></div>`;
					alert(errors[i])
				}
				return;
			}
			
			let form_data = new FormData(register_form)

			// make ajax request to submit form
			let xhr = new XMLHttpRequest();

			let url = register_form.getAttribute('action');

			xhr.open('POST', url, true);

			xhr.onreadystatechange = function() {

				// call a function when the state changes.

				if(xhr.readyState == 4 && xhr.status == 200) {

					if(xhr.response === "") {
						document.location = "/login";
					}
					else {
						alert(xhr.response)
					}

				}
				
			}

			xhr.send(form_data);

		}

		//call form submit function 'on submit'
		register_form.addEventListener('submit', formSubmitDriver, false);
		
	})();
</script>