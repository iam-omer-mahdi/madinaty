<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container-fluid">
        <Link class="btn btn-success mb-2" :href="route('students.create')"
          >اضافة طالب</Link
        >

        <input
          type="text"
          class="form-control my-2"
          v-model="search"
          placeholder="ابحث  ..."
        />

        <div class="row">
          <div class="col-12 col-md-4">
            <select
              name="filter"
              id="filter"
              class="form-select my-2"
              v-model="school_filter"
            >
              <option value="">كل المدارس</option>
              <option
                :value="school.id"
                v-for="school in schools"
                :key="school.id"
              >
                {{ school.name }}
              </option>
            </select>
          </div>
          <div class="col-12 col-md-4">
            <select
              name="filter"
              id="filter"
              class="form-select my-2"
              v-model="grade_filter"
            >
              <option value="">كل الصفوف</option>
              <option :value="grade.id" v-for="grade in grades" :key="grade.id">
                {{ grade.name }}
              </option>
            </select>
          </div>
          <div class="col-12 col-md-4">
            <select
              name="filter"
              id="filter"
              class="form-select my-2"
              v-model="class_filter"
            >
              <option value="">كل الفصول</option>
              <option :value="cls.id" v-for="cls in classes" :key="cls.id">
                {{ cls.name }}
              </option>
            </select>
          </div>
        </div>

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
                <th>الاسم</th>
                <th>تاريخ الميلاد</th>
                <th>ولي الامر</th>
                <th>هاتف ولي الامر</th>
                <th>البريد الالكتروني</th>
                <th>المدرسة</th>
                <th>الصف</th>
                <th>الفصل</th>
                <th></th>
              </tr>
            </thead>
            <tbody v-if="students.data.length == 0">
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr>
            </tbody>
            <tbody v-if="students.data.length > 0">
              <tr v-for="student in students.data" :key="student.id">
                <td>{{ student.name }}</td>
                <td>{{ student.birth_date }}</td>
                <td>{{ student.guardian_name }}</td>
                <td>{{ student.guardian_phone }}</td>
                <td>{{ student.email }}</td>
                <td>{{ student.school.name }}</td>
                <td>{{ student.grade.name }}</td>
                <td v-if="student.cls">{{ student.cls.name }}</td>
                <td v-if="!student.cls">-</td>
                <td class="d-flex gap-2 justify-content-center">
                  <div class="dropstart">
                    <button
                      type="button"
                      class="btn btn-info btn-sm"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      <i class="lnr lnr-menu fw-bold"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <Link class="dropdown-item d-flex gap-2" :href="route('results.create', {std: student.id})" > <i class="lnr lnr-file-add"></i> اضافة نتيجة </Link>
                      </li>
                      <li>
                        <Link class="dropdown-item d-flex gap-2" :href="this.route('results.show', student.id)" ><i class="lnr lnr-license text-success"></i> عرض النتيجة</Link>
                      </li>
                      <li>
                        <Link class="dropdown-item d-flex gap-2" :href="route('students.edit', student.id)" > <i class="lnr lnr-pencil text-warning"></i> تعديل</Link>
                      </li>
                      <li>
                        <Link class="dropdown-item d-flex gap-2" @click="destroy(student.id)" as="button" ><i class="lnr lnr-trash text-danger"></i> حذف</Link>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <div class="d-flex flex-wrap gap-1 justify-content-center my-4">
            <Link
              v-for="link in students.links"
              :key="link.label"
              :class="`${
                link.active ? 'btn btn-success btn-sm' : 'btn btn-sm border'
              }`"
              :href="link.url"
              v-html="link.label"
            ></Link>
          </div>
        </div>
      </div>
    </section>
  </authenticated-layout>
</template>

<script>
import AuthenticatedLayout from "../../Layouts/Authenticated.vue";
import { Link } from "@inertiajs/inertia-vue3";
import debounce from "lodash/debounce";
export default {
  props: {
    students: Object,
    classes: Array,
    schools: Array,
    grades: Array,
    filters: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        grade_id: null,
      }),
      school_filter: "",
      grade_filter: "",
      class_filter: "",
      search: this.filters.search,
    };
  },
  components: {
    AuthenticatedLayout,
    Link,
  },
  watch: {
    search: debounce(function (newSearch, oldSearch) {
      this.$inertia.get(
        route("students.index"),
        { search: newSearch },
        { preserveState: true, replace: true }
      );
    }, 300),
    school_filter: debounce(function (value) {
      this.$inertia.get(
        route("students.index"),
        { school_filter: value },
        { preserveState: true, replace: true }
      );
    }, 300),
    grade_filter: debounce(function (value) {
      this.$inertia.get(
        route("students.index"),
        { grade_filter: value, school_filter: this.school_filter },
        { preserveState: true, replace: true }
      );
    }, 300),
    class_filter: debounce(function (value) {
      this.$inertia.get(
        route("students.index"),
        {
          class_filter: value,
          grade_filter: this.grade_filter,
          school_filter: this.school_filter,
        },
        { preserveState: true, replace: true }
      );
    }, 300),
  },
  methods: {
    filterSchools() {
      this.$inertia.get(route("students.index"));
    },
    destroy(id) {
      if (confirm("هل انت متأكد ؟ سوف يتم حذف جميع البيانات المتعلقة بهذا العنصر")) {
        this.$inertia.delete(route('students.destroy',id));
      }
    },
  },
};
</script>

<style>
</style>