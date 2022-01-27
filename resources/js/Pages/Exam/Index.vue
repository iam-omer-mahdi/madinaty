<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container">
        <Link :href="route('exams.create')" class="btn btn-success mb-4">اضافة امتحان</Link>

        <div class="alert alert-warning fw-bold" v-if="exams.length == 0">
          لاتوجد امتحانات
        </div>

        <div class="table-responsive bg-white shadow-sm border-top border-success border-2">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th>الصف</th>
                <th>الامتحان</th>
                <th>التاريخ</th>
                <th></th>
              </tr>
            </thead>
            <tbody v-if="exams.length > 0">
              <tr v-for="exam in exams" :key='exam.id'>
                <td>{{ exam.grade.name }}</td>
                <td>{{ exam.name }}</td>
                <td>{{ exam.exam_date }}</td>
                <td class="text-center">
                  <Link class="btn btn-sm btn-warning me-2" :href="route('exams.edit', exam.id)">تعديل</Link>
                  <Link @click="destroy(exam.id)" as="button" class="btn btn-danger btn-sm">حذف</Link>
                </td>
              </tr>
            </tbody>
          </table>
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
    exams: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        grade_id: null,
      }),
      filter: '',
      search: '',
    }
  },
  methods: {
    destroy(id) {
      if (confirm("هل انت متأكد ؟ سوف يتم حذف جميع البيانات المتعلقة بهذا العنصر")) {
        this.$inertia.delete(route('exams.destroy',id))
      }
    }
  },
  components: {
    AuthenticatedLayout,
    Link
  },
}
</script>

<style>

</style>