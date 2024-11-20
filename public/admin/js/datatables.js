window.addEventListener("DOMContentLoaded", (event) => {
    // Edit Role
    const editRoleButtons = document.querySelectorAll(".edit-role-btn");
    editRoleButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const roleId = this.getAttribute("data-id");
            const roleName = this.getAttribute("data-name");

            document.getElementById("editRoleName").value = roleName;

            const formAction = document
                .getElementById("editRoleForm")
                .getAttribute("action")
                .replace(":id", roleId);
            console.log(formAction);

            document
                .getElementById("editRoleForm")
                .setAttribute("action", formAction);
        });
    });

    document.getElementById("editRoleForm").addEventListener("submit", function (event) {
        const roleName = document.getElementById("editRoleName").value;
        const errorMessage = document.getElementById("error-message");

        
        if (/\d/.test(roleName)) {
            event.preventDefault(); 
            errorMessage.style.display = 'block'; 
        } else {
            errorMessage.style.display = 'none'; 
        }
    });


    // Edit Organizer
    const editOrganizerButtons = document.querySelectorAll(
        ".edit-organizer-btn"
    );
    editOrganizerButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const organizerId = this.getAttribute("data-id");
            const organizerName = this.getAttribute("data-name");

            document.getElementById("editOrganizerName").value = organizerName;

            const formAction = document
                .getElementById("editOrganizerForm")
                .getAttribute("action")
                .replace(":id", organizerId);
                console.log(formAction);
                
            document
                .getElementById("editOrganizerForm")
                .setAttribute("action", formAction);
        });
    });

    console.log("Script loaded");
    const datatablesSimple = document.getElementById("dataTable");
    if (datatablesSimple) {
        console.log("Table found, initializing DataTable...");
        new simpleDatatables.DataTable(datatablesSimple);
    } else {
        console.log("Table not found!");
    }
});
