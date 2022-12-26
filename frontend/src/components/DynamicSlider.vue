<script>
export default {
    data() {
        return {
            activeImage: 0,
            totalImages: 0,
            }
        },
        methods: {
            setTotalImages(images) {
                this.totalImages = images;
            }
        },
        mounted() {
            setInterval(() => {
                if (this.activeImage >= this.totalImages - 1) {
                    this.activeImage = 0;
                    return;
                }
                this.activeImage++;
            }, 3000);
        }
}
</script>

<template>
    <div>
        <slot :activeImage="activeImage" :setTotalImages="setTotalImages"></slot>
    </div>
</template>