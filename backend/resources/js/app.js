import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("click", (e) => {
    const open = e.target.closest("[data-modal-open]");
    const close = e.target.closest("[data-modal-close]");

    if (open)
        document
            .getElementById(open.dataset.modalOpen)
            ?.classList.remove("hidden");
    if (close)
        document
            .getElementById(close.dataset.modalClose)
            ?.classList.add("hidden");
});
