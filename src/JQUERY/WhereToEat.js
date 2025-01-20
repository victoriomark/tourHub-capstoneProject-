$(document).ready(function(){

    $(document).on('submit','#modalToWhereToEat',function(event){
        event.preventDefault()

        const DataForm = new  FormData(this)
        DataForm.append('action','store')

        $.ajax({
            url: '../controllers/where_to_eatController.php',
            type: 'POST',
            data: DataForm,
            dataType: 'json',
            contentType: false,
            processData: false,
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
                    url: '../controllers/where_to_eatController.php',
                    type: 'POST',
                    data: {action: 'Delete', Id: Id.target.value},
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