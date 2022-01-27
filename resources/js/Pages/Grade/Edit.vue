<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container d-flex gap-4 flex-column justify-content-start align-items-start">
        <div class="col-10 mx-auto">
          <h4 class="fw-bold">تعديل الصف</h4>
          <form @submit.prevent="submit" class="shadow-sm border-top border-success border-2 p-4 bg-white">
            <div class="mb-2">
              <label for="name" class="form-label">المدرسة</label>
              <select class="form-select" name="school_id" id="school_id" v-model="form.school_id">
                <option :value="school.id" v-for="school in schools" :key="school.id">{{ school.name }}</option>
              </select>
              <small class="text-danger mt-1 d-inline-block" v-if="errors.school_id">
                {{ errors.school_id }}
              </small>
            </div>
            <div class="mb-4">
              <label for="name" class="form-label">اسم الصف</label>
              <input type="text" name="name" id="name" class="form-control" v-model="form.name">
              <small class="text-danger mt-1 d-inline-block" v-if="errors.name">
                {{ errors.name }}
              </small>
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
    errors: Object,
    grade: Object,
    schools: Array
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.grade.name,
        school_id: this.grade.school_id,
      })
    }
  },
  methods: {
    submit() {
      this.form.put(this.route('grades.update', this.grade.id), {
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