import "./bootstrap";

// Edit Note Modal Logic (DaisyUI)
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-note-btn").forEach(function (btn) {
        btn.addEventListener("click", function () {
            // Get note data from button
            const id = btn.getAttribute("data-id");
            const title = btn.getAttribute("data-title");
            const description = btn.getAttribute("data-description");
            const category = btn.getAttribute("data-category");

            // Set form action
            const form = document.getElementById("edit-note-form");
            if (form) {
                form.action = `/notes/${id}`;
                document.getElementById("edit-note-id").value = id;
                document.getElementById("edit-note-title").value = title;
                document.getElementById("edit-note-description").value =
                    description;
                const categorySelect =
                    document.getElementById("edit-note-category");
                if (categorySelect) {
                    Array.from(categorySelect.options).forEach((opt) => {
                        opt.selected = opt.value === category;
                    });
                }
            }

            // Show modal
            const modal = document.getElementById("my_modal_4");
            if (modal && typeof modal.showModal === "function") {
                modal.showModal();
            }
        });
    });
});

// Fade success alerts after number of seconds
const successMsg = document.getElementById("success-msg");

if (successMsg != null) {
    setTimeout(function () {
        // add tailewind opacity class to 0
        successMsg.classList.add("opacity-0");

        // remove alert from DOM
        setTimeout(() => successMsg.remove(), 1000);
    }, 1000);
}
