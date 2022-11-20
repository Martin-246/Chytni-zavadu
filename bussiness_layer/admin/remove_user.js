function remove_user(id)
{
    req = new XMLHttpRequest();
    req.open("POST","../../bussiness_layer/admin/remove_user.php");
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send("remove_user_id=" + id);
}

function handle_remove_button(id)
{
    if (confirm('Ste si istí, že chcete ostrániť užívaťeľa s id = ' + id + '?')) {
        remove_user(id);
    }
}
