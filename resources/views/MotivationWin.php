<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motivatsion Mukofotlar - Bolalar uchun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One:wght@400&family=Nunito:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
            background-size: 400% 400%;
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .reward-title {
            font-family: 'Fredoka One', cursive;
            text-shadow: 3px 3px 0px #ff6b6b, 6px 6px 0px #4ecdc4;
        }

        .reward-card {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 25px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 3px solid transparent;
        }

        .reward-card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            border: 3px solid #ff6b6b;
        }

        .reward-card.earned {
            background: linear-gradient(145deg, #fff3cd, #ffeaa7);
            border: 3px solid #f39c12;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { box-shadow: 0 0 20px #f39c12; }
            to { box-shadow: 0 0 30px #e67e22, 0 0 40px #f39c12; }
        }

        .progress-bar {
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1);
            border-radius: 25px;
            transition: width 1s ease-in-out;
        }

        .bounce-in {
            animation: bounceIn 0.8s ease-out;
        }

        @keyframes bounceIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.2); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        .sparkle {
            animation: sparkle 1.5s ease-in-out infinite;
        }

        @keyframes sparkle {
            0%, 100% { transform: scale(1) rotate(0deg); opacity: 1; }
            50% { transform: scale(1.2) rotate(180deg); opacity: 0.7; }
        }

        .age-badge {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .age-badge:hover {
            transform: scale(1.1);
        }

        .achievement-unlock {
            animation: achievementPop 1s ease-out;
        }

        @keyframes achievementPop {
            0% { transform: scale(0) rotate(-180deg); opacity: 0; }
            50% { transform: scale(1.3) rotate(0deg); opacity: 0.8; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }

        .floating-reward {
            animation: floatReward 3s ease-in-out infinite;
        }

        @keyframes floatReward {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .celebration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #ff6b6b;
            animation: confetti-fall 3s linear infinite;
        }

        @keyframes confetti-fall {
            0% { transform: translateY(-100vh) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">

<!-- Floating Decorations -->
<div class="fixed inset-0 pointer-events-none z-0">
    <div class="sparkle absolute top-10 left-10 text-yellow-400 text-3xl">⭐</div>
    <div class="sparkle absolute top-20 right-20 text-pink-400 text-4xl">🌟</div>
    <div class="sparkle absolute bottom-20 left-20 text-blue-400 text-3xl">✨</div>
    <div class="sparkle absolute bottom-10 right-10 text-purple-400 text-4xl">💫</div>
    <div class="floating-reward absolute top-1/4 left-1/4 text-6xl">🏆</div>
    <div class="floating-reward absolute top-1/3 right-1/3 text-5xl">🎖️</div>
    <div class="floating-reward absolute bottom-1/3 left-1/2 text-4xl">🥇</div>
</div>

<!-- Header -->
<header class="relative z-10 text-center py-8 px-4">
    <div class="bounce-in">
        <h1 class="reward-title text-6xl md:text-8xl text-white mb-4">
            Motivatsion Mukofotlar
        </h1>
    </div>
    <p class="text-2xl text-white font-bold mb-6">🎉 Har bir muvaffaqiyat uchun mukofot! 🏆</p>

    <!-- Age Selection -->
    <div class="flex justify-center space-x-4 mb-8 flex-wrap gap-4">
        <div class="age-badge px-6 py-3 text-white font-bold cursor-pointer" onclick="selectAge('3-5')">
            👶 3-5 yosh
        </div>
        <div class="age-badge px-6 py-3 text-white font-bold cursor-pointer" onclick="selectAge('6-8')">
            🧒 6-8 yosh
        </div>
        <div class="age-badge px-6 py-3 text-white font-bold cursor-pointer" onclick="selectAge('9-12')">
            👦 9-12 yosh
        </div>
    </div>

    <!-- Overall Progress -->
    <div class="max-w-md mx-auto bg-white bg-opacity-20 rounded-2xl p-4 backdrop-blur-sm">
        <h3 class="text-white font-bold mb-2">Umumiy Progress</h3>
        <div class="bg-white bg-opacity-30 rounded-full h-4 mb-2">
            <div class="progress-bar h-4 rounded-full" style="width: 45%"></div>
        </div>
        <p class="text-white text-sm">45% - Davom eting! 💪</p>
    </div>
</header>

<!-- Main Content -->
<main class="relative z-10 container mx-auto px-4 pb-12">

    <!-- 3-5 Age Group Rewards -->
    <div id="age-3-5" class="age-section hidden">
        <h2 class="text-4xl font-bold text-white text-center mb-8">👶 Kichik Qahramonlar (3-5 yosh)</h2>

        <!-- Simple Achievements -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-white mb-4">🌟 Birinchi Mukofotlar</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                <div class="reward-card earned p-4 text-center">
                    <div class="text-4xl mb-2">🎨</div>
                    <h4 class="font-bold text-gray-800 text-sm">Birinchi Rasm</h4>
                    <p class="text-xs text-gray-600">Rasm chizish</p>
                    <div class="text-2xl mt-2">✅</div>
                </div>

                <div class="reward-card p-4 text-center">
                    <div class="text-4xl mb-2 opacity-50">🧩</div>
                    <h4 class="font-bold text-gray-800 text-sm">Birinchi Jumboq</h4>
                    <p class="text-xs text-gray-600">Jumboq yechish</p>
                    <div class="text-2xl mt-2">🔒</div>
                </div>

                <div class="reward-card earned p-4 text-center">
                    <div class="text-4xl mb-2">🎵</div>
                    <h4 class="font-bold text-gray-800 text-sm">Musiqa Ustasi</h4>
                    <p class="text-xs text-gray-600">Musiqa o'ynash</p>
                    <div class="text-2xl mt-2">✅</div>
                </div>

                <div class="reward-card p-4 text-center">
                    <div class="text-4xl mb-2 opacity-50">🌈</div>
                    <h4 class="font-bold text-gray-800 text-sm">Rang Biluvchi</h4>
                    <p class="text-xs text-gray-600">Ranglarni bilish</p>
                    <div class="text-2xl mt-2">🔒</div>
                </div>
            </div>
        </div>

        <!-- Sticker Collection -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-white mb-4">🏷️ Stiker To'plami</h3>
            <div class="bg-white rounded-2xl p-6">
                <div class="grid grid-cols-6 gap-4">
                    <div class="text-3xl text-center p-2 bg-yellow-100 rounded-lg">🐶</div>
                    <div class="text-3xl text-center p-2 bg-pink-100 rounded-lg">🦄</div>
                    <div class="text-3xl text-center p-2 bg-blue-100 rounded-lg opacity-30">🚗</div>
                    <div class="text-3xl text-center p-2 bg-green-100 rounded-lg">🌸</div>
                    <div class="text-3xl text-center p-2 bg-purple-100 rounded-lg opacity-30">🎈</div>
                    <div class="text-3xl text-center p-2 bg-orange-100 rounded-lg">🍎</div>
                </div>
                <p class="text-center mt-4 font-bold text-gray-700">4/6 stiker yig'ildi!</p>
            </div>
        </div>
    </div>

    <!-- 6-8 Age Group Rewards -->
    <div id="age-6-8" class="age-section hidden">
        <h2 class="text-4xl font-bold text-white text-center mb-8">🧒 O'rta Guruh (6-8 yosh)</h2>

        <!-- Skill Badges -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-white mb-4">🏅 Mahorat Nishonlari</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="reward-card earned p-6 text-center">
                    <div class="text-6xl mb-4">🧠</div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Xotira Chempioni</h4>
                    <p class="text-gray-600 mb-4">10 ta xotira o'yinini muvaffaqiyatli yakunladingiz!</p>
                    <div class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold">
                        ✅ Olingan
                    </div>
                    <div class="mt-4">
                        <div class="text-sm text-gray-600">Progress: 10/10</div>
                        <div class="bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <div class="reward-card p-6 text-center">
                    <div class="text-6xl mb-4 opacity-50">📚</div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Alifbo Ustasi</h4>
                    <p class="text-gray-600 mb-4">Barcha harflarni o'rganing va so'z tuzing!</p>
                    <div class="bg-gray-400 text-white px-4 py-2 rounded-full text-sm font-bold">
                        🔒 Yopiq
                    </div>
                    <div class="mt-4">
                        <div class="text-sm text-gray-600">Progress: 15/26</div>
                        <div class="bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 58%"></div>
                        </div>
                    </div>
                </div>

                <div class="reward-card p-6 text-center">
                    <div class="text-6xl mb-4 opacity-50">🔢</div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Matematik Daho</h4>
                    <p class="text-gray-600 mb-4">100 ta matematik masalani yeching!</p>
                    <div class="bg-gray-400 text-white px-4 py-2 rounded-full text-sm font-bold">
                        🔒 Yopiq
                    </div>
                    <div class="mt-4">
                        <div class="text-sm text-gray-600">Progress: 23/100</div>
                        <div class="bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 23%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Challenges -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-white mb-4">📅 Haftalik Vazifalar</h3>
            <div class="bg-white rounded-2xl p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-green-100 rounded-lg">
                        <div class="flex items-center">
                            <div class="text-2xl mr-3">✅</div>
                            <div>
                                <h5 class="font-bold">Har kuni 1 ta o'yin</h5>
                                <p class="text-sm text-gray-600">5/7 kun bajarildi</p>
                            </div>
                        </div>
                        <div class="text-2xl">🏆</div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-yellow-100 rounded-lg">
                        <div class="flex items-center">
                            <div class="text-2xl mr-3">⏳</div>
                            <div>
                                <h5 class="font-bold">3 ta yangi o'yin sinash</h5>
                                <p class="text-sm text-gray-600">2/3 bajarildi</p>
                            </div>
                        </div>
                        <div class="text-2xl">🎯</div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg">
                        <div class="flex items-center">
                            <div class="text-2xl mr-3">⭐</div>
                            <div>
                                <h5 class="font-bold">100 ball to'plash</h5>
                                <p class="text-sm text-gray-600">67/100 ball</p>
                            </div>
                        </div>
                        <div class="text-2xl">💎</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 9-12 Age Group Rewards -->
    <div id="age-9-12" class="age-section hidden">
        <h2 class="text-4xl font-bold text-white text-center mb-8">👦 Katta Guruh (9-12 yosh)</h2>

        <!-- Advanced Achievements -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-white mb-4">🏆 Yuqori Darajali Mukofotlar</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="reward-card earned p-6">
                    <div class="flex items-center mb-4">
                        <div class="text-5xl mr-4">🎓</div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800">Mantiq Ustasi</h4>
                            <p class="text-gray-600">Barcha mantiq o'yinlarini muvaffaqiyatli yakunladingiz</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold">
                            Olingan: 15.01.2025
                        </div>
                        <div class="text-2xl">🥇</div>
                    </div>
                    <div class="mt-4 p-3 bg-yellow-100 rounded-lg">
                        <p class="text-sm font-bold text-gray-700">🎁 Bonus: Maxsus mantiq o'yinlari ochildi!</p>
                    </div>
                </div>

                <div class="reward-card p-6">
                    <div class="flex items-center mb-4">
                        <div class="text-5xl mr-4 opacity-50">🏅</div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800">Strategiya Chempioni</h4>
                            <p class="text-gray-600">50 ta strategik o'yinni g'alaba bilan yakunlang</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="bg-gray-400 text-white px-4 py-2 rounded-full text-sm font-bold">
                            32/50 g'alaba
                        </div>
                        <div class="text-2xl opacity-50">🔒</div>
                    </div>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-500 h-3 rounded-full" style="width: 64%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">64% bajarildi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leaderboard -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-white mb-4">🏆 Reyting Jadvali</h3>
            <div class="bg-white rounded-2xl p-6">
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 bg-yellow-100 rounded-lg border-2 border-yellow-400">
                        <div class="flex items-center">
                            <div class="text-2xl mr-3">🥇</div>
                            <div>
                                <h5 class="font-bold">Siz (Ahmad)</h5>
                                <p class="text-sm text-gray-600">1,250 ball</p>
                            </div>
                        </div>
                        <div class="text-xl font-bold text-yellow-600">#1</div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg">
                        <div class="flex items-center">
                            <div class="text-2xl mr-3">🥈</div>
                            <div>
                                <h5 class="font-bold">Malika</h5>
                                <p class="text-sm text-gray-600">1,180 ball</p>
                            </div>
                        </div>
                        <div class="text-xl font-bold text-gray-600">#2</div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg">
                        <div class="flex items-center">
                            <div class="text-2xl mr-3">🥉</div>
                            <div>
                                <h5 class="font-bold">Bobur</h5>
                                <p class="text-sm text-gray-600">1,050 ball</p>
                            </div>
                        </div>
                        <div class="text-xl font-bold text-gray-600">#3</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Goals -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-white mb-4">🎯 Oylik Maqsadlar</h3>
            <div class="bg-white rounded-2xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-blue-100 rounded-lg">
                        <div class="text-3xl mb-2">🎮</div>
                        <h5 class="font-bold">30 ta o'yin</h5>
                        <p class="text-sm text-gray-600">18/30 bajarildi</p>
                        <div class="bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>

                    <div class="text-center p-4 bg-green-100 rounded-lg">
                        <div class="text-3xl mb-2">⭐</div>
                        <h5 class="font-bold">500 ball</h5>
                        <p class="text-sm text-gray-600">350/500 ball</p>
                        <div class="bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>

                    <div class="text-center p-4 bg-purple-100 rounded-lg">
                        <div class="text-3xl mb-2">🏅</div>
                        <h5 class="font-bold">5 ta mukofot</h5>
                        <p class="text-sm text-gray-600">3/5 olingan</p>
                        <div class="bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reward Shop -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white text-center mb-6">🛍️ Mukofotlar Do'koni</h2>
        <div class="bg-white rounded-2xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center p-4 border-2 border-dashed border-gray-300 rounded-lg">
                    <div class="text-4xl mb-2">🎨</div>
                    <h5 class="font-bold">Yangi Bo'yoq</h5>
                    <p class="text-sm text-gray-600 mb-2">50 ball</p>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm" onclick="buyReward('paint')">
                        Sotib olish
                    </button>
                </div>

                <div class="text-center p-4 border-2 border-dashed border-gray-300 rounded-lg">
                    <div class="text-4xl mb-2">🎵</div>
                    <h5 class="font-bold">Yangi Musiqa</h5>
                    <p class="text-sm text-gray-600 mb-2">75 ball</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm" onclick="buyReward('music')">
                        Sotib olish
                    </button>
                </div>

                <div class="text-center p-4 border-2 border-dashed border-gray-300 rounded-lg">
                    <div class="text-4xl mb-2">🏆</div>
                    <h5 class="font-bold">Maxsus Nishon</h5>
                    <p class="text-sm text-gray-600 mb-2">100 ball</p>
                    <button class="bg-purple-500 text-white px-4 py-2 rounded-lg text-sm" onclick="buyReward('badge')">
                        Sotib olish
                    </button>
                </div>

                <div class="text-center p-4 border-2 border-dashed border-gray-300 rounded-lg">
                    <div class="text-4xl mb-2">🎁</div>
                    <h5 class="font-bold">Sirli Sovg'a</h5>
                    <p class="text-sm text-gray-600 mb-2">150 ball</p>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm" onclick="buyReward('mystery')">
                        Sotib olish
                    </button>
                </div>
            </div>

            <div class="text-center mt-6">
                <p class="text-lg font-bold text-gray-700">💰 Sizning ballaringiz: <span id="userPoints">245</span></p>
            </div>
        </div>
    </div>
</main>

<!-- Achievement Popup -->
<div id="achievementPopup" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-8 max-w-md mx-4 text-center achievement-unlock">
        <div class="text-8xl mb-4">🎉</div>
        <h3 class="text-3xl font-bold text-gray-800 mb-4">Yangi Mukofot!</h3>
        <div id="newAchievement" class="text-6xl mb-4">🏆</div>
        <p id="achievementText" class="text-gray-600 mb-6 text-lg">Siz yangi mukofot oldingiz!</p>
        <button
            class="bg-gradient-to-r from-pink-500 to-purple-500 text-white py-3 px-8 rounded-full font-bold text-lg"
            onclick="closeAchievementPopup()"
        >
            Ajoyib! 🎊
        </button>
    </div>
</div>

<!-- Celebration Effect -->
<div id="celebration" class="celebration hidden"></div>

<script>
    let currentAge = '';
    let userPoints = 245;
    let achievements = {
        '3-5': ['first-draw', 'music-master'],
        '6-8': ['memory-champion'],
        '9-12': ['logic-master']
    };

    function selectAge(age) {
        currentAge = age;

        // Hide all age sections
        document.querySelectorAll('.age-section').forEach(section => {
            section.classList.add('hidden');
        });

        // Show selected age section
        document.getElementById(`age-${age}`).classList.remove('hidden');

        showNotification(`${age} yosh guruhi tanlandi! 🎯`, 'success');

        // Update age badges
        document.querySelectorAll('.age-badge').forEach(badge => {
            badge.classList.remove('bg-yellow-500');
            badge.classList.add('bg-purple-500');
        });

        event.target.classList.remove('bg-purple-500');
        event.target.classList.add('bg-yellow-500');
    }

    function buyReward(rewardType) {
        const costs = {
            paint: 50,
            music: 75,
            badge: 100,
            mystery: 150
        };

        const cost = costs[rewardType];

        if (userPoints >= cost) {
            userPoints -= cost;
            document.getElementById('userPoints').textContent = userPoints;

            const rewardNames = {
                paint: 'Yangi Bo\'yoq to\'plami',
                music: 'Yangi musiqa treklarini',
                badge: 'Maxsus nishonni',
                mystery: 'Sirli sovg\'ani'
            };

            showAchievement('🛍️', `${rewardNames[rewardType]} sotib oldingiz!`);
            createCelebration();
        } else {
            showNotification('Yetarli ballingiz yo\'q! Ko\'proq o\'yin o\'ynang! 💪', 'error');
        }
    }

    function showAchievement(icon, text) {
        document.getElementById('newAchievement').textContent = icon;
        document.getElementById('achievementText').textContent = text;
        document.getElementById('achievementPopup').classList.remove('hidden');
        document.getElementById('achievementPopup').classList.add('flex');
    }

    function closeAchievementPopup() {
        document.getElementById('achievementPopup').classList.add('hidden');
        document.getElementById('achievementPopup').classList.remove('flex');
    }

    function createCelebration() {
        const celebration = document.getElementById('celebration');
        celebration.classList.remove('hidden');

        // Create confetti
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.backgroundColor = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3'][Math.floor(Math.random() * 6)];
            confetti.style.animationDelay = Math.random() * 3 + 's';
            celebration.appendChild(confetti);
        }

        setTimeout(() => {
            celebration.classList.add('hidden');
            celebration.innerHTML = '';
        }, 3000);
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        let bgColor = 'bg-blue-500';

        if (type === 'success') bgColor = 'bg-green-500';
        if (type === 'error') bgColor = 'bg-red-500';
        if (type === 'info') bgColor = 'bg-purple-500';

        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-4 rounded-2xl shadow-lg z-50 transform transition-all duration-300 translate-x-full font-bold`;
        notification.textContent = message;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 4000);
    }

    // Auto-show first age group
    setTimeout(() => {
        selectAge('6-8');
    }, 1000);

    // Simulate earning points
    setInterval(() => {
        if (Math.random() < 0.3) { // 30% chance every 10 seconds
            userPoints += Math.floor(Math.random() * 20) + 5;
            document.getElementById('userPoints').textContent = userPoints;
            showNotification(`+${Math.floor(Math.random() * 20) + 5} ball oldiniz! 🎯`, 'success');
        }
    }, 10000);

    // Random achievement notifications
    setTimeout(() => {
        showNotification('Yangi haftalik vazifa mavjud! Tekshirib ko\'ring! 📅', 'info');
    }, 5000);
</script>
</body>
</html>
