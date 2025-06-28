<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foydalanuvchi Panel - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .admin-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .admin-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        .user-avatar {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: white;
            font-weight: bold;
        }

        .nav-item {
            transition: all 0.3s ease;
            border-radius: 8px;
            cursor: pointer;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #fff;
        }

        .role-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #10b981;
            color: white;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600">
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white/10 backdrop-blur-lg p-6">
        <div class="text-center mb-8">
            <a href="index.html" class="block">
                <h1 class="text-2xl font-bold text-white mb-2">Thinko.uz</h1>
            </a>
            <p class="text-white/80 text-sm">Foydalanuvchi Panel</p>
            <div class="mt-4">
                <div class="role-badge">Foydalanuvchi</div>
            </div>
        </div>

        <nav class="space-y-2">
            <div class="nav-item active p-3 text-white" onclick="showSection('dashboard')">
                <div class="flex items-center">
                    <span class="mr-3">📊</span>
                    <span>Dashboard</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('tasks')">
                <div class="flex items-center">
                    <span class="mr-3">📝</span>
                    <span>Topshiriqlarim</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('games')">
                <div class="flex items-center">
                    <span class="mr-3">🎮</span>
                    <span>O'yinlar</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('achievements')">
                <div class="flex items-center">
                    <span class="mr-3">🏅</span>
                    <span>Yutuqlarim</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('rewards')">
                <div class="flex items-center">
                    <span class="mr-3">🏆</span>
                    <span>Mukofotlar</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('profile')">
                <div class="flex items-center">
                    <span class="mr-3">👤</span>
                    <span>Profil</span>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-y-auto">
        <!-- Dashboard Section -->
        <div id="dashboard" class="section">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">Mening Dashboard</h2>
                    <p class="text-white/80">Salom! Bugun nima qilamiz?</p>
                </div>
                <div class="text-white text-right">
                    <div class="text-sm opacity-80">Bugun</div>
                    <div class="text-xl font-bold" id="currentDate"></div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">💰</div>
                    <div class="text-2xl font-bold">1,250</div>
                    <div class="text-sm opacity-90">Mening Coinlarim</div>
                </div>
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">✅</div>
                    <div class="text-2xl font-bold">45</div>
                    <div class="text-sm opacity-90">Bajarilgan Topshiriq</div>
                </div>
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">🏅</div>
                    <div class="text-2xl font-bold">8</div>
                    <div class="text-sm opacity-90">Badge</div>
                </div>
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">🔥</div>
                    <div class="text-2xl font-bold">7</div>
                    <div class="text-sm opacity-90">Kun Ketma-ketlik</div>
                </div>
            </div>

            <!-- Today's Tasks and Achievements -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Bugungi Topshiriqlar</h3>
                    <div class="space-y-3">
                        <div class="p-4 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold">Matematik Topshiriq</h4>
                                    <p class="text-sm text-gray-600">Qo'shish va ayirish</p>
                                    <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded mt-1 inline-block">
                                            Oson
                                        </span>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-green-600">+25</div>
                                    <div class="text-xs text-gray-500">coin</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold">Rasm Chizish</h4>
                                    <p class="text-sm text-gray-600">Tabiat manzarasini chizing</p>
                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded mt-1 inline-block">
                                            O'rta
                                        </span>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-green-600">+30</div>
                                    <div class="text-xs text-gray-500">coin</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">So'nggi Yutuqlar</h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="text-2xl mr-3">🏆</div>
                                <div>
                                    <h4 class="font-semibold text-yellow-800">Matematik Usta</h4>
                                    <p class="text-sm text-yellow-600">50 ta matematik topshiriq bajarildi</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="text-2xl mr-3">🏆</div>
                                <div>
                                    <h4 class="font-semibold text-yellow-800">Ijodkor</h4>
                                    <p class="text-sm text-yellow-600">20 ta rasm chizildi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks Section -->
        <div id="tasks" class="section hidden">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-white">Topshiriqlarim</h2>
                <div class="flex gap-2">
                    <select class="bg-white px-4 py-2 rounded-lg">
                        <option>Barcha kategoriyalar</option>
                        <option>Matematik</option>
                        <option>Ijodiy</option>
                        <option>Jismoniy</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="admin-card p-6 hover:shadow-xl transition-all cursor-pointer">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-2xl">🧮</span>
                        </div>
                        <h3 class="text-lg font-bold">Matematik Topshiriq</h3>
                        <p class="text-sm text-gray-600">Qo'shish va ayirish</p>
                    </div>

                    <div class="space-y-2 text-sm mb-4">
                        <div class="flex justify-between">
                            <span>Mukofot:</span>
                            <span class="font-semibold text-green-600">+25 coin</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Qiyinlik:</span>
                            <span class="font-semibold">Oson</span>
                        </div>
                    </div>

                    <button class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 rounded-lg hover:from-blue-600 hover:to-purple-700 transition-colors">
                        Boshlash
                    </button>
                </div>

                <div class="admin-card p-6 hover:shadow-xl transition-all cursor-pointer">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-2xl">🎨</span>
                        </div>
                        <h3 class="text-lg font-bold">Rasm Chizish</h3>
                        <p class="text-sm text-gray-600">Tabiat manzarasini chizing</p>
                    </div>

                    <div class="space-y-2 text-sm mb-4">
                        <div class="flex justify-between">
                            <span>Mukofot:</span>
                            <span class="font-semibold text-green-600">+30 coin</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Qiyinlik:</span>
                            <span class="font-semibold">O'rta</span>
                        </div>
                    </div>

                    <button class="w-full bg-gradient-to-r from-green-500 to-blue-600 text-white py-2 rounded-lg hover:from-green-600 hover:to-blue-700 transition-colors">
                        Boshlash
                    </button>
                </div>

                <div class="admin-card p-6 hover:shadow-xl transition-all cursor-pointer">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-2xl">🏃</span>
                        </div>
                        <h3 class="text-lg font-bold">Jismoniy Mashq</h3>
                        <p class="text-sm text-gray-600">10 daqiqa yugurish</p>
                    </div>

                    <div class="space-y-2 text-sm mb-4">
                        <div class="flex justify-between">
                            <span>Mukofot:</span>
                            <span class="font-semibold text-green-600">+20 coin</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Qiyinlik:</span>
                            <span class="font-semibold">Oson</span>
                        </div>
                    </div>

                    <button class="w-full bg-gradient-to-r from-orange-500 to-red-600 text-white py-2 rounded-lg hover:from-orange-600 hover:to-red-700 transition-colors">
                        Boshlash
                    </button>
                </div>
            </div>
        </div>

        <!-- games Section -->
        <div id="games" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">O'yinlar</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="admin-card p-6 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-2xl">🧩</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Puzzle O'yini</h3>
                    <p class="text-sm text-gray-600 mb-4">Mantiqiy o'yin</p>
                    <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        O'ynash
                    </button>
                </div>

                <div class="admin-card p-6 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-2xl">🎨</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Rang Berish</h3>
                    <p class="text-sm text-gray-600 mb-4">Ijodiy o'yin</p>
                    <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                        O'ynash
                    </button>
                </div>
            </div>
        </div>

        <!-- Achievements Section -->
        <div id="achievements" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Yutuqlarim</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="admin-card p-6 border-2 border-yellow-400">
                    <div class="text-center">
                        <div class="text-4xl mb-3">🏆</div>
                        <h3 class="text-lg font-bold mb-2">Matematik Usta</h3>
                        <p class="text-sm text-gray-600">50 ta matematik topshiriq bajarildi</p>
                        <div class="mt-3 bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
                            Qo'lga kiritildi!
                        </div>
                    </div>
                </div>

                <div class="admin-card p-6 border-2 border-yellow-400">
                    <div class="text-center">
                        <div class="text-4xl mb-3">🏆</div>
                        <h3 class="text-lg font-bold mb-2">Ijodkor</h3>
                        <p class="text-sm text-gray-600">20 ta rasm chizildi</p>
                        <div class="mt-3 bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
                            Qo'lga kiritildi!
                        </div>
                    </div>
                </div>

                <div class="admin-card p-6 opacity-60">
                    <div class="text-center">
                        <div class="text-4xl mb-3 grayscale">🏆</div>
                        <h3 class="text-lg font-bold mb-2">Sport Chempioni</h3>
                        <p class="text-sm text-gray-600">100 ta jismoniy mashq bajarildi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rewards Section -->
        <div id="rewards" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Mukofotlar Do'koni</h2>
            <div class="admin-card p-6">
                <p class="text-center text-gray-600">Mukofotlar do'koni tez orada...</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div id="profile" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Mening Profilim</h2>
            <div class="admin-card p-6">
                <div class="text-center mb-6">
                    <div class="user-avatar mx-auto mb-4">A</div>
                    <h3 class="text-2xl font-bold">Ahmad Karimov</h3>
                    <p class="text-gray-600">8 yosh</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600">1,250</div>
                        <div class="text-sm text-gray-600">Coin</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="text-2xl font-bold text-green-600">8</div>
                        <div class="text-sm text-gray-600">Badge</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('uz-UZ');
    });

    // Navigation
    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.section').forEach(section => {
            section.classList.add('hidden');
        });

        // Show selected section
        document.getElementById(sectionId).classList.remove('hidden');

        // Update navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.remove('active');
        });
        event.target.closest('.nav-item').classList.add('active');
    }
</script>
</body>
</html>
