<template>
    <div class="full-page-loader" v-if="loading">
        <img src="/triangle.svg" alt="Loader" />
    </div>
</template>

<script>
export default {
    name: "Loader",
    data() {
        return {
            loading: true,
        };
    },
    mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 2000);
    },
};
</script>
