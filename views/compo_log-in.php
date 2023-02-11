      
      <div class="col-md-9 mx-5 col-lg-10">
        <form action="#" method="POST" class="p-4 p-md-5 bg-light">
            <p class="text-center"><img class="mb-2" src="./img/bisu.png" alt="" width="75" height="75"></p>
            <h3 class="h5 mb-3 title text-center"><b>AAACCUP RECORDS MANAGEMENT SYSTEM</b></h3>
            <h1 class="h1 mb-5 title text-center"><b>USER LOG-IN</b></h1>
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" onclick="myFunction()" value="remember-me"> Show Password
            </label>
          </div>
          <br>
          <input type="hidden" name="login" value="submit" />
          <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Log-in</button>
          <br>
          <hr class="my-4">
          <div class="text-center">
          <small class="text-muted text-center">&copy; AACCUP - BISU Balilihan Campus A.Y. 2022-2023</small>
          </div>
        </form>
      </div>
    <script>
        function myFunction() {
          var x = document.getElementById("floatingPassword");
          if (x.type === "password") {
              x.type = "text";
          } else {
              x.type = "password";
          }
        }
    </script>
