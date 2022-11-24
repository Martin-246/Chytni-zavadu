function get_address(id,lat,lng){
    $.ajax({
        url:'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lng+','+lat+'&location_type=ROOFTOP&result_type=street_address&key=AIzaSyCJVGL83AulBYsKWzBA0ooSruG4_CVIWqA',
        success: function(response){
            // if(!isNaN(response.results[0].address_components[0].short_name[0]))
            // {
            //     first = response.results[0].address_components[1].short_name;
            //     second = response.results[0].address_components[0].short_name;
            // }
            // else
            // {
            //     first = response.results[0].address_components[0].short_name;
            //     second = response.results[0].address_components[1].short_name;
            // }

            // third = response.results[0].address_components[2].short_name;

            // $('#address'+id).html(first + ' ' + second + ', ' + third);
            // console.log (first + ' ' + second + ', ' + third);

            if(response.status !== "ZERO_RESULTS")
            {
                //console.log(id);  
                //console.log(response.results[0].formatted_address);
                //console.log(JSON.parse(response[0].address_components[1].short_name));
                $('#address'+id).html(response.results[0].formatted_address);
            }
            else
                $('#address'+id).html(lat+" : "+lng);
        }
    });
}