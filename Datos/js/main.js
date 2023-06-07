const addForm = document.getElementById("add-user-form");
const updateForm = document.getElementById("edit-user-form");
const showAlert = document.getElementById("showAlert");
const addModal = new bootstrap.Modal(document.getElementById("addNewUserModal"));
const editModal = new bootstrap.Modal(document.getElementById("editUserModal"));
const tbody = document.querySelector("tbody");

/**const addForm = document.getElementById('addPay');

//añadir nuevo pago con un jax request
addForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(addForm);
    formData.append("addPay", 1);

    if (addForm.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        addForm.classList.add("was-validated");
        return false;
    } else {
        document.getElementById("add-pay-btn").value = "Please Wait...";

        const data = await fetch("action.php", {
            method: "POST",
            body: formData,
        });
        const response = await data.text();
        showAlert.innerHTML = response;
        document.getElementById("add-pay-btn").value = "Añadir pago";
        addForm.reset();
        addForm.classList.remove("was-validated");
        addModal.hide();
        fetchAllUsers();
    }
});**/

const addform1 = document.getElementById('add-user-form');

//añadir nuevo pago con un jax request
addform1.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(addform1);
    formData.append("add", 1);

    if (addform1.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        addform1.classList.add("was-validated");
        return false;
    } else {
        document.getElementById("add-user-btn").value = "Please Wait...";

        const data = await fetch("../util/action.php", {
            method: "POST",
            body: formData,
        });
        const response = await data.text();
        showAlert.innerHTML = response;
        document.getElementById("add-user-btn").value = "Agregar Cliente";
        addform1.reset();
        addform1.classList.remove("was-validated");
        addModal.hide();
        /**fetchAllUsers();**/
    }
});