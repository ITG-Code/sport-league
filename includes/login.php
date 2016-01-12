<div class="row">
  <div class="col-md-4"></div>
  <form class="form-horizontal well col-md-4" action="?page=admin.php" method="post">
    <fieldset>
      <legend>Admin Login</legend>
      <div class="form-group">
        <label for="loginEmail" class="col-md-2 control-label">Email</label>
        <div class="col-md-10">
          <input type="email" name="loginEmail" class="form-control" placeholder="Email"required="required"/>
        </div>

      </div>
      <div class="form-group">
        <label for="loginPassword" class="col-md-2 control-label">Password</label>
        <div class="col-md-10">
          <input type="password" name="loginPassword" class="form-control" placeholder="Password" required="required"/>
        </div>

      </div>

      <input type="submit" value="Login" name="login" class="btn btn-primary"/>
    </fieldset>
  </form>
  <div class="col-md-4"></div>
</div>
