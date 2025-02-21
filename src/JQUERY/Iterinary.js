$(document).ready(function (){
    $(document).on('submit','#modalCreateIterinary',function (event){
        event.preventDefault()
        const data = new FormData(this)
        data.append('action','store')
        // handle ajax request
        $.ajax({
            url: '../controllers/IterinaryController.php',
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


    function loadIterinaries() {
        $.ajax({
            url: '../controllers/IterinaryController.php',
            type: 'post',
            data: { action: 'fetchAll' },
            success: function (res) {
                $("#iterinaryTable").html(res); // Directly append HTML response
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", xhr.responseText);
            }
        });
    }

    // Load itineraries on page load
    loadIterinaries();

    // Handle view button click
    $(document).on("click", ".view-pdf", function () {
        let pdfFile = $(this).data("file");
        window.open(pdfFile, "_blank"); // Open PDF in new tab
    });


    $(document).on('click','#btn_delete',function(id){
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
                    url: '../controllers/IterinaryController.php',
                    type: 'post',
                    data:{id: id.target.value, action: 'delete'},
                    dataType: 'json',
                    success: function(res){
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