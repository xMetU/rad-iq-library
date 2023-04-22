window.onload = () => {
    // DOM elements
    const imageView = document.querySelector("#img-view");
    const focusedImageView = document.querySelector("#focused-img-view");
    const focusedImage = document.querySelector("#focused-img");

    // variables
    const minZoom = 1;
    const maxZoom = 2;
    const zoomFactor = 0.1;
    let currentZoom = 0.5;

    initImageView();
    initFocusedImage();

    // ================================================================================
    // INIT FUNCTIONS
    // ================================================================================

    function initImageView() {
        imageView.onclick = (e) => {
            e.preventDefault();
            openFocusedImageViewer();
        }
    }

    function initFocusedImage() {
        initZoom(0.5, 2, 0.1);
    }

    function initZoom() {
        focusedImage.addEventListener("wheel", function (e) {
            e.preventDefault();

            if (e.deltaY < 0) {
                if (currentZoom >= maxZoom) return;
                currentZoom += zoomFactor;
            } else {
                if (currentZoom <= minZoom) return;
                currentZoom -= zoomFactor;
            }

            const { left, top, width, height } = focusedImage.getBoundingClientRect();
            const imageX = ((e.clientX - left) / width) * 100;
            const imageY = ((e.clientY - top) / height) * 100;
            focusedImage.style.transformOrigin = `${imageX}% ${imageY}%`;
            focusedImage.style.transform = `scale(${currentZoom})`;
        });
    }

    // ================================================================================
    // UTILITIES
    // ================================================================================

    function openFocusedImageViewer() {
        focusedImageView.classList.remove("d-none");
    }

    function closeFocusedImageViewer() {
        focusedImageView.classList.add("d-none");
    }
}