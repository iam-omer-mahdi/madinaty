<template>
  <authenticated-layout> 
    <section class="py-5">
      <div class="container-fluid">
        <div class="row g-2 no-print">
          <div class="col-12 col-md-6 col-lg-4">
            <label for="grade_id" class="form-label">الصف</label>
            <select name="grade_id" id="grade_id" v-model="grade_id" class="form-select">
              <option v-for="grade in grades" :key="grade.id" :value="grade.id">{{ grade.name }}</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <label for="exam_id" class="form-label">الامتحان</label>
            <select name="exam_id" id="exam_id" v-model="exam_id" class="form-select">
              <option v-for="exam in exams" :key="exam.id" :value="exam.id">{{ exam.name }}</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <label for="class_id" class="form-label">الفصل</label>
            <select name="class_id" id="class_id" v-model="class_id" class="form-select">
              <option value="">الكل</option>
              <option v-for="cls in classes" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
            </select>
          </div>
        </div>

        <div class="table-responsive shadow-sm bg-white mt-4 border-top border-2 border-success" v-if="subjects !== null && subjects.length > 0  && exam_filter !== null">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th>الامتحان</th>
                <th>اسم الطالب</th>
                <th class="text-center" v-for="subject in subjects" :key="subject.id">{{ subject.name }}</th>
                <th class="text-center">المجموع</th>
                <th class="text-center">النسبة المئوية</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="result in filteredResults" :key="result.id">
                <td>{{ result.exam.name }}</td>
                <td>{{ result.student.name }}</td>
                <td class='text-center' v-for="mark in result.mark" :key="mark.id">{{ mark.mark }}</td>
                <td class='text-center'>{{ result.mark.map(mark => mark.mark).reduce((a, b) => a + b, 0) }} \ {{ subjects.map(subject => subject.mark).reduce((a,b) => a+b,0) }}</td>
                <td class='text-center'>{{ Math.trunc(result.mark.map(mark => mark.mark).reduce((a, b) => a + b, 0) / subjects.map(subject => subject.mark).reduce((a,b) => a+b,0) * 100) }} %</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="alert alert-warning mt-4 fw-bold" v-else>لاتوجد نتائج</div>
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
    classes: Array,
    subjects: Array,
    results: Array,
    grades: Array,
    exams: Array,
    grade_filter: Number,
    exam_filter: Number,
  },
  data() {
    return {
      name: null,
      grade_id: this.grade_filter,
      exam_id: this.exam_filter,
      class_id: null,
    }
  },
  computed: {
    filteredResults() {
      if (this.class_id !== null && this.class_id !== '') {
        return this.results.filter(result => result.student.class_id == this.class_id)
      } else {
        return this.results
      }
    }
  },
  watch: {
    'grade_id': function () {
      this.$inertia.get(route('results.index'), {'grade_filter': this.grade_id}, {replace: true})
    },
    'exam_id': function () {
      this.$inertia.get(route('results.index'), {'grade_filter': this.grade_id, 'exam_filter': this.exam_id}, { replace: true})
    }
  },
  methods: {
    destroy(id) {
      if (confirm("هل انت متأكد ؟ سوف يتم حذف جميع البيانات المتعلقة بهذا العنصر")) {
        this.$inertia.delete(route('results.destroy', id))
      }
    }
  },
  components: {
    AuthenticatedLayout,
    Link
  },
}
</script>
