<template>
    
    <div class="form-check">
        <input type="checkbox" :value="value" v-model="proxyChecked" class="form-check-input" id="flexCheckDefault" />
        <label class="form-check-label" for="flexCheckDefault">
            <slot />
        </label>
    </div>
</template>

<script>
export default {
    emits: ['update:checked'],

    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
    },
}
</script>
