<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white border-success shadow-sm">
          <div class="container">
            <Link class="navbar-brand fw-bold d-flex gap-2" href="/#hero"><i class="lnr lnr-apartment d-inline-block"></i> مدارس <span class="text-success">مدينتي</span></Link>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mt-2 mt-lg-0 w-100">
                    <li class="nav-item">
                        <Link class="nav-link" href="/#about">من نحن</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" href="/#calendar">التقويم</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" href="/#contact">تواصل معنا</Link>
                    </li>
                    <li class="nav-item ms-md-auto">
                        <Link class="nav-link btn btn-success btn-sm text-white px-2" href="/login">تسجيل الدخول</Link>
                    </li>
                </ul>
            </div>
      </div>
    </nav>
    
    <main>
        <slot />
    </main>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    }
}
</script>
