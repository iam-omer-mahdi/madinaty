<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container d-flex gap-4 flex-column justify-content-start align-items-start">
        <div class="col-10 mx-auto">
          <h4 class="fw-bold">تعديل المدرسة</h4>
          <form @submit.prevent="submit" class="shadow-sm border-top border-success border-2 p-4 bg-white">
            <div class="mb-3">
              <label for="name" class="form-label">اسم المدرسة</label>
              <input type="text" class="form-control" name="name" id="name" v-model="form.name" />
            </div>
            <button class="btn btn-success w-100" :disabled='form.processing'>تعديل</button>
          </form>
        </div>
      </div>
    </section>
  </authenticated-layout>
</template>

<script>
import AuthenticatedLayout from '../../Layouts/Authenticated.vue'
import {Link} from '@inertiajs/inertia-vue3'
export default {
  props: {
    school: Object
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.school.name,
      })
    }
  },
  methods: {
    submit() {
      this.form.put(this.route('schools.update', this.school.id), {
          onFinish: () => this.form.reset('name'),
      })
    }
  },
  components: {
    AuthenticatedLayout,
    Link
  }
}
</script>

<style>

</style>