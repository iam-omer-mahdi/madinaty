<template>
    <Head title="لوحة التحكم" />

    <BreezeAuthenticatedLayout>
        <div class="container py-5 mt-5">
            
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
}
</script>
