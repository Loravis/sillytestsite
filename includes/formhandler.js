// Add or remove a danger border to an element
function setDangerBorder(form, elementName, set) {
    if (set) {
        form[elementName].classList.add("border-danger");
        return true;
    } else {
        form[elementName].classList.remove("border-danger");
        return false;
    }
}

function validateAddRoomForm() {
    let form = document.forms["add_new_form"];
    let roomnr = form["add_new_roomnr"].value;
    let floor = form["add_new_floor"].value;
    let capacity = form["add_new_capacity"].value;
    
    // Check if any required fields were not filled out
    let missing = false;
    missing = setDangerBorder(form, "add_new_roomnr", roomnr == "");
    missing = setDangerBorder(form, "add_new_floor", floor == "");
    missing = setDangerBorder(form, "add_new_capacity", capacity == "");

    if (missing) {
        document.getElementById("add_new_room_error").innerHTML = "Sie haben noch nicht alle erforderlichen Felder ausgefüllt!";
        return false;
    }

    return true;
}

function validateEditRoomForm() {
    let form = document.forms["edit_new_form"];
    let roomnr = form["edit_new_roomnr"].value;
    let floor = form["edit_new_floor"].value;
    let capacity = form["edit_new_capacity"].value;
    
    // Check if any required fields were left empty
    let missing = false;
    missing = setDangerBorder(form, "edit_new_roomnr", roomnr == "");
    missing = setDangerBorder(form, "edit_new_floor", floor == "");
    missing = setDangerBorder(form, "edit_new_capacity", capacity == "");

    if (missing) {
        document.getElementById("edit_new_room_error").innerHTML = "Sie haben noch nicht alle erforderlichen Felder ausgefüllt!";
        return false;
    }

    return true;
}

function resetForm() {
    let form = document.forms["add_new_form"];
    form["add_new_roomnr"].classList.remove("border-danger");
    form["add_new_floor"].classList.remove("border-danger");
    form["add_new_capacity"].classList.remove("border-danger");
    document.getElementById("add_new_room_error").innerHTML = "";
}