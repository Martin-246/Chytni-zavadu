function get_address(id,lat,lng){
    $.ajax({
        url:'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lng+','+lat+'&location_type=ROOFTOP&result_type=street_address&key=AIzaSyCJVGL83AulBYsKWzBA0ooSruG4_CVIWqA',
        success: function(response){
            console.log(id);  
            console.log(response.results[0].formatted_address);
            //console.log(JSON.parse(response[0].address_components[1].short_name));
            $('#address'+id).html(response.results[0].formatted_address);
        }
    });
}