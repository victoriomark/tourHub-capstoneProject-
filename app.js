$(document).ready(function(){
    $.ajax({
        url: 'src/controllers/reviewsController.php',
        type: 'POST',
        data: {
            action: 'showAll'
        },
        success: function(data) {
            console.log(data)
            $('#reviewContainer').html(data)
        }
    })



   $.ajax({
        url: 'src/controllers/Contact_AndHotLinesController.php',
        type: 'POST',
        data: {
            action: 'Display'
        },
        success: function(data) {
            $('#listContact').html(data);
        }
    })
})