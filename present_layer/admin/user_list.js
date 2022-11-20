setInterval(function () {
    $.ajax({
        url:'user_list_data.php',
        success: function(response){
            console.log(response);
            $('#table_to_refresh').html(response);
        }
    });
}, 1000);

window.addEventListener('load', function(){
    $.ajax({
        url:'user_list_data.php',
        success: function(response){
            $('#table_to_refresh').html(response);
        }
    });
});    