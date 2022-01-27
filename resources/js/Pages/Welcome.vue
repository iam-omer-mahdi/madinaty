<template>
    <Head title="الرئيسية" />

    <GuestLayout>
        <section id="hero" class="py-5 hero text-white min-vh-100">
            <div class="overlay"></div>
            <div class="container d-flex flex-column align-items-start justify-content-center min-vh-100">
                <h1 class="display-2 fw-bold mb-4">نسعي نحو التميز</h1>
                <h4 class="display-6 col-md-6">نسعي دوما لخلق بيئة مدرسية تساعد التلاميذ علي الا بداع و التميز</h4>
                <Link :href="`${route('home')}/#contact`" class="btn btn-success px-5 py-2 mt-3">تواصل معنا</Link>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,128L48,138.7C96,149,192,171,288,202.7C384,235,480,277,576,261.3C672,245,768,171,864,154.7C960,139,1056,181,1152,176C1248,171,1344,117,1392,90.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </section>
        <section id="about" class="pb-5 pt-5 pt-md-4 bg-white">
            <div class="container">
                <h4 class="h3 fw-bold mb-4">مرحبا بك في مدارس مدينتي:</h4>
                <p class="lead">
                    في عالمنا الذي يتزايد فيه التنافس  يمنح التعليم عالي الجودة الطلاب خيارات أوسع وفرصًا أفضل في الكلية والجامعة
                    من خلال نظام تعليم مدارس مدينتي يتعلم الطلاب بالكفاءة الكاملة من حيث الوقت و الجهد و يتم منحهم الدعم الذي يحتاجون اليه مما يمكنهم من الوصول الي المهارات و الادوات اللازمة للنجاح طوال حياتهم 
                </p>
            </div>
        </section>
        <section class="py-5" id="calendar">
            <div class="container">
                <h4 class="h3 fw-bold mb-4 d-flex gap-2"><i class="lnr lnr-calendar-full"></i>  التقويم الدراسي 2020 / 2021:</h4>
                <div class="table-responsive border-top border-success border-4 shadow-sm bg-white">
                    <table class="table table-bordered mb-0">
                        <thead class="">
                            <tr>
                                <th>الفترة</th>
                                <th>من</th>
                                <th>الي</th>
                                <th>ملحوظات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>الفترة الاولي</td>
                                <td>9 / 20</td>
                                <td>1 / 30</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>العطلة</td>
                                <td>2 / 1</td>
                                <td>2 / 7</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>الفترة الثانية</td>
                                <td>2 / 8</td>
                                <td>5 / 30</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>النهائي</td>
                                <td>5 / 8</td>
                                <td>5 / 19</td>
                                <td>من الاول الي السادس</td>
                            </tr>
                            <tr>
                                <td>شهادة الاساس</td>
                                <td>5 / 22</td>
                                <td>5 / 30</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section id="faq" class="py-5">
            <div class="container">
                <h4 class="h3 fw-bold mb-4 d-flx gap-2">
                    <i class="lnr lnr-question-circle"></i>
                    الاسئلة المتكررة:
                </h4>
                <div class="accordion accordion-success" id="faq">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading1">
                            <button class="btn btn-success w-100 d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            <span>السؤال الاول</span>
                            <i class="bi bi-chevron-down"></i>
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#faq">
                            <div class="accordion-body">
                                كل من موظفينا المتفانين العمل معا لتخطيط الدروس والأنشطة من أجل دمج مجموعة من السيناريوهات من واقع الحياة، وتلعب الخبرات وفرص حل المشكلة وعمل كتاب.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading2">
                            <button class="btn btn-success w-100 d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                            <span>السؤال الثاني</span>
                            <i class="bi bi-chevron-down"></i>
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faq">
                            <div class="accordion-body">
                                كل من موظفينا المتفانين العمل معا لتخطيط الدروس والأنشطة من أجل دمج مجموعة من السيناريوهات من واقع الحياة، وتلعب الخبرات وفرص حل المشكلة وعمل كتاب.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading3">
                            <button class="btn btn-success w-100 d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            <span>السؤال الثالث</span>
                            <i class="bi bi-chevron-down"></i>
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faq">
                            <div class="accordion-body">
                                كل من موظفينا المتفانين العمل معا لتخطيط الدروس والأنشطة من أجل دمج مجموعة من السيناريوهات من واقع الحياة، وتلعب الخبرات وفرص حل المشكلة وعمل كتاب.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact" class="pt-5 bg-dark text-white">
            <div class="container">
                <header class="d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold">
                        <i class="lnr lnr-apartment"></i>
                        مدارس <span class="text-success">مدينتي</span>
                    </h4>
                </header>
                <div class="row py-2">
                    <div class="col-12 col-md-8">
                        <p class="lead"><i class="lnr lnr-map-marker"></i>
                        شرق النيل حي الفيحاء مربع 5 غرب جامعة النيل</p>
                        
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3842.92592679051!2d32.616312!3d15.595606000000002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x60eea839e874ce99!2z2YXYr9ix2LPYqSDZhdiv2YrZhtiq2Yo!5e0!3m2!1sen!2sus!4v1642055680709!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="col-12 col-md-4">
                        <p class="lead ms-md-4">
                            <i class="lnr lnr-phone-handset"></i>
                            هواتفنا :-
                        </p>        
                        <ul class="ms-md-4 nav d-flex flex-wrap gap-4 justify-content-between">
                            <li class="nav-item border-top border-3 border-success p-2 d-grid w-100 bg-white text-dark rounded-bottom">
                                <strong>الادارة: </strong>
                                <span>0912505706</span>    
                                <span>0924008888</span>    
                            </li>    
                            <li class="nav-item border-top border-3 border-success p-2 d-grid w-100 bg-white text-dark rounded-bottom">
                                <strong>مدير مدرسة البنات: </strong>
                                <span>0925118815</span>    
                            </li>    
                            <li class="nav-item border-top border-3 border-success p-2 d-grid w-100 bg-white text-dark rounded-bottom">
                                <strong>مدير مدرسة الاولاد: </strong>
                                <span>0925118816</span>    
                            </li>    
                            <li class="nav-item border-top border-3 border-success p-2 d-grid w-100 bg-white text-dark rounded-bottom">
                                <strong>شؤون البنين: </strong>
                                <span>09100003446</span>    
                            </li>    
                            <li class="nav-item border-top border-3 border-success p-2 d-grid w-100 bg-white text-dark rounded-bottom">
                                <strong>شؤون الطالبات: </strong>
                                <span>09100003445</span>    
                            </li>    
                        </ul>                
                    </div>
                </div>

            </div>
        </section>
        <footer class="bg-black py-2 text-white text-center">
            <span>جميع الحقوق محفوظة | {{new Date().getFullYear()}}</span>
        </footer>  
    </GuestLayout>

</template>

<style scoped>

section {
    background-color: #fff;
}
section#calendar {
    background-color: transparent;
}

.hero {
    background: url('../images/hero.jpeg');
}
.overlay {
    position: absolute;
    content: '';
    inset: 0;
    width: 100%;
    z-index: 2;
    background-color: rgba(0, 0, 0, 0.3);
}
.min-vh-100 {
    min-height: 80vh !important;
}

.hero {
    position: relative;
    background-position: 50% 10% 0%;
}
.hero .container {
    position: relative;
    z-index: 4;
}
svg {
    position: absolute;
    content: '';
    width: 100%;
    left: 0;
    bottom: -2px;
    z-index: 2;
}
table,td,th,tr {
    white-space: nowrap;
}
i {
    display: inline-block;
}
</style>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import GuestLayout from '../Layouts/Guest';

export default {
    components: {
      Head,
      Link,
      GuestLayout
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
}
</script>
