<?php 
	load_file('resource/views/components/header.php');
?>
<div class="container">
    <!-- display message -->
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
                
            </div>     

            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form id="login_form" class="form-horizontal" method="post" role="form" action="./auth">
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="text" class="form-control" name="email" value="" placeholder="Email">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>

                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-4 controls">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </div>
                    </div>
                </form> 


                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            Don't have an account! 
                            <a href="./register">Sign Up Here</a>
                        </div>
                    </div>
                </div>    
            </div>                     
        </div>  
    </div>
</div>

<script>

    /**
     * IIFE
     */

    !(function() {


        let login_form = document.getElementById('login_form');

        // form submit function
        let formSubmitDriver = (e) => {

            //prevent page reload
            e.preventDefault();

            //query all input files
            let inputs = document.querySelectorAll('input');

            // get all erros
            let errors = [];

            //loop through inputs and check for any empty field
            [].forEach.call(inputs, function(e) {

                //console.log(e.getAttribute('type') == 'text' ? e : '')

                if((e.getAttribute('type') == 'text' || e.getAttribute('type') == 'password') && e.value.trim() == '') {

                    //console.log(`${e.getAttribute('name')} cannot be empty`)

                    errors.push(`${e.getAttribute('name')} cannot be empty`)

                }
            });

            if(errors.length !== 0) {
                for(let i = 0; i < errors.length; i++) {
                    alert(errors[i])
                }
                return;
            }

            let form_data = new FormData(login_form)

            // make ajax request to submit form
            let xhr = new XMLHttpRequest();

            let url = login_form.getAttribute('action');

            xhr.open('POST', url, true);

            //Send the proper header information along with the request

            xhr.onreadystatechange = function() {

                // call a function when the state changes.

                if(xhr.readyState == 4 && xhr.status == 200) {
                    
                    let response = JSON.parse(xhr.response);

                    if(response && response.message && response.message !== 'success')
                        alert(response.message);
                    else
                        document.location = './';

                }
                
            }

            xhr.send(form_data);


        }

        //call form submit function 'on submit'
        login_form.addEventListener('submit', formSubmitDriver, false);
        
    })();

</script>

<?php 
	load_file('resource/views/components/footer.php');
?>