
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
        url: url+"register",
        dataType: "JSON",
        success: function (response) {
            if (response.status=='validation_failed') {
                $.each(response.message, function (i,v ) { 
                     $(".e-"+i).text(v);
                });
            } else if(response.status=='success') {
                Swal.fire({
                    icon:'success',
                    title: 'Success',
                    text: response.message,
                    showConfirmButton: true,
                });
            } else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message,
                })
                setInterval(() => {
                    login();
                }, 1500);
            }
        },error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        }
    }).submit();
}