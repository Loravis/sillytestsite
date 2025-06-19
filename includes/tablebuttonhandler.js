function setFormValues() {
    let form = document.forms["open_edit_modal"];
    let roomnr = form["roomnr"].value;
    
    let edit_form = document.forms["edit_new_form"];
    edit_form["edit_new_roomnr"].value = roomnr;
    return false;
}