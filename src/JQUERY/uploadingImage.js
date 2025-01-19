$(document).ready(function (){
    $(document).on('submit','#modalUploadImage',function (event){
        event.preventDefault()
        const data = new FormData(this)
        data.append('action','store')
        // handle ajax request
        $.ajax({
            url: '../controllers/uploadImageController.php',
            type: 'post',
            data: data,
            contentType: false,
            processData: false,
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


    $(document).on('click','#btn_update',function(Id){
        
        $.ajax({
            url: '../controllers/uploadImageController.php',
            type: 'POST',
            data:{action: 'showBaseOnId', Id: Id.target.value},
            success: function(data){
                $('body').append(data)
                $(`#updateImageModal_${Id.target.value}`).modal('show')
            }
        })

    })


    $(document).on('click','#btn_delete',function(Id){
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
             
                // ajax request
                $.ajax({
                    url: '../controllers/uploadImageController.php',
                    type: 'POST',
                    data:{action: 'Delete', Id: Id.target.value},
                    dataType: 'json',
                    success: function(res){
                        if(res.success === true){
                            Swal.fire({
                                title: res.message,
                                text: "Your image has been deleted.",
                                icon: "success"
                              });
                              
                              setTimeout(() =>{window.location.reload()},1000)
                        }

                        if(res.success === false){
                            Swal.fire({
                                title: 'Opps!',
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