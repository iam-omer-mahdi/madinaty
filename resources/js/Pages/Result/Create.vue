<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container-fluid">
        <h4 class="fw-bold">اضافة نتيجة</h4>
        
        <form @submit.prevent="submit" class="bg-white shadow-sm p-4 border-top border-2 border-success" v-if="exams.length > 0 && subjects.length > 0">
          <small class="bg-warning text-white py-1 rounded fw-bold my-2 w-100 d-inline-block text-center mx-auto" v-if="errors.student_id">
            لا يمكن اضافة النتيجة لانها موجودة بالفعل
          </small>
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
              <tr>
                <td>
                  {{ student.name }}
                  <input type="hidden" v-model="form.student_id">
                </td>
                <td v-for="(subject, index) in subjects" :key="subject.id">
                  <input type="number" name="marks[]" id="mark" class="form-control" min="0" :max="subject.mark" v-model="form.marks[index]" >
                </td>
              </tr>
            </tbody>
          </table>
          <button type="submit" class="btn btn-success w-100">اضافة</button>
        </form>
        <div class="alert alert-warning fw-bold" v-else>
          لا توجد مواد او امتحانات
        </div>
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
    student: Object,
    subjects: Array,
    exams: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        student_id: this.student.id,
        grade_id: this.student.grade_id,
        exam_id: null,
        subjects: this.subjects.map(subject => subject.id),
        marks: [],
      }),
      filter: '',
      search: '',
    }
  },
  components: {
    AuthenticatedLayout,
    Link
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