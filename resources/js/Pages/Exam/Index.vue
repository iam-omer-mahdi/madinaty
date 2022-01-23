<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container">
        <Link href='/dashboard/exams/create' class="btn btn-success">اضافة امتحان</Link>
      </div>
    </section>
  </authenticated-layout>
</template>

<script>
import AuthenticatedLayout from "../../Layouts/Authenticated.vue";
import {Link} from "@inertiajs/inertia-vue3";
import debounce from 'lodash/debounce'
export default {
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
  components: {
    AuthenticatedLayout,
    Link
  },
}
</script>

<style>

</style>