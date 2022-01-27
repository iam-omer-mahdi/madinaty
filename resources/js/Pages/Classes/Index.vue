<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container d-flex gap-4 flex-column justify-content-start align-items-start">
        
        <Link class="btn btn-success" :href="route('classes.create')">اضافة فصل</Link>

        <input type="text" class="form-control w-50 mt-2" v-model="search" placeholder="ابحث  ...">

        <div class="row w-100 g-0">
          <!-- <div class="col-12 col-md-6">
            <select name="school_filter" id="school_filter" class="form-select" v-model="school_id">
              <option value="">الكل</option>
              <option :value="school.id" v-for="school in schools" :key="school.id">{{ school.name }}</option>
            </select>
          </div> -->
          <div class="col-12 col-md-6">
            <select name="grade_filter" id="grade_filter" class="form-select" v-model="grade_id">
              <option value="">الكل</option>
              <option :value="grade.id" v-for="grade in grades" :key="grade.id">{{ grade.name }}</option>
            </select>
          </div>
        </div>

        <div class="table-responsive w-100 bg-white shadow-sm border-top border-success border-2">
          <table class="table align-middle text-center table-bordered mb-0">
            <thead>
              <tr>
                <th>الصف</th>
                <th>اسم الفصل</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cls in classes" :key="cls.id">
                <td>{{ cls.grade.name }}</td>
                <td>{{ cls.name }}</td>
                <td class="d-flex gap-2 justify-content-center">
                  <Link class="btn btn-sm btn-warning" :href="route('classes.edit', cls.id)">تعديل</Link>
                  <Link class="btn btn-sm btn-danger" @click="destroy(cls.id)" as="button">حذف</Link>
                </td>
              </tr>
              <tr v-if="classes.length == 0">
                <td>لاتوجد فصول</td>
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
    classes: Array,
    filters: Array,
  },
  data() {
    return {
      search: this.filters.search,
      school_id: '',
      grade_id: '',
    }
  },
  components: {
    AuthenticatedLayout,
    Link
  },
  watch: {
    search: debounce(function (newSearch, oldSearch) {
      this.$inertia.get(route('classes.index'), {'search': newSearch}, {preserveState: true, replace: true})
    }, 500),
    // school_id: function() {
    //   this.$inertia.get('/dashboard/classes', {'school_filter': this.school_id}, {preserveState: true, replace: true})
    // },
    grade_id: function() {
      this.$inertia.get(route('classes.index'), {'grade_filter': this.grade_id}, {preserveState: true, replace: true})
    }
  },
  methods: {
    filterSchools () {
      this.$inertia.get(route('classes.index'))
    },
    destroy(id) {
      if (confirm("هل انت متأكد ؟ سوف يتم حذف جميع البيانات المتعلقة بهذا العنصر")) {
        this.$inertia.delete(route('classes.destroy',id))
      }
    }
  }
}
</script>

<style>

</style>