//refresh table in one second interval through ajax
setInterval(function () {
    $.ajax({
        url:'my_tickets_data.php',
        success: function(response){
            $('#table_to_refresh').html(response);
        }
    });
}, 5000);
//when html is loaded, get table through ajax
window.addEventListener('load', function(){
    $.ajax({
        url:'my_tickets_data.php',
        success: function(response){
            $('#table_to_refresh').html(response);
        }
    });
});  