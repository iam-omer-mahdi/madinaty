<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container">
        <Link class="btn btn-success" :href="route('subjects.create')">اضافة مادة</Link>

        <input
          type="text"
          class="form-control w-50 mt-2"
          v-model="search"
          placeholder="ابحث  ..."
        />

        <select name="filter" id="filter" class="form-select my-2" v-model="filter">
          <option :value="grade.id" v-for="grade in grades" :key="grade.id">
            {{ grade.name }}
          </option>
        </select>

        <div
          class="
            table-responsive
            w-100
            bg-white
            shadow-sm
            border-top border-success border-2
          "
        >
          <table class="table align-middle text-center table-bordered mb-0">
            <thead>
              <tr>
                <th>الصف</th>
                <th>المادة</th>
                <th>الدرجة الكاملة</th>
                <th></th>
              </tr>
            </thead>
            <tbody v-if="subjects.length == 0">
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr>
            </tbody>
            <tbody v-if="subjects.length > 0">
              <tr v-for="subject in subjects" :key="subject.id">
                <td>{{ subject.grade.name }}</td>
                <td>{{ subject.name }}</td>
                <td>{{ subject.mark }}</td>
                <td class="d-flex gap-2 justify-content-center">
                  <Link
                    class="btn btn-sm btn-warning"
                    :href="route('subjects.edit', subject.id)"
                    >تعديل</Link
                  >
                  <Link
                    class="btn btn-sm btn-danger"
                    @click="destroy(subject.id)"
                    as="button"
                    >حذف</Link
                  >
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
    subjects: Array,
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
      this.$inertia.get(route('subjects.index'), {'search': newSearch}, {preserveState: true, replace: true})
    }, 500),
    filter: debounce(function (value) {
      this.$inertia.get(route('subjects.index'), {'filter': value}, {preserveState: true, replace: true})
    }, 300)
  },
  methods: {
    filterSchools () {
      this.$inertia.get(route('subjects.index'))
    },
    destroy(id) {
      if (confirm("هل انت متأكد ؟ سوف يتم حذف جميع البيانات المتعلقة بهذا العنصر")) {
        this.$inertia.delete(route('subjects.destroy',id))
      }
    }
  }
};
</script>

<style>
</style>