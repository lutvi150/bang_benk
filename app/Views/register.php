<?= $this->include('layout/admin/head') ?>

<body id="register">

    <div class="error-pagewrap">
        <div class="error-page-int">
            <div class="text-center custom-login">
                <h3>Buat Akun Baru</h3>
                <p>Silahkan Buat Akun pada menu berikut</p>
            </div>
            <div class="content-error">
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="#" id="register-form">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Nama</label>
                                    <input name="nama" class="form-control">
                                    <span class="text-error e-nama"></span>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                    <span class="text-error e-email"></span>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                    <span class="text-error e-password"></span>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Ulangi Password </label>
                                    <input class="form-control" name="u_password">
                                    <span class="text-error e-u_password"></span>
                                </div>
                                <div class="checkbox col-lg-12">
                                    <input type="checkbox" class="i-checks" checked> Simpan Informasi Login
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" onclick="register()" class="btn btn-success loginbtn">Register</button>
                                <button type="button" onclick="login()" class="btn btn-default">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('layout/admin/footer') ?>
</body>
<script>
    let url = "<?= base_url() ?>"
</script>
<script>
    var wage = document.getElementById("register");
    wage.addEventListener("keydown", function(e) {
        if (e.code === "Enter") {
            register();
        }
    });
    login = () => {
        window.location.href = url + "shop-login";
    }
    register = () => {
        $(".text-error").text("");
        $("#register-form").ajaxForm({
            type: "POST",
            url: url + "register",
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'validation_failed') {
                    $.each(response.message, function(i, v) {
                        $(".e-" + i).text(v);
                    });
                } else if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: true,
                    });
                    $("#register-form").trigger("reset");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    })
                    setInterval(() => {
                        login();
                    }, 1500);
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        }).submit();
    }
</script>

</html>