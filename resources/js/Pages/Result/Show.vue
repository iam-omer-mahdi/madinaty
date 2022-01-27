<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container">
        <h4 class="fw-bold">{{ student.name }}</h4>
        <div v-if="results.length == 0" class="card shadow-sm p-4 text-center fs-4 ">
          لا توجد نتائج
        </div>
        <div class="accordion" id="accordionExample" v-if="results.length > 0">
          <div class="accordion-item mb-3" v-for="result in results" :key="result.id">
            <h2 class="accordion-header" :id="`heading${result.id}`">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="`#collapse${result.id}`" aria-expanded="true" aria-controls="collapseOne">
                {{ result.exam.name }}
              </button>
            </h2>
            <div :id="`collapse${result.id}`" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th v-for="subject in subjects" :key="subject.id">{{ subject.name }}</th>
                      <th>المجموع</th>
                      <th>النسبة المئوية</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td v-for="(mark, index) in result.mark" :key="mark.id">{{ mark.mark }} \ {{ subjects[index].mark }}</td>
                      <td>{{ result.mark.map(mark => mark.mark).reduce((a, b) => a + b, 0) }} \ {{ subjects.map(subject => subject.mark).reduce((a,b) => a+b,0) }}</td>
                      <td>{{ Math.trunc(result.mark.map(mark => mark.mark).reduce((a, b) => a + b, 0) / subjects.map(subject => subject.mark).reduce((a,b) => a+b,0) * 100) }} %</td>
                    </tr>
                  </tbody>
                </table>
                <Link class="btn btn-sm btn-warning" :href="route('results.edit', result.id)">تعديل</Link>
              </div>
            </div>
          </div>
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
    student: Object,
    subjects: Array,
    results: Array,
  },
  data() {
    return {
      
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