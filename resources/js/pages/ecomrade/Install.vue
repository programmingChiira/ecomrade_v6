<template>
    <div
        class="profile-card-inf"
        style="display: flex; flex-wrap: wrap; float: left"
    >
        <div class="profile-card-inf__item">
            <button
                v-if="!isPWAInstalled"
                @click="showModal"
                class="btn bg-gradient-primary btn-sm"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Install ecomrade"
                data-bs-toggle="modal"
                data-bs-target="#installPwa"
            >
                <i
                    style="color: white; font-size: 10px"
                    class="fa fa-download"
                    aria-hidden="true"
                ></i>
            </button>
        </div>
    </div>

    <div
        class="modal fade"
        id="installPwa"
        tabindex="-1"
        aria-labelledby="installPwaLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="installPwaLabel">
                        Install ecomrade Browser App
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>

                <div style="padding: 15px" class="container row">
                    <div class="d-flex justify-content-between">
                        <button
                            type="button"
                            class="btn bg-gradient-dark btn-sm"
                            data-bs-dismiss="modal"
                            @click="cancelInstall"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="btn bg-gradient-primary btn-sm"
                            @click="installPWA"
                        >
                            Install
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Install",
    data() {
        return {
            message: "install",
            isPWAInstalled: false,
            showInstallModal: false,
        };
    },

    methods: {
        showModal() {
            this.showInstallModal = true;
        },
        installPWA() {
            this.installPromptEvent.prompt();

            // Hide the modal after installation prompt is shown
            this.installPromptEvent.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === "accepted") {
                    this.showInstallModal = false;
                    this.isPWAInstalled = true;
                }
            });
        },
        cancelInstall() {
            this.showInstallModal = false;
        },
    },
    mounted() {
        window.addEventListener("beforeinstallprompt", (event) => {
            // Prevent the default prompt from showing
            event.preventDefault();

            // Show your custom installation prompt
            this.showInstallModal = true;

            // Save the event for later use
            this.installPromptEvent = event;
        });
    },
};
</script>
