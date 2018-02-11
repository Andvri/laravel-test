<template>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
            <h1 class="title">
                {{message}}
            </h1>
            <h2 class="subtitle">
                Primary subtitle
            </h2>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['message'],
        data() {
            return {
                isActive: true
            }
        }
    }
</script>
