<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container d-flex gap-4 flex-column justify-content-start align-items-start">
        
        <Link class="btn btn-success" :href="route('grades.create')">اضافة صف</Link>

        <input type="text" class="form-control w-50 mt-2" v-model="search" placeholder="ابحث  ...">
        
        <select name="filter" id="filter" class="form-select" v-model="filter">
          <option value="">الكل</option>
          <option :value="school.id" v-for="school in schools" :key="school.id">{{ school.name }}</option>
        </select>

        <div class="table-responsive w-100 bg-white shadow-sm border-top border-success border-2">
          <table class="table align-middle text-center table-bordered mb-0">
            <thead>
              <tr>
                <th>المدرسة</th>
                <th>اسم الصف</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="grade in grades" :key="grade.id">
                <td>{{ grade.school.name }}</td>
                <td>{{ grade.name }}</td>
                <td class="d-flex gap-2 justify-content-center">
                  <Link class="btn btn-sm btn-warning" :href="route('grades.edit', grade.id)">تعديل</Link>
                  <Link class="btn btn-sm btn-danger" @click="destroy(grade.id)" as="button">حذف</Link>
                </td>
              </tr>
              <tr v-if="grades.length == 0">
                <td>لاتوجد صفوف</td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </authenticated-layout>
</template>

<script>
import AuthenticatedLayout from '../../Layouts/Authenticated.vue';
import {Link} from '@inertiajs/inertia-vue3'
import debounce from 'lodash/debounce'
export default {
  props: {
    schools: Array,
    grades: Array,
    filters: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        school_id: null,
      }),
      filter: '',
      search: this.filters.search,
    }
  },
  components: {
    AuthenticatedLayout,
    Link
  },
  watch: {
    search: debounce(function (newSearch, oldSearch) {
      this.$inertia.get(route('grades.index'), {'search': newSearch}, {preserveState: true, replace: true})
    }, 500),
    filter: debounce(function (value) {
      this.$inertia.get(route('grades.index'), {'filter': value}, {preserveState: true, replace: true})
    }, 300)
  },
  methods: {
    filterSchools () {
      this.$inertia.get(route('grades.index'))
    },
    destroy(id) {
      if (confirm("هل انت متأكد ؟ سوف يتم حذف جميع البيانات المتعلقة بهذا العنصر")) {
        this.$inertia.delete(route('grades.destroy',id))
      }
    }
  }
}
</script>

<style>

</style>