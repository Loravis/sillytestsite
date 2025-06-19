function isInteger(str) {
  const num = Number(str);
  return Number.isInteger(num);
}

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
    let roomnr_missing = false;
    let floor_missing = false;
    let capacity_missing = false;
    roomnr_missing = setDangerBorder(form, "add_new_roomnr", roomnr == "");
    floor_missing = setDangerBorder(form, "add_new_floor", floor == "");
    capacity_missing = setDangerBorder(form, "add_new_capacity", capacity == "");

    if (roomnr_missing || floor_missing || capacity_missing) {
        document.getElementById("add_new_room_error").innerHTML = "Sie haben noch nicht alle erforderlichen Felder ausgefüllt!";
        return false;
    }

    // Check if any non-integer values were entered
    let roomnr_invalidval = false;
    let floor_invalidval = false;
    let capacity_invalidval = false;
    roomnr_invalidval = setDangerBorder(form, "add_new_roomnr", !isInteger(roomnr));
    floor_invalidval = setDangerBorder(form, "add_new_floor", !isInteger(floor));
    capacity_invalidval = setDangerBorder(form, "add_new_capacity", !isInteger(capacity));

    if (roomnr_invalidval || floor_invalidval || capacity_invalidval) {
        document.getElementById("add_new_room_error").innerHTML = "Ungültige Angaben! Nur ganze Zahlen dürfen angegeben werden.";
        return false;
    }

    return true;
}

function validateEditRoomForm() {
    let form = document.forms["edit_new_form"];
    let roomnr = form["edit_new_roomnr"].value;
    let floor = form["edit_new_floor"].value;
    let capacity = form["edit_new_capacity"].value;
    
    // Check if any required fields were not filled out
    let roomnr_missing = false;
    let floor_missing = false;
    let capacity_missing = false;
    roomnr_missing = setDangerBorder(form, "edit_new_roomnr", roomnr == "");
    floor_missing = setDangerBorder(form, "edit_new_floor", floor == "");
    capacity_missing = setDangerBorder(form, "edit_new_capacity", capacity == "");

    if (roomnr_missing || floor_missing || capacity_missing) {
        document.getElementById("edit_new_room_error").innerHTML = "Sie haben noch nicht alle erforderlichen Felder ausgefüllt!";
        return false;
    }

    // Check if any non-integer values were entered
    let roomnr_invalidval = false;
    let floor_invalidval = false;
    let capacity_invalidval = false;
    roomnr_invalidval = setDangerBorder(form, "edit_new_roomnr", !isInteger(roomnr));
    floor_invalidval = setDangerBorder(form, "edit_new_floor", !isInteger(floor));
    capacity_invalidval = setDangerBorder(form, "edit_new_capacity", !isInteger(capacity));

    if (roomnr_invalidval || floor_invalidval || capacity_invalidval) {
        document.getElementById("edit_new_room_error").innerHTML = "Ungültige Angaben! Nur ganze Zahlen dürfen angegeben werden.";
        return false;
    }

    return true;
}

function resetForm(form_function) {
    let form = document.forms[form_function + "_new_form"];
    form[form_function + "_new_roomnr"].classList.remove("border-danger");
    form[form_function + "_new_floor"].classList.remove("border-danger");
    form[form_function + "_new_capacity"].classList.remove("border-danger");
    document.getElementById(form_function + "_new_room_error").innerHTML = "";
}