var RowNested_last_num = null;

/***
 * Expending a block of the next data under an item $row_num
 */
function Expand($row_num)
{
    var elem;

    // Last hiding
    if(RowNested_last_num != null && RowNested_last_num != $row_num )
    {
        elem = document.getElementsByClassName("RowNested" + RowNested_last_num);
        for(var i = 0; i < elem.length; i++)
        {
            if(elem[i].style.display == "table-row")
                elem[i].style.display="none";
        }
    }
    
    // Actual opening
    RowNested_last_num = $row_num;
    elem = document.getElementsByClassName("RowNested" + $row_num);
    for(var i = 0; i < elem.length; i++)
    {
        if (elem[i].style.display == "none")
            elem[i].style.display="table-row";
        else
            elem[i].style.display="none";
    }
}

/***
 * Popping up of confirmation window, cancels in case 'No' choice
 */
function clicked(event)
{
    if(!confirm('Confirm the action.')){
        event.preventDefault();
        return false;
    }
    else
        return true;
}
/***
 * For manager popping up of confirmation window and cancels in case 'No' choice. Then alerts a window if all fields aren't filled in the form $counter
 */
function clicked_form(event, $counter)
{
    if(clicked(event))
    {
        var elem1 = document.forms["form"+$counter]["task"].value;
        var elem2 = document.forms["form"+$counter]["worker"].value;
        if (elem1 == "" || elem2 == "") {
            alert("Fill in all the fields!");
            event.preventDefault();
        }
    }
}  

/***
 * For worker popping up of confirmation window and cancels in case 'No' choice. Then alerts a window if all fields aren't filled in the form $counter
 */
    function clicked_0_1(event, $counter)
    {
        if(clicked(event))
        {
            var elem1 = document.forms["form"+$counter]["price"].value;
            var elem2 = document.forms["form"+$counter]["expected_date"].value;
            if (elem1 == "" || elem2 == "") {
                alert("Fill in all the fields!");
                event.preventDefault();
            }
        }
    }