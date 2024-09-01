<!doctype html>
<html class="no-js" lang="en">
<!-- head here -->
<?= $this->include('layout/admin/head') ?>
<!-- end head -->
<style>
    .text-error {
        color: red;
    }
</style>

<body id="form-login">
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <div class="error-pagewrap">
        <div class="error-page-int">
            <div class="text-center m-b-md custom-login">
                <h3>SILAHKAN LOGIN KE APLIKASI</h3>
                <p>Selamat Datang di <?= getenv('app_name') ?></p>
            </div>
            <div class="content-error">
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="email@gmail.com" title="Please enter you username" required="" value="" name="email" id="email" class="form-control">
                                <span class="help-block small text-error e-email">Email anda yang terdaftar</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                <span class="help-block small text-error e-password">Password yang terdaftar pada sistem</span>
                            </div>
                            <div class="checkbox login-checkbox hidden">
                                <label>
                                    <input type="checkbox" class="i-checks"> Remember me </label>
                                <p class="help-block small hidden">(if this is a private computer)</p>
                            </div>
                            <button type="button" class="btn btn-success btn-block loginbtn" onclick="login();">Login</button>
                            <a class="btn btn-default btn-block" href="<?= base_url('register') ?>">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('layout/admin/footer') ?>
</body>
<script src="<?= base_url() ?>assets/form-master/src/jquery.form.js"></script>
<script src="<?= base_url() ?>assets/sweetalert2/dist/sweetalert2.js"></script>
<script>
    var wage = document.getElementById("form-login");
    wage.addEventListener("keydown", function(e) {
        if (e.code === "Enter") {
            login();
        }
    });

    let url = "<?= base_url() ?>";
    login = () => {
        $(".text-error").text("");
        $.ajax({
            type: "POST",
            url: url + "api-login",
            data: {
                email: $('#email').val(),
                password: $('#password').val()
            },
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'validation_failed') {
                    $.each(response.message, function(index, array) {
                        $(".e-" + index).text(array);
                    });
                } else if (response.status == 'success') {
                    Swal.fire({
                        icon: "success",
                        title: "Login Berhasil",
                        text: "Selamat Datang di Aplikasi",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setInterval(() => {
                                location.reload();
                            }, 200);
                        }
                    });
                } else {
                    $(".e-email").text(response.message);
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Ada kendala dengan sistem, mohon tunggu"
                });
            }
        });
    }
</script>

</html>