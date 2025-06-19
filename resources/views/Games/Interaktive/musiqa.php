<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musiqa O'yini - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .music-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .music-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .instrument-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            transition: all 0.3s ease;
            border-radius: 15px;
            border: none;
            color: white;
            font-weight: 600;
        }

        .instrument-btn:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
        }

        .instrument-btn.active {
            background: linear-gradient(135deg, #10b981, #059669);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .piano-key {
            width: 60px;
            height: 200px;
            border: 2px solid #333;
            border-radius: 0 0 8px 8px;
            transition: all 0.1s ease;
            cursor: pointer;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 10px;
            font-weight: bold;
            user-select: none;
        }

        .piano-key.white {
            background: linear-gradient(to bottom, #ffffff, #f0f0f0);
            color: #333;
        }

        .piano-key.black {
            background: linear-gradient(to bottom, #333, #000);
            color: white;
            width: 40px;
            height: 120px;
            margin: 0 -20px;
            z-index: 2;
            position: relative;
        }

        .piano-key:active, .piano-key.pressed {
            transform: translateY(3px);
            box-shadow: inset 0 3px 10px rgba(0,0,0,0.3);
        }

        .piano-key.white:active, .piano-key.white.pressed {
            background: linear-gradient(to bottom, #e0e0e0, #d0d0d0);
        }

        .piano-key.black:active, .piano-key.black.pressed {
            background: linear-gradient(to bottom, #222, #111);
        }

        .drum-pad {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #333;
            cursor: pointer;
            transition: all 0.1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            user-select: none;
        }

        .drum-pad:active, .drum-pad.hit {
            transform: scale(0.95);
            box-shadow: inset 0 5px 15px rgba(0,0,0,0.3);
        }

        .drum-kick {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .drum-snare {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .drum-hihat {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
        }

        .drum-crash {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }

        .xylophone-bar {
            width: 80px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            user-select: none;
            margin: 5px;
        }

        .xylophone-bar:active, .xylophone-bar.struck {
            transform: translateY(3px);
            box-shadow: inset 0 3px 10px rgba(0,0,0,0.3);
        }

        .guitar-string {
            width: 100%;
            height: 8px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.1s ease;
            margin: 10px 0;
            position: relative;
            user-select: none;
        }

        .guitar-string:active, .guitar-string.plucked {
            animation: stringVibrate 0.5s ease-out;
        }

        @keyframes stringVibrate {
            0%, 100% { transform: scaleY(1); }
            25% { transform: scaleY(1.5); }
            75% { transform: scaleY(0.5); }
        }

        .control-btn {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .control-btn:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            transform: translateY(-2px);
        }

        .control-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .volume-slider {
            width: 100%;
            height: 8px;
            border-radius: 4px;
            background: #e5e7eb;
            outline: none;
            cursor: pointer;
        }

        .volume-slider::-webkit-slider-thumb {
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #f59e0b;
            cursor: pointer;
        }

        .recording-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #ef4444;
            animation: recordingPulse 1s infinite;
        }

        @keyframes recordingPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .note-animation {
            position: absolute;
            font-size: 24px;
            color: #f59e0b;
            pointer-events: none;
            animation: noteFloat 1s ease-out forwards;
        }

        @keyframes noteFloat {
            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(-50px) scale(1.5);
            }
        }

        .melody-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            margin: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .melody-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-1px);
        }

        .achievement-badge {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin: 4px;
        }

        .star-rating {
            color: #fbbf24;
            font-size: 24px;
        }
    </style>
</head>
<body>
<!-- Header -->
<header class="bg-white bg-opacity-10 backdrop-blur-lg shadow-lg">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <button onclick="goBack()" class="text-white hover:text-gray-200 mr-4">
                    <i class="fas fa-arrow-left text-xl"></i>
                </button>
                <h1 class="text-2xl font-bold text-white">🎵 Musiqa O'yini</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Yulduzlar</div>
                    <div class="text-xl font-bold" id="starCount">0</div>
                </div>
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Melodiyalar</div>
                    <div class="text-xl font-bold" id="melodyCount">0</div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8">

    <!-- Instrument Selection -->
    <div class="music-card p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">🎼 Asbobni Tanlang</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <button class="instrument-btn p-4 text-center active" onclick="selectInstrument('piano')" id="piano-btn">
                <div class="text-3xl mb-2">🎹</div>
                <div class="text-sm">Piano</div>
            </button>
            <button class="instrument-btn p-4 text-center" onclick="selectInstrument('drums')" id="drums-btn">
                <div class="text-3xl mb-2">🥁</div>
                <div class="text-sm">Baraban</div>
            </button>
            <button class="instrument-btn p-4 text-center" onclick="selectInstrument('guitar')" id="guitar-btn">
                <div class="text-3xl mb-2">🎸</div>
                <div class="text-sm">Gitara</div>
            </button>
            <button class="instrument-btn p-4 text-center" onclick="selectInstrument('xylophone')" id="xylophone-btn">
                <div class="text-3xl mb-2">🎵</div>
                <div class="text-sm">Ksilofon</div>
            </button>
            <button class="instrument-btn p-4 text-center" onclick="selectInstrument('flute')" id="flute-btn">
                <div class="text-3xl mb-2">🪈</div>
                <div class="text-sm">Nay</div>
            </button>
            <button class="instrument-btn p-4 text-center" onclick="selectInstrument('trumpet')" id="trumpet-btn">
                <div class="text-3xl mb-2">🎺</div>
                <div class="text-sm">Truba</div>
            </button>
        </div>
    </div>

    <!-- Control Panel -->
    <div class="music-card p-6 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <button class="control-btn" onclick="startRecording()" id="recordBtn">
                    <i class="fas fa-record-vinyl mr-2"></i>Yozib Olish
                </button>
                <button class="control-btn" onclick="playRecording()" id="playBtn" disabled>
                    <i class="fas fa-play mr-2"></i>Eshitish
                </button>
                <button class="control-btn" onclick="clearRecording()" id="clearBtn">
                    <i class="fas fa-trash mr-2"></i>Tozalash
                </button>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-volume-up text-white"></i>
                    <input type="range" min="0" max="100" value="70" class="volume-slider" id="volumeSlider">
                </div>
                <div id="recordingIndicator" class="recording-indicator hidden"></div>
            </div>
        </div>
    </div>

    <!-- Instrument Interface -->
    <div class="music-card p-8 mb-6">
        <div id="instrumentInterface">
            <!-- Piano Interface (Default) -->
            <div id="pianoInterface" class="text-center">
                <h3 class="text-xl font-bold text-gray-800 mb-6">🎹 Piano</h3>
                <div class="flex justify-center items-end mb-4" id="pianoKeys">
                    <!-- Piano keys will be generated by JavaScript -->
                </div>
                <div class="text-sm text-gray-600 mt-4">
                    Klavishlarga bosing yoki 1-8 raqamlarini ishlating
                </div>
            </div>

            <!-- Drums Interface -->
            <div id="drumsInterface" class="text-center hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-6">🥁 Baraban</h3>
                <div class="grid grid-cols-2 gap-8 max-w-md mx-auto">
                    <div class="drum-pad drum-kick" data-drum="kick" onclick="playDrum('kick')">
                        <div>KICK</div>
                    </div>
                    <div class="drum-pad drum-snare" data-drum="snare" onclick="playDrum('snare')">
                        <div>SNARE</div>
                    </div>
                    <div class="drum-pad drum-hihat" data-drum="hihat" onclick="playDrum('hihat')">
                        <div>HI-HAT</div>
                    </div>
                    <div class="drum-pad drum-crash" data-drum="crash" onclick="playDrum('crash')">
                        <div>CRASH</div>
                    </div>
                </div>
                <div class="text-sm text-gray-600 mt-4">
                    Baraban padlariga bosing yoki Q, W, E, R tugmalarini ishlating
                </div>
            </div>

            <!-- Guitar Interface -->
            <div id="guitarInterface" class="text-center hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-6">🎸 Gitara</h3>
                <div class="max-w-md mx-auto">
                    <div class="guitar-string bg-red-400" data-string="0" onclick="playGuitar(0)"></div>
                    <div class="guitar-string bg-orange-400" data-string="1" onclick="playGuitar(1)"></div>
                    <div class="guitar-string bg-yellow-400" data-string="2" onclick="playGuitar(2)"></div>
                    <div class="guitar-string bg-green-400" data-string="3" onclick="playGuitar(3)"></div>
                    <div class="guitar-string bg-blue-400" data-string="4" onclick="playGuitar(4)"></div>
                    <div class="guitar-string bg-purple-400" data-string="5" onclick="playGuitar(5)"></div>
                </div>
                <div class="text-sm text-gray-600 mt-4">
                    Torlarga bosing yoki A, S, D, F, G, H tugmalarini ishlating
                </div>
            </div>

            <!-- Xylophone Interface -->
            <div id="xylophoneInterface" class="text-center hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-6">🎵 Ksilofon</h3>
                <div class="flex justify-center flex-wrap" id="xylophoneBars">
                    <!-- Xylophone bars will be generated by JavaScript -->
                </div>
                <div class="text-sm text-gray-600 mt-4">
                    Rangli plashinkalarga bosing
                </div>
            </div>

            <!-- Flute Interface -->
            <div id="fluteInterface" class="text-center hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-6">🪈 Nay</h3>
                <div class="flex justify-center gap-2" id="fluteHoles">
                    <!-- Flute holes will be generated by JavaScript -->
                </div>
                <div class="text-sm text-gray-600 mt-4">
                    Teshiklarga bosing yoki raqam tugmalarini ishlating
                </div>
            </div>

            <!-- Trumpet Interface -->
            <div id="trumpetInterface" class="text-center hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-6">🎺 Truba</h3>
                <div class="flex justify-center gap-4" id="trumpetValves">
                    <!-- Trumpet valves will be generated by JavaScript -->
                </div>
                <div class="text-sm text-gray-600 mt-4">
                    Klapanlarga bosing
                </div>
            </div>
        </div>
    </div>

    <!-- Pre-made Melodies -->
    <div class="music-card p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 text-center mb-4">🎼 Taniqli Melodiyalar</h3>
        <div class="flex flex-wrap justify-center gap-2">
            <button class="melody-btn" onclick="playMelody('twinkle')">Yulduzcha</button>
            <button class="melody-btn" onclick="playMelody('happy')">Xursand Tug'ilgan Kun</button>
            <button class="melody-btn" onclick="playMelody('mary')">Mary Had a Little Lamb</button>
            <button class="melody-btn" onclick="playMelody('ode')">Ode to Joy</button>
            <button class="melody-btn" onclick="playMelody('scale')">Do Re Mi</button>
        </div>
    </div>

    <!-- Achievements -->
    <div class="music-card p-6">
        <h3 class="text-xl font-bold text-gray-800 text-center mb-4">🏆 Yutuqlar</h3>
        <div class="text-center" id="achievements">
            <div class="achievement-badge">🎹 Piano Boshlovchi</div>
            <div class="achievement-badge">🥁 Ritm Ustasi</div>
            <div class="achievement-badge">🎵 Melodiya Yaratuvchi</div>
        </div>
        <div class="text-center mt-4">
            <div class="star-rating" id="starRating">
                ⭐⭐⭐⭐⭐
            </div>
            <div class="text-gray-600 mt-2">Musiqa Darajangiz</div>
        </div>
    </div>
</div>

<!-- Note Animation Container -->
<div id="noteAnimations" class="fixed inset-0 pointer-events-none z-50"></div>

<script>
    // Game State
    let currentInstrument = 'piano';
    let isRecording = false;
    let recordedNotes = [];
    let audioContext = null;
    let masterVolume = 0.7;
    let starCount = 0;
    let melodyCount = 0;
    let achievements = new Set();

    // Note frequencies (Hz)
    const noteFrequencies = {
        'C': 261.63,
        'C#': 277.18,
        'D': 293.66,
        'D#': 311.13,
        'E': 329.63,
        'F': 349.23,
        'F#': 369.99,
        'G': 392.00,
        'G#': 415.30,
        'A': 440.00,
        'A#': 466.16,
        'B': 493.88
    };

    // Drum sounds (using different frequencies and noise)
    const drumSounds = {
        kick: { freq: 60, type: 'sine', duration: 0.5 },
        snare: { freq: 200, type: 'sawtooth', duration: 0.2 },
        hihat: { freq: 8000, type: 'square', duration: 0.1 },
        crash: { freq: 4000, type: 'sawtooth', duration: 1.0 }
    };

    // Pre-made melodies
    const melodies = {
        twinkle: [
            { note: 'C', duration: 0.5 },
            { note: 'C', duration: 0.5 },
            { note: 'G', duration: 0.5 },
            { note: 'G', duration: 0.5 },
            { note: 'A', duration: 0.5 },
            { note: 'A', duration: 0.5 },
            { note: 'G', duration: 1.0 }
        ],
        happy: [
            { note: 'C', duration: 0.25 },
            { note: 'C', duration: 0.25 },
            { note: 'D', duration: 0.5 },
            { note: 'C', duration: 0.5 },
            { note: 'F', duration: 0.5 },
            { note: 'E', duration: 1.0 }
        ],
        mary: [
            { note: 'E', duration: 0.5 },
            { note: 'D', duration: 0.5 },
            { note: 'C', duration: 0.5 },
            { note: 'D', duration: 0.5 },
            { note: 'E', duration: 0.5 },
            { note: 'E', duration: 0.5 },
            { note: 'E', duration: 1.0 }
        ],
        ode: [
            { note: 'E', duration: 0.5 },
            { note: 'E', duration: 0.5 },
            { note: 'F', duration: 0.5 },
            { note: 'G', duration: 0.5 },
            { note: 'G', duration: 0.5 },
            { note: 'F', duration: 0.5 },
            { note: 'E', duration: 0.5 },
            { note: 'D', duration: 0.5 }
        ],
        scale: [
            { note: 'C', duration: 0.5 },
            { note: 'D', duration: 0.5 },
            { note: 'E', duration: 0.5 },
            { note: 'F', duration: 0.5 },
            { note: 'G', duration: 0.5 },
            { note: 'A', duration: 0.5 },
            { note: 'B', duration: 0.5 },
            { note: 'C', duration: 1.0 }
        ]
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        initializeAudio();
        setupInstruments();
        setupEventListeners();
        updateUI();
    });

    // Initialize Audio Context
    function initializeAudio() {
        try {
            audioContext = new (window.AudioContext || window.webkitAudioContext)();
        } catch (error) {
            console.error('Audio context not supported:', error);
            alert('Bu brauzer audio qo\'llab-quvvatlamaydi');
        }
    }

    // Setup Instruments
    function setupInstruments() {
        setupPiano();
        setupXylophone();
        setupFlute();
        setupTrumpet();
    }

    function setupPiano() {
        const pianoKeys = document.getElementById('pianoKeys');
        const notes = ['C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B'];

        notes.forEach((note, index) => {
            const key = document.createElement('div');
            key.className = `piano-key ${note.includes('#') ? 'black' : 'white'}`;
            key.dataset.note = note;
            key.textContent = note;
            key.onclick = () => playPiano(note);
            pianoKeys.appendChild(key);
        });
    }

    function setupXylophone() {
        const xylophoneBars = document.getElementById('xylophoneBars');
        const colors = ['bg-red-400', 'bg-orange-400', 'bg-yellow-400', 'bg-green-400', 'bg-blue-400', 'bg-indigo-400', 'bg-purple-400', 'bg-pink-400'];
        const notes = ['C', 'D', 'E', 'F', 'G', 'A', 'B', 'C'];

        notes.forEach((note, index) => {
            const bar = document.createElement('div');
            bar.className = `xylophone-bar ${colors[index]}`;
            bar.dataset.note = note;
            bar.textContent = note;
            bar.onclick = () => playXylophone(note, index);
            xylophoneBars.appendChild(bar);
        });
    }

    function setupFlute() {
        const fluteHoles = document.getElementById('fluteHoles');
        const notes = ['C', 'D', 'E', 'F', 'G', 'A', 'B', 'C'];

        notes.forEach((note, index) => {
            const hole = document.createElement('div');
            hole.className = 'w-12 h-12 bg-amber-600 rounded-full cursor-pointer transition-all duration-100 flex items-center justify-center text-white font-bold';
            hole.dataset.note = note;
            hole.textContent = index + 1;
            hole.onclick = () => playFlute(note, index);
            fluteHoles.appendChild(hole);
        });
    }

    function setupTrumpet() {
        const trumpetValves = document.getElementById('trumpetValves');
        const notes = ['C', 'E', 'G', 'C'];

        notes.forEach((note, index) => {
            const valve = document.createElement('div');
            valve.className = 'w-16 h-16 bg-yellow-500 rounded-full cursor-pointer transition-all duration-100 flex items-center justify-center text-white font-bold';
            valve.dataset.note = note;
            valve.textContent = index + 1;
            valve.onclick = () => playTrumpet(note, index);
            trumpetValves.appendChild(valve);
        });
    }

    // Event Listeners
    function setupEventListeners() {
        // Volume control
        document.getElementById('volumeSlider').addEventListener('input', function(e) {
            masterVolume = e.target.value / 100;
        });

        // Keyboard support
        document.addEventListener('keydown', handleKeyPress);
        document.addEventListener('keyup', handleKeyRelease);
    }

    function handleKeyPress(e) {
        if (e.repeat) return;

        const key = e.key.toLowerCase();

        switch (currentInstrument) {
            case 'piano':
                const pianoKeys = ['1', '2', '3', '4', '5', '6', '7', '8'];
                const notes = ['C', 'D', 'E', 'F', 'G', 'A', 'B', 'C'];
                const index = pianoKeys.indexOf(key);
                if (index !== -1) {
                    playPiano(notes[index]);
                    document.querySelector(`[data-note="${notes[index]}"]`).classList.add('pressed');
                }
                break;

            case 'drums':
                const drumKeys = { 'q': 'kick', 'w': 'snare', 'e': 'hihat', 'r': 'crash' };
                if (drumKeys[key]) {
                    playDrum(drumKeys[key]);
                    document.querySelector(`[data-drum="${drumKeys[key]}"]`).classList.add('hit');
                }
                break;

            case 'guitar':
                const guitarKeys = ['a', 's', 'd', 'f', 'g', 'h'];
                const stringIndex = guitarKeys.indexOf(key);
                if (stringIndex !== -1) {
                    playGuitar(stringIndex);
                    document.querySelector(`[data-string="${stringIndex}"]`).classList.add('plucked');
                }
                break;
        }
    }

    function handleKeyRelease(e) {
        const key = e.key.toLowerCase();

        // Remove visual feedback
        document.querySelectorAll('.pressed, .hit, .plucked').forEach(el => {
            el.classList.remove('pressed', 'hit', 'plucked');
        });
    }

    // Instrument Selection
    function selectInstrument(instrument) {
        currentInstrument = instrument;

        // Update button states
        document.querySelectorAll('.instrument-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.getElementById(instrument + '-btn').classList.add('active');

        // Show/hide interfaces
        document.querySelectorAll('[id$="Interface"]').forEach(interface => {
            interface.classList.add('hidden');
        });
        document.getElementById(instrument + 'Interface').classList.remove('hidden');
    }

    // Sound Generation
    function playSound(frequency, duration = 0.3, type = 'sine', instrument = 'default') {
        if (!audioContext) return;

        try {
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);

            oscillator.frequency.setValueAtTime(frequency, audioContext.currentTime);
            oscillator.type = type;

            // Envelope
            gainNode.gain.setValueAtTime(0, audioContext.currentTime);
            gainNode.gain.linearRampToValueAtTime(masterVolume * 0.3, audioContext.currentTime + 0.01);
            gainNode.gain.exponentialRampToValueAtTime(0.001, audioContext.currentTime + duration);

            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + duration);

            // Record note if recording
            if (isRecording) {
                recordedNotes.push({
                    frequency: frequency,
                    duration: duration,
                    type: type,
                    instrument: instrument,
                    time: Date.now()
                });
            }

        } catch (error) {
            console.error('Error playing sound:', error);
        }
    }

    // Instrument Players
    function playPiano(note) {
        const frequency = noteFrequencies[note];
        playSound(frequency, 0.5, 'sine', 'piano');
        showNoteAnimation('🎵');
        addStar();
    }

    function playDrum(drumType) {
        const drum = drumSounds[drumType];
        playSound(drum.freq, drum.duration, drum.type, 'drums');
        showNoteAnimation('🥁');
        addStar();
    }

    function playGuitar(stringIndex) {
        const baseFreq = 82.41; // Low E
        const frequencies = [82.41, 110, 146.83, 196, 246.94, 329.63];
        playSound(frequencies[stringIndex], 1.0, 'sawtooth', 'guitar');
        showNoteAnimation('🎸');
        addStar();
    }

    function playXylophone(note, index) {
        const frequency = noteFrequencies[note] * (index > 6 ? 2 : 1);
        playSound(frequency, 0.8, 'square', 'xylophone');
        showNoteAnimation('🎵');
        addStar();
    }

    function playFlute(note, index) {
        const frequency = noteFrequencies[note] * 2;
        playSound(frequency, 0.6, 'sine', 'flute');
        showNoteAnimation('🪈');
        addStar();
    }

    function playTrumpet(note, index) {
        const frequency = noteFrequencies[note] * 2;
        playSound(frequency, 0.8, 'sawtooth', 'trumpet');
        showNoteAnimation('🎺');
        addStar();
    }

    // Recording Functions
    function startRecording() {
        if (isRecording) {
            stopRecording();
        } else {
            isRecording = true;
            recordedNotes = [];
            document.getElementById('recordBtn').innerHTML = '<i class="fas fa-stop mr-2"></i>To\'xtatish';
            document.getElementById('recordingIndicator').classList.remove('hidden');
        }
    }

    function stopRecording() {
        isRecording = false;
        document.getElementById('recordBtn').innerHTML = '<i class="fas fa-record-vinyl mr-2"></i>Yozib Olish';
        document.getElementById('recordingIndicator').classList.add('hidden');
        document.getElementById('playBtn').disabled = recordedNotes.length === 0;

        if (recordedNotes.length > 0) {
            addMelody();
            checkAchievements();
        }
    }

    function playRecording() {
        if (recordedNotes.length === 0) return;

        const startTime = recordedNotes[0].time;
        recordedNotes.forEach(note => {
            const delay = (note.time - startTime) / 1000;
            setTimeout(() => {
                playSound(note.frequency, note.duration, note.type, note.instrument);
            }, delay * 1000);
        });
    }

    function clearRecording() {
        recordedNotes = [];
        document.getElementById('playBtn').disabled = true;
        showNoteAnimation('🗑️');
    }

    // Melody Player
    function playMelody(melodyName) {
        const melody = melodies[melodyName];
        if (!melody) return;

        let delay = 0;
        melody.forEach(note => {
            setTimeout(() => {
                const frequency = noteFrequencies[note.note];
                playSound(frequency, note.duration, 'sine', 'melody');
                showNoteAnimation('🎼');
            }, delay * 1000);
            delay += note.duration;
        });

        addMelody();
        checkAchievements();
    }

    // Visual Effects
    function showNoteAnimation(emoji) {
        const container = document.getElementById('noteAnimations');
        const animation = document.createElement('div');
        animation.className = 'note-animation';
        animation.textContent = emoji;
        animation.style.left = Math.random() * window.innerWidth + 'px';
        animation.style.top = Math.random() * window.innerHeight + 'px';

        container.appendChild(animation);

        setTimeout(() => {
            container.removeChild(animation);
        }, 1000);
    }

    // Game Progress
    function addStar() {
        starCount++;
        updateUI();
    }

    function addMelody() {
        melodyCount++;
        updateUI();
    }

    function updateUI() {
        document.getElementById('starCount').textContent = starCount;
        document.getElementById('melodyCount').textContent = melodyCount;
        updateStarRating();
    }

    function updateStarRating() {
        const rating = Math.min(5, Math.floor(starCount / 10) + 1);
        const stars = '⭐'.repeat(rating) + '☆'.repeat(5 - rating);
        document.getElementById('starRating').textContent = stars;
    }

    // Achievements
    function checkAchievements() {
        if (starCount >= 10 && !achievements.has('piano_beginner')) {
            achievements.add('piano_beginner');
            showAchievement('🎹 Piano Boshlovchi');
        }

        if (melodyCount >= 5 && !achievements.has('melody_creator')) {
            achievements.add('melody_creator');
            showAchievement('🎵 Melodiya Yaratuvchi');
        }

        if (starCount >= 50 && !achievements.has('music_master')) {
            achievements.add('music_master');
            showAchievement('🎼 Musiqa Ustasi');
        }
    }

    function showAchievement(text) {
        const achievement = document.createElement('div');
        achievement.className = 'achievement-badge';
        achievement.textContent = text;
        achievement.style.position = 'fixed';
        achievement.style.top = '50%';
        achievement.style.left = '50%';
        achievement.style.transform = 'translate(-50%, -50%)';
        achievement.style.zIndex = '1000';
        achievement.style.animation = 'noteFloat 2s ease-out forwards';

        document.body.appendChild(achievement);

        setTimeout(() => {
            document.body.removeChild(achievement);
        }, 2000);
    }

    // Navigation
    function goBack() {
        if (confirm('O\'yinni tark etishni xohlaysizmi?')) {
            window.history.back();
        }
    }

    // Resume audio context on user interaction
    document.addEventListener('click', function() {
        if (audioContext && audioContext.state === 'suspended') {
            audioContext.resume();
        }
    });
</script>
</body>
</html>
