<!doctype html>
<html class="no-js" lang="en">
<!-- head here -->
 <?=$this->include('layout/admin/head')?>
<!-- end head -->
<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<h3>SILAHKAN LOGIN KE APLIKASI</h3>
				<p>Selamat Datang di <?=getenv('app_name')?></p>
			</div>
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">
                                <span class="help-block small">Email anda yang terdaftar</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                <span class="help-block small">Password yang terdaftar pada sistem</span>
                            </div>
                            <div class="checkbox login-checkbox hidden">
                                <label>
										<input type="checkbox" class="i-checks"> Remember me </label>
                                <p class="help-block small hidden">(if this is a private computer)</p>
                            </div>
                            <button class="btn btn-success btn-block loginbtn">Login</button>
                            <a class="btn btn-default btn-block" href="<?=base_url('register')?>">Register</a>
                        </form>
                    </div>
                </div>
			</div>
			<?=$this->include('layout/admin/copyright')?>
		</div>
    </div>
   <?=$this->include('layout/admin/footer')?>
</body>

</html>
