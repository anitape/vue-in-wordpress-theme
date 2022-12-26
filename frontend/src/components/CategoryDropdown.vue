<script>
    export default {
        data() {
            return {
                isVisible: 'hidden',
            }
        },
        methods: {
            makeVisible() {
                if (this.isVisible === 'hidden') {
                    this.isVisible = 'visible'
                } else { this.isVisible = 'hidden' }
            }
        },
    };
</script>

<template>
    <div>
        <slot :isVisible="isVisible" :makeVisible="makeVisible"></slot>
    </div>
</template>
