<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container-fluid">
        <h4 class="fw-bold">اضافة نتيجة</h4>
        <form @submit.prevent="submit" class="bg-white shadow-sm p-4 border-top border-2 border-success">
          <div class="mb-3">
            <label for="grade_id" class="form-label">الصف</label>
            <select name="grade_id" id="grade_id" class="form-select" v-model="form.grade_id" required>
              <option v-for="grade in grades" :key="grade.id" :value="grade.id">{{grade.name}}</option>
            </select>
            <small class="text-danger mt-1 d-inline-block" v-if="errors.grade_id">
              {{ errors.grade_id }}
            </small>
          </div>
          <div class="mb-3">
            <label for="grade_id" class="form-label">الامتحان</label>
            <select name="grade_id" id="grade_id" class="form-select" v-model="form.exam_id" required>
              <option v-for="exam in exams" :key="exam.id" :value="exam.id">{{exam.name}}</option>
            </select>
            <small class="text-danger mt-1 d-inline-block" v-if="errors.exam_id">
              {{ errors.exam_id }}
            </small>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>الاسم</th>
                <th v-for="subject in subjects" :key="subject.id">{{subject.name}}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for='student in students' :key="student.id">
                <td>{{ student.name }}</td>
                <td v-for="subject in subjects" :key="subject.id">
                  <input type="number" name="" id="" class="form-control">
                </td>
              </tr>
            </tbody>
          </table>
          <button type="submit" class="btn btn-success w-100">اضافة</button>
        </form>
      </div>
    </section>
  </authenticated-layout>
</template>

<script>
import AuthenticatedLayout from "../../Layouts/Authenticated.vue";
import {Link} from "@inertiajs/inertia-vue3";
import debounce from 'lodash/debounce'
export default {
  props: {
    errors: Object,
    students: Array,
    subjects: Array,
    exams: Array,
    grades: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        date: null,
        exam_id: null,
        grade_id: null,
      }),
      filter: '',
      search: '',
    }
  },
  components: {
    AuthenticatedLayout,
    Link
  },
  watch: {
    'form.grade_id': function (value) {
      this.$inertia.get('/dashboard/results/create', {'grade_filter': value}, {preserveState: true, replace: true})
    }
  },
  methods: {
    submit() {
      this.form.post(this.route('results.store'), {
        // onFinish: () => this.form.reset()
      })
    }
  }
}
</script>

<style>

</style>