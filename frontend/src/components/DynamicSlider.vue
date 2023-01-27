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
            },
            nextSlide() {
                if (this.activeImage >= this.totalImages - 1) {
                    this.activeImage = 0;
                    return;
                }
                this.activeImage++;
            },
            prevSlide() {
                if (this.activeImage == 0) {
                    this.activeImage = this.totalImages - 1;
                    return;
                }
                this.activeImage--;
            },
            setActiveImage(number) {
                this.activeImage = number;
            }
        },
        mounted() {
            setInterval(() => {
                if (this.activeImage >= this.totalImages - 1) {
                    this.activeImage = 0;
                    return;
                }
                this.activeImage++;
            }, 5000);
        }
}
</script>

<template>
    <div>
        <slot :activeImage="activeImage" :setTotalImages="setTotalImages" :nextSlide="nextSlide" :prevSlide="prevSlide" :setActiveImage="setActiveImage"></slot>
    </div>
</template>