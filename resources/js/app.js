import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function toggleModal() {
    const body = document.querySelector("body");
    const modal = document.querySelector(".modal");
    modal.classList.toggle("opacity-0");
    modal.classList.toggle("pointer-events-none");
    body.classList.toggle("modal-active");
}

window.toggleModalx = (id) => {
    var modal = document.getElementById('imageModal');
    var img = document.getElementById('picture');
    img.src = id;
    modal.classList.toggle("hidden");
};


window.closeModal = () => {
    var modal = document.getElementById('imageModal');
    modal.classList.toggle("hidden");
};



window.deleteImage = (data) => {
    if (confirm("Yakin hapus file :" + data + "?")) {
        window.location.href = "/admin/images/" + data + "/delete";
    } else {

    }
}

