<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container d-flex gap-4 flex-column justify-content-start align-items-start">
        
        <Link class="btn btn-success" href="/dashboard/schools/create">اضافة مدرسة</Link>
        <input type="text" class="form-control w-50 mt-2" v-model="search" placeholder="ابحث  ...">

        <div class="table-responsive w-100 bg-white shadow-sm border-top border-2 border-success">
          <table class="table align-middle text-center table-bordered mb-0">
            <thead>
              <tr>
                <td>الاسم</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="school in schools" :key="school.id">
                <td>{{ school.name }}</td>
                <td class="d-flex gap-2 justify-content-center">
                  <Link class="btn btn-sm btn-warning" :href="`/dashboard/schools/${school.id}/edit`">تعديل</Link>
                  <Link class="btn btn-sm btn-danger" @click="destroy(school.id)" as="button">حذف</Link>
                </td>
              </tr>
              <tr v-if="schools.length == 0">
                <td>لاتوجد مدارس</td>
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
    filters: Array,
  },
  data() {
    return {
      search: this.filters.search,
    }
  },
  components: {
    AuthenticatedLayout,
    Link
  },
  watch: {
    search: debounce(function (newSearch, oldSearch) {
      this.$inertia.get('/dashboard/schools', {'search': newSearch}, {preserveState: true, replace: true})
    }, 500)
  },
  methods: {
    filterSchools () {
      this.$inertia.get('/dashboard/schools')
    },
    destroy(id) {
      if (confirm('هل انت متأكد ؟')) {
        this.$inertia.delete(`/dashboard/schools/${id}`)
      }
    }
  }
}
</script>

<style>

</style>