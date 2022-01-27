<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container d-flex gap-4 flex-column justify-content-start align-items-start">
        <div class="col-12 col-md-10 mx-auto">
          <h4 class="fw-bold">اضافة طالب</h4>
          <form @submit.prevent="submit" class="shadow-sm border-top border-success border-2 p-4 bg-white">
            <div class="mb-3">
              <label for="name" class="form-label">المدرسة</label>
              <select class="form-select" name="school_id" id="school_id" v-model="form.school_id" required>
                <option :value="school.id" v-for="school in schools" :key="school.id">{{ school.name }}</option>
              </select>
              <small class="text-danger mt-1 d-inline-block" v-if="errors.school_id">
                {{ errors.school_id }}
              </small>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">الصف</label>
              <select class="form-select" name="grade_id" id="grade_id" v-model="form.grade_id" required>
                <option :value="grade.id" v-for="grade in grades" :key="grade.id">{{ grade.name }}</option>
              </select>
              <small class="text-danger mt-1 d-inline-block" v-if="errors.grade_id">
                {{ errors.grade_id }}
              </small>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">الفصل</label>
              <select class="form-select" name="class_id" id="class_id" v-model="form.class_id">
                <option :value="cls.id" v-for="cls in classes" :key="cls.id">{{ cls.name }}</option>
              </select>
              <small class="text-danger mt-1 d-inline-block" v-if="errors.class_id">
                {{ errors.class_id }}
              </small>
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="name" class="form-label">اسم الطالب</label>
                  <input type="text" name="name" id="name" class="form-control" v-model="form.name" required>
                  <small class="text-danger mt-1 d-inline-block" v-if="errors.name">
                    {{ errors.name }}
                  </small>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="birth_date" class="form-label">تاريخ الميلاد</label>
                  <input type="date" name="birth_date" id="birth_date" class="form-control" v-model="form.birth_date" required>
                  <small class="text-danger mt-1 d-inline-block" v-if="errors.birth_date">
                    {{ errors.birth_date }}
                  </small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="guardian_name" class="form-label">اسم ولي الامر</label>
                  <input type="text" name="guardian_name" id="guardian_name" class="form-control" v-model="form.guardian_name" required>
                  <small class="text-danger mt-1 d-inline-block" v-if="errors.guardian_name">
                    {{ errors.guardian_name }}
                  </small>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="guardian_number" class="form-label">رقم ولي الامر</label>
                  <input type="text" name="guardian_number" id="guardian_phone" class="form-control" v-model="form.guardian_phone">
                  <small class="text-danger mt-1 d-inline-block" v-if="errors.guardian_phone">
                    {{ errors.guardian_phone }}
                  </small>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">البريد الالكتروني</label>
              <input type="email" name="email" id="email" class="form-control" v-model="form.email">
              <small class="text-danger mt-1 d-inline-block" v-if="errors.email">
                {{ errors.email }}
              </small>
            </div>
            <button class="btn btn-success w-100" :disabled='form.processing'>اضافة</button>
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
    grades: Array,
    schools: Array,
    classes: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        birth_date: null,
        email: null,
        guardian_name: null,
        guardian_phone: null,
        school_id: null,
        grade_id: null,
        class_id: null,
      })
    }
  },
  watch: {
    'form.school_id': function (value) {
      this.$inertia.get(route('students.create'), {'grade_filter': value, 'school_filter': this.form.school_id}, {preserveState: true, replace: true})
    },
    'form.grade_id': function (value) {
      this.$inertia.get(route('students.create'), {'class_filter': value,'grade_filter': this.form.grade_id, 'school_filter': this.form.school_id}, {preserveState: true, replace: true})
    }
  },
  methods: {
    submit() {
      this.form.post(this.route('students.store'), {
        onFinish: () => this.form.reset()
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