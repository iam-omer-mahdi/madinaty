<template>
    <Head title="استعادة كلمة المرور" />

    <section  class="col-12 col-sm-10 col-md-6 mx-auto mt-5 p-4 bg-white shadow-sm border-top border-2 border-success rounded-bottom">

        <h1 class="h5 mb-4 text-secondary">
            هل نسيت كلمة السر ؟ لاتوجد مشكلة فقط ادخل بريدك الالكتروني و سوف نرسل لك رسالة لعمل كلمة مرور جديدة
        </h1>

        <div v-if="status" class="mb-4 text-success">
            {{ status }}
        </div>

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="">
                <label for="email" class="form-label">البريد الالكتروني</label>
                <BreezeInput id="email" type="email" class="mt-1 d-block w-100" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="d-flex align-items-center justify-content-end mt-4">
                <button class="btn btn-success w-100" :disabled="form.processing">
                    ارسال
                </button>
            </div>
        </form>
    </section>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
