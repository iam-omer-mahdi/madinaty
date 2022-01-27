<template>
    <Head title="تسجيل الدخول" />

    <section class="d-flex flex-column justify-content-center align-items-center min-vh-100">
        
        <div class="col-10 col-sm-8 col-md-6 mx-auto shadow bg-white py-4 px-4 rounded border-top border-success border-2">
            
            <BreezeValidationErrors class="mb-4" />

            <div v-if="status" class="mb-4 text-success">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="login" value="اسم المستخدم او البريد الالكتروني" />
                    <BreezeInput id="login" type="text" class="mt-1 d-block w-100" v-model="form.login" required autofocus autocomplete="login" />
                </div>

                <div class="mt-4 mb-3">
                    <BreezeLabel for="password" value="كلمة المرور" />
                    <BreezeInput id="password" type="password" class="mt-1 d-block w-100" v-model="form.password" required autocomplete="current-password" />
                </div>

                <div class="d-flex justify-content-between">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" >تذكرني</BreezeCheckbox>                

                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-underline text-secondary">
                        هل نسيت كلمة المرور
                    </Link>
                </div>
                <br />
                <BreezeButton class="btn-success w-100" :disabled="form.processing">
                    دخول
                </BreezeButton>
            </form>
        </div>
    
    </section>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                login: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
