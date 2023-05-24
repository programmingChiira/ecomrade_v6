<template>
    <div
        class="profile-card-inf"
        style="display: flex; flex-wrap: wrap; float: left"
    >
        <div class="profile-card-inf__item">
            <button
                v-if="showButton"
                @click="clearCache"
                class="btn bg-gradient-primary btn-sm"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Clear cache"
            >
                <span> View recent app updates</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showButton: true,
        };
    },
    mounted() {
    // Retrieve the flag value from localStorage when the component is mounted
    const showButton = localStorage.getItem('showButton');
    this.showButton = showButton !== null ? JSON.parse(showButton) : true;
  },
    methods: {
        clearCache() {
            Swal.fire({
                title: "Clear Cache?",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Clear cache!",
            }).then((result) => {
                // Send request to the server
                if (result.value) {
                    if ("caches" in window) {
                        // Clear all caches
                        caches.keys().then((cacheNames) => {
                            cacheNames.forEach((cacheName) => {
                                caches.delete(cacheName);
                            });
                        });
                    }

                    location.reload(true);
                }
            });
            this.showButton = false;
            localStorage.setItem('showButton', JSON.stringify(this.showButton));
        },
    },
};
</script>
