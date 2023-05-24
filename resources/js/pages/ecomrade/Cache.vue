<template>
    <div
        class="profile-card-inf"
        style="display: flex; flex-wrap: wrap; float: left"
    >
        <div class="profile-card-inf__item">
            <button
                @click="clearCache"
                class="btn bg-gradient-warning btn-sm"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Clear cache"
            >
            <span> Clear cache to view recent app updates</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
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
        },
    },
};
</script>
