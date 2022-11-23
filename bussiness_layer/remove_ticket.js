//function which sends request to remove ticket
//Takes: int: id of ticket
function remove_ticket(id)
{
    req = new XMLHttpRequest();
    req.open("POST","../bussiness_layer/remove_ticket.php");
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send("remove_ticket=" + id);
}
//function which open confirm request
function handle_remove_button(id)
{
    if (confirm('Ste si istí, že chcete ostrániť ticket s id = ' + id + '?')) {
        remove_ticket(id);
    }
}