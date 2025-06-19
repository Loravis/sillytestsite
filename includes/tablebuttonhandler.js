function setFormValues(button) {
    const form = button.closest("form");
    const roomnr = form.querySelector('input[name="roomnr"]').value;
    const floor = form.querySelector('input[name="floor"]').value;
    const capacity = form.querySelector('input[name="capacity"]').value;
    
    let edit_form = document.forms["edit_new_form"];
    edit_form["edit_new_roomnr"].value = roomnr;
    edit_form["edit_new_floor"].value = floor;
    edit_form["edit_new_capacity"].value = capacity;
    return false;
}