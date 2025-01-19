$(document).ready(function (){
    $(document).on('submit','#RegisterModal',function (event){
        event.preventDefault()
        const data = new FormData(this)
        data.append('action','store')
        // handle ajax request
        $.ajax({
            url: 'src/controllers/authController.php',
            type: 'post',
            data: data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res){
                function MessageEroor(fild,message) {
                    if (message) {
                        $(`#${fild}_msg`).html(message)
                        $(`#${fild}`).addClass('is-invalid')
                    } else {
                        $(`#${fild}_msg`).html('')
                        $(`#${fild}`).removeClass('is-invalid')
                    }
                }

                if (res.errors){
                    MessageEroor('FirstName', res.errors.FirstName)
                    MessageEroor('LastName', res.errors.LastName)
                    MessageEroor('Username', res.errors.Username)
                    MessageEroor('password', res.errors.password)
                    MessageEroor('email', res.errors.email)
                    MessageEroor('Address', res.errors.Address)
                    MessageEroor('phoneNumber', res.errors.phoneNumber)
                    MessageEroor('contactPerson', res.errors.contactPerson)
                    return;
                }
                $('#btn_register').html(`
                   <div class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                `)


                if (res.success === true){
                    setTimeout(() =>{
                        $('#RegisterModal').modal('hide')
                        $('#LoginModal').modal('show')
                    },2000)
                }

                // Clear inputs here
                $('#RegisterModal')[0].reset(); // Reset the form
                if (res.success === false){
                    Swal.fire({
                        text: res.message,
                        icon: "error"
                    });
                }
            }
        })
    })

    $(document).on('submit','#LoginModal',function (event){
        event.preventDefault()
        const data = new FormData(this)
        data.append('action','login')
        // handle ajax request
        $.ajax({
            url: 'src/controllers/authController.php',
            type: 'post',
            data: data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res){
                function MessageEroor(fild,message) {
                    if (message) {
                        $(`#${fild}_msg`).html(message)
                        $(`#${fild}`).addClass('is-invalid')
                    } else {
                        $(`#${fild}_msg`).html('')
                        $(`#${fild}`).removeClass('is-invalid')
                    }
                }

                if (res.errors){
                    MessageEroor('username', res.errors.username)
                    MessageEroor('Password', res.errors.Password)
                    return;
                }

                $('#btn_login').html(`
                   <div class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                `)

                if (res.success === true){
                    setTimeout(()=>{
                        window.location.href = 'src/views/userViewAfterLogin.php'
                    },2000)
                }

                if (res.success === false){
                    setTimeout(()=>{
                        $('#messageDis').html(res.message)
                        $('#messageDis').addClass('text-danger');
                        $('#btn_login').html('Login')
                        $('#LoginModal')[0].reset(); // Reset the form
                    },2000)
                }
            }
        })
    })

})