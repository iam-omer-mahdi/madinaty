<template>

    <nav class="navbar navbar-expand-md navbar-light bg-white border-success shadow-sm">
        <div class="container">
            <Link class="navbar-brand fw-bold" :href="route('dashboard')">مدارس <span class="text-success">مدينتي</span></Link>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mt-2 mt-lg-0 w-100">
                    <li class="nav-item ms-md-auto">
                        <Link class="nav-link" :href="route('schools.index')">المدارس</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :href="route('grades.index')">الصفوف</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :href="route('classes.index')">الفصول</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :href="route('students.index')">الطلاب</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :href="route('subjects.index')">المواد</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :href="route('exams.index')">الامتحانات</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :href="route('results.index')">النتائج</Link>
                    </li>
                    <li class="nav-item ms-md-auto">
                        <Link :href="route('logout')" method="post" class="btn btn-danger" as="button">تسجيل الخروج</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <flash-messages />

    <!-- Page Content -->
    <main>
        <slot />
    </main>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3';
import FlashMessages from '../Shared/FlashMessages.vue'

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
        FlashMessages,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        }
    },
}
</script>
