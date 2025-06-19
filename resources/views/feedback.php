<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikr-mulohaza - Feedback Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        .star-rating .star {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .star-rating .star:hover,
        .star-rating .star.active {
            color: #fbbf24;
            fill: #fbbf24;
        }
        .feedback-type-card {
            transition: all 0.2s ease;
        }
        .feedback-type-card:hover {
            background-color: #f9fafb;
            transform: translateY(-1px);
        }
        .feedback-type-card.selected {
            background-color: #eff6ff;
            border-color: #3b82f6;
        }
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }
        .toast.show {
            transform: translateX(0);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
<!-- Toast Notification -->
<div id="toast" class="toast bg-white border border-gray-200 rounded-lg shadow-lg p-4 max-w-sm">
    <div class="flex items-center">
        <div id="toast-icon" class="flex-shrink-0 w-5 h-5 mr-3"></div>
        <div>
            <div id="toast-title" class="font-medium text-gray-900"></div>
            <div id="toast-message" class="text-sm text-gray-600"></div>
        </div>
    </div>
</div>

<div class="py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Fikr-mulohazangizni bildiring</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Sizning fikringiz biz uchun muhim. Xizmatimizni yaxshilash uchun takliflaringizni va mulohazalaringizni yuboring.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Feedback Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                            <i data-lucide="message-square" class="w-5 h-5"></i>
                            Fikr-mulohaza formi
                        </h2>
                        <p class="text-gray-600 mt-1">Quyidagi formani to'ldiring va biz sizga tez orada javob beramiz.</p>
                    </div>
                    <div class="p-6">
                        <form id="feedbackForm" class="space-y-6">
                            <!-- Personal Information -->
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Ism-familiya</label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Ismingizni kiriting"
                                    >
                                </div>
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email manzil *</label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="email@example.com"
                                    >
                                </div>
                            </div>

                            <!-- Feedback Type -->
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700">Fikr-mulohaza turi *</label>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div class="feedback-type-card border rounded-lg p-3 cursor-pointer" data-type="bug">
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" name="feedbackType" value="bug" id="bug" class="text-blue-600">
                                            <label for="bug" class="flex items-center gap-2 cursor-pointer flex-1">
                                                <i data-lucide="bug" class="w-4 h-4 text-red-500"></i>
                                                Xatolik haqida xabar berish
                                            </label>
                                        </div>
                                    </div>
                                    <div class="feedback-type-card border rounded-lg p-3 cursor-pointer" data-type="feature">
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" name="feedbackType" value="feature" id="feature" class="text-blue-600">
                                            <label for="feature" class="flex items-center gap-2 cursor-pointer flex-1">
                                                <i data-lucide="lightbulb" class="w-4 h-4 text-yellow-500"></i>
                                                Yangi funksiya taklifi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="feedback-type-card border rounded-lg p-3 cursor-pointer" data-type="general">
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" name="feedbackType" value="general" id="general" class="text-blue-600">
                                            <label for="general" class="flex items-center gap-2 cursor-pointer flex-1">
                                                <i data-lucide="message-square" class="w-4 h-4 text-blue-500"></i>
                                                Umumiy fikr-mulohaza
                                            </label>
                                        </div>
                                    </div>
                                    <div class="feedback-type-card border rounded-lg p-3 cursor-pointer" data-type="compliment">
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" name="feedbackType" value="compliment" id="compliment" class="text-blue-600">
                                            <label for="compliment" class="flex items-center gap-2 cursor-pointer flex-1">
                                                <i data-lucide="heart" class="w-4 h-4 text-green-500"></i>
                                                Maqtov va taklif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700">Umumiy baholash *</label>
                                <div class="flex items-center gap-2">
                                    <div class="star-rating flex items-center gap-1">
                                        <i data-lucide="star" class="star w-8 h-8 text-gray-300" data-rating="1"></i>
                                        <i data-lucide="star" class="star w-8 h-8 text-gray-300" data-rating="2"></i>
                                        <i data-lucide="star" class="star w-8 h-8 text-gray-300" data-rating="3"></i>
                                        <i data-lucide="star" class="star w-8 h-8 text-gray-300" data-rating="4"></i>
                                        <i data-lucide="star" class="star w-8 h-8 text-gray-300" data-rating="5"></i>
                                    </div>
                                    <span id="ratingText" class="ml-2 text-sm text-gray-600"></span>
                                    <input type="hidden" name="rating" id="ratingInput" value="0">
                                </div>
                            </div>

                            <!-- Subject and Priority -->
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="subject" class="block text-sm font-medium text-gray-700">Mavzu</label>
                                    <input
                                        type="text"
                                        id="subject"
                                        name="subject"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Qisqacha mavzu"
                                    >
                                </div>
                                <div class="space-y-2">
                                    <label for="priority" class="block text-sm font-medium text-gray-700">Muhimlik darajasi</label>
                                    <select
                                        id="priority"
                                        name="priority"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">Tanlang</option>
                                        <option value="low">Past</option>
                                        <option value="medium">O'rta</option>
                                        <option value="high">Yuqori</option>
                                        <option value="urgent">Shoshilinch</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="space-y-2">
                                <label for="message" class="block text-sm font-medium text-gray-700">Xabar *</label>
                                <textarea
                                    id="message"
                                    name="message"
                                    required
                                    rows="5"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Batafsil fikr-mulohazangizni yozing..."
                                ></textarea>
                            </div>

                            <!-- Contact Permission -->
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="allowContact" name="allowContact" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label for="allowContact" class="text-sm text-gray-700">
                                    Qo'shimcha savollar uchun men bilan bog'lanishingizga ruxsat beraman
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit"
                                class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center justify-center gap-2"
                            >
                                <i data-lucide="send" class="w-4 h-4"></i>
                                Fikr-mulohazani yuborish
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Contact Info -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Bog'lanish</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <h4 class="font-medium mb-1">Email</h4>
                            <p class="text-sm text-gray-600">support@example.com</p>
                        </div>
                        <div>
                            <h4 class="font-medium mb-1">Telefon</h4>
                            <p class="text-sm text-gray-600">+998 90 123 45 67</p>
                        </div>
                        <div>
                            <h4 class="font-medium mb-1">Ish vaqti</h4>
                            <p class="text-sm text-gray-600">
                                Dushanba - Juma<br>
                                9:00 - 18:00
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Tez-tez so'raladigan savollar</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <div>
                            <h4 class="font-medium text-sm mb-1">Javob qachon keladi?</h4>
                            <p class="text-xs text-gray-600">Odatda 24-48 soat ichida javob beramiz.</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-sm mb-1">Xatolikni qanday xabar beraman?</h4>
                            <p class="text-xs text-gray-600">"Xatolik haqida xabar berish" turini tanlab, batafsil ma'lumot bering.</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-sm mb-1">Taklifim amalga oshiriladimi?</h4>
                            <p class="text-xs text-gray-600">Barcha takliflarni ko'rib chiqamiz va imkoniyatga qarab amalga oshiramiz.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Star rating functionality
    let currentRating = 0;
    const stars = document.querySelectorAll('.star');
    const ratingText = document.getElementById('ratingText');
    const ratingInput = document.getElementById('ratingInput');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            currentRating = index + 1;
            updateStars();
            ratingInput.value = currentRating;
            ratingText.textContent = `${currentRating}/5`;
        });

        star.addEventListener('mouseenter', () => {
            highlightStars(index + 1);
        });
    });

    document.querySelector('.star-rating').addEventListener('mouseleave', () => {
        updateStars();
    });

    function highlightStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }

    function updateStars() {
        stars.forEach((star, index) => {
            if (index < currentRating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }

    // Feedback type selection
    const feedbackCards = document.querySelectorAll('.feedback-type-card');
    feedbackCards.forEach(card => {
        card.addEventListener('click', () => {
            feedbackCards.forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            const radio = card.querySelector('input[type="radio"]');
            radio.checked = true;
        });
    });

    // Toast notification
    function showToast(title, message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastIcon = document.getElementById('toast-icon');
        const toastTitle = document.getElementById('toast-title');
        const toastMessage = document.getElementById('toast-message');

        toastTitle.textContent = title;
        toastMessage.textContent = message;

        if (type === 'success') {
            toastIcon.innerHTML = '<i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>';
            toast.className = 'toast bg-white border border-green-200 rounded-lg shadow-lg p-4 max-w-sm';
        } else {
            toastIcon.innerHTML = '<i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>';
            toast.className = 'toast bg-white border border-red-200 rounded-lg shadow-lg p-4 max-w-sm';
        }

        lucide.createIcons();
        toast.classList.add('show');

        setTimeout(() => {
            toast.classList.remove('show');
        }, 4000);
    }

    // Form submission
    document.getElementById('feedbackForm').addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        const feedbackType = formData.get('feedbackType');
        const message = formData.get('message');
        const rating = formData.get('rating');

        if (!feedbackType || !message || rating === '0') {
            showToast('Xatolik', 'Iltimos, barcha majburiy maydonlarni to\'ldiring.', 'error');
            return;
        }

        // Here you would typically send the data to your backend
        console.log('Feedback submitted:', Object.fromEntries(formData));

        showToast('Muvaffaqiyatli yuborildi!', 'Sizning fikr-mulohazangiz uchun rahmat. Tez orada javob beramiz.');

        // Reset form
        e.target.reset();
        currentRating = 0;
        updateStars();
        ratingInput.value = '0';
        ratingText.textContent = '';
        feedbackCards.forEach(c => c.classList.remove('selected'));
    });
</script>
</body>
</html>
