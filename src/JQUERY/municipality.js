$(document).ready(function (){
    $(document).on('submit','#modalCreateMunicipality',function (event){
        event.preventDefault()
        const data = new FormData(this)
        data.append('action','store')
        // handle ajax request
        $.ajax({
            url: '../controllers/municipalityController.php',
            type: 'post',
            data: data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res){
                console.log(res)
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
                    MessageEroor('Municipality', res.errors.Municipality)
                    MessageEroor('Description', res.errors.Description)
                    return;
                }

                if (res.success === true){
                    Swal.fire({
                        text: res.message,
                        icon: "success"
                    });
                    setTimeout(() =>{window.location.reload()},1000)
                }

                if (res.success === false){
                    Swal.fire({
                        text: res.message,
                        icon: "error"
                    });
                }
            }
        })
    })


    // show by id
    $(document).on('click','#btn_edit',function (Id){
        // ajax Requesrt for sending the Id into Tourist Controller
        $.ajax({
            url: '../controllers/municipalityController.php',
            type: 'post',
            data: {Id: Id.target.value,action: 'showById'},
            success: function (data){
                $('body').append(data);
                $(`#modal_update_${Id.target.value}`).modal('show')
            }
        })
    })

    $(document).on('submit','.updateModalMunicipality',function (event){
        event.preventDefault()
        var formData = new FormData(this)
        formData.append('action', 'update')

        // ajax Request
        $.ajax({
            url: '../controllers/municipalityController.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            dataType: 'json',
            success: function (res){
                if (res.success === true){
                    Swal.fire({
                        text: res.message,
                        icon: "success"
                    });
                    setTimeout(() =>{window.location.reload()},1000)
                }

                if (res.success === false){
                    Swal.fire({
                        text: res.message,
                        icon: "error"
                    });
                }
            }
        })
    })

    $(document).on('click','#btn_delete',function (Id){
        console.log(Id.target.value)
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controllers/municipalityController.php',
                    type: 'post',
                    data:{Id: Id.target.value, action: 'delete'},
                    dataType: 'json',
                    success: function (res){
                        if (res.success === true){
                            Swal.fire({
                                text: res.message,
                                icon: "success"
                            });
                            setTimeout(() =>{window.location.reload()},1000)
                        }

                        if (res.success === false){
                            Swal.fire({
                                text: res.message,
                                icon: "error"
                            });
                        }
                    }
                })
            }
        });
    })

})