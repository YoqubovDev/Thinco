// main.js - Tailwind + AlpineJS/Native JS (No jQuery, No OwlCarousel, No wow.js)

document.addEventListener('DOMContentLoaded', function () {
    // Spinner
    setTimeout(function () {
        const spinner = document.getElementById('spinner');
        if (spinner) {
            spinner.classList.add('hidden');
        }
    }, 1);

    // Sticky Navbar
    const stickyNav = document.querySelector('.sticky-top');
    let lastScroll = window.scrollY;
    window.addEventListener('scroll', function () {
        const currentScroll = window.scrollY;
        if (stickyNav) {
            if (currentScroll > 300) {
                stickyNav.classList.add('shadow-sm', 'top-0');
                stickyNav.classList.remove('-top-24');
            } else {
                stickyNav.classList.remove('shadow-sm', 'top-0');
                stickyNav.classList.add('-top-24');
            }
        }

        // Back to top button
        const backToTop = document.querySelector('.back-to-top');
        if (backToTop) {
            if (currentScroll > 300) {
                backToTop.classList.remove('hidden');
            } else {
                backToTop.classList.add('hidden');
            }
        }
    });

    // Back to top button click
    const backToTopBtn = document.querySelector('.back-to-top');
    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Header carousel (simple version)
    let carouselIndex = 1;
    const slides = [
        {
            img: 'img/carousel-1.jpg',
            title: "Thinko.uz - biz doim siz bilanmiz !",
            desc: "Farzandingiz telefonni foydali ishlatishini xohlaysizmi? Unda Thinko.uz siz uchun! Bu yerda bolalar topshiriq bajaradi, coinlar yig‘adi, badge oladi va o‘z orzulari sari qadam tashlaydi! Biz bilan bilim olish — sarguzasht!"
        },
        {
            img: 'img/carousel-2.jpg',
            title: "Thinko.uz - biz doim siz bilanmiz !",
            desc: "Thinko.uz — bu bolalar uchun yaratilgan innovatsion platforma bo‘lib, ularni bilim olish, sog‘lom hayot tarziga o‘rgatish va real hayotdagi faoliyatga jalb etishga xizmat qiladi. Har bir topshiriq – yangi imkoniyat. Har bir harakat – mukofot bilan rag‘batlantiriladi. Bu yerda bolalar o‘rganadi, harakat qiladi va rivojlanadi."
        }
    ];
    function showCarouselSlide(n) {
        const img1 = document.getElementById('carousel-img-1');
        const img2 = document.getElementById('carousel-img-2');
        const title = document.getElementById('carousel-title');
        const desc = document.getElementById('carousel-desc');
        if (!img1 || !img2 || !title || !desc) return;
        if (n === 1) {
            img1.style.opacity = "1";
            img2.style.opacity = "0";
        } else {
            img1.style.opacity = "0";
            img2.style.opacity = "1";
        }
        title.textContent = slides[n - 1].title;
        desc.textContent = slides[n - 1].desc;
        carouselIndex = n;
    }
    window.showNextSlide = function () {
        showCarouselSlide(carouselIndex === 1 ? 2 : 1);
    };
    window.showPrevSlide = function () {
        showCarouselSlide(carouselIndex === 1 ? 2 : 1);
    };
    setInterval(() => window.showNextSlide(), 7000);
});
