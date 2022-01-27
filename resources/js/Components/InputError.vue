<template>
    <div v-show="message">
        <small class="text-danger">
            {{ message }}
        </small>
    </div>
</template>

<script>
export default {
    props: ['message']
}
</script>
