<?=$this->include('layout/admin/head')?>
<body>

	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center custom-login">
				<h3>Buat Akun Baru</h3>
				<p>Silahkan Buat Akun pada menu berikut</p>
			</div>
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Username</label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Ulangi Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email </label>
                                    <input class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Ulangi Email </label>
                                    <input class="form-control">
                                </div>
                                <div class="checkbox col-lg-12">
                                    <input type="checkbox" class="i-checks" checked> Simpan Informasi Login
                                </div>
                            </div>
                            <div class="text-center">
                                <button onclick="register()" class="btn btn-success loginbtn">Register</button>
                                <a href="<?=base_url('login');?>" class="btn btn-default">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
    </div>
   <?=$this->include('layout/admin/head')?>
</body>

</html>
