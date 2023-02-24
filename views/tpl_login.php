      
      <div class="col-md-9 mx-5 col-lg-10" style="padding-top: 20px;">
          <p class="text-center"><img class="mb-2" src="./img/bisu.png" alt="" width="75" height="75"></p>
          <h3 class="h5 mb-3 title text-center"><b>AAACCUP RECORDS MANAGEMENT SYSTEM</b></h3>
          <h1 class="h1 mb-5 title text-center"><b>USER LOG-IN</b></h1>
          <div class="alert alert-danger" id="login_alert" role="alert">Invalid user credentials.</div>            
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" name="show_password" onclick="showPassword()" value="remember-me"> Show Password
            </label>
          </div>
          <br>
          <input type="hidden" name="login" value="submit" />
          <button class="w-100 btn btn-lg btn-primary"  name="login" value="submit">Log-in</button>
          <br>
          <hr class="my-4">
          <div class="text-center">
          <small class="text-muted text-center">&copy; AACCUP - BISU Balilihan Campus A.Y. 2022-2023</small>
          </div>
      </div>
    <script>
      $( document ).ready(function() {

        $('button[name=login]').prop('disabled', true);
        $('input[name=show_password]').prop('disabled', true);
        $('#login_alert').hide();

        $('input[name=username]').on('change', function() {  
          checkLoginButton(); 
        });
        $('input[name=password]').on('change', function() {  
          if ($(this).val() != '') {          
            $('input[name=show_password]').prop('disabled', false);
          } else {            
            $('input[name=show_password]').prop('disabled', true);
          }
          checkLoginButton(); 
        });

        $('button[name=login]').on('click', function() {   
            let username = $('input[name=username]').val(); 
            let password = $('input[name=password]').val();
            $.ajax({
                type: 'POST',
                url: "login.php", 
                data: {
                  username: username,
                  password: password
                },
                success: function(resp){
                  var result = JSON.parse(resp);
                  if (result.success) {
                    $(window).attr('location','./index.php')
                  } else {
                    $('#login_alert').show();
                  }                    
                }
            });
        });

      });

      function showPassword() {        
        let input_type = $('input[name=password]').prop('type');
        if (input_type === "password") {
          $('input[name=password]').prop('type', 'text');
        } else {
          $('input[name=password]').prop('type', 'password');
        }
      }

      function checkLoginButton()
      {
        let username = $('input[name=username]').val(); 
        let password = $('input[name=password]').val();
        if (username != '' && password != '') {
          $('button[name=login]').prop('disabled', false);
        } else {              
          $('button[name=login]').prop('disabled', true);
        }
      }

    </script>
