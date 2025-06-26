<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VideoTube - Modern Video Gallery</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0f0f0f;
            color: #fff;
            line-height: 1.6;
        }

        /* Header Styles */
        .header {
            background: rgba(15, 15, 15, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #333;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 12px 0;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: #ff4444;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
            color: #ff6666;
        }

        .logo i {
            margin-right: 8px;
            font-size: 28px;
        }

        .search-container {
            flex: 1;
            max-width: 600px;
            margin: 0 40px;
            position: relative;
        }

        .search-box {
            width: 100%;
            padding: 12px 50px 12px 20px;
            border: 2px solid #333;
            border-radius: 25px;
            background: #222;
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-box:focus {
            outline: none;
            border-color: #ff4444;
            box-shadow: 0 0 20px rgba(255, 68, 68, 0.3);
        }

        .search-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .search-btn:hover {
            color: #ff4444;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-btn {
            padding: 10px 20px;
            border: 2px solid #ff4444;
            border-radius: 25px;
            background: transparent;
            color: #ff4444;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-btn:hover {
            background: #ff4444;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 68, 68, 0.4);
        }

        .nav-btn.primary {
            background: linear-gradient(135deg, #ff4444, #ff6b6b);
            border-color: transparent;
            color: #fff;
        }

        .nav-btn.primary:hover {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 68, 68, 0.5);
        }

        .user-menu {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff4444, #ff6b6b);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(255, 68, 68, 0.5);
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 40px 20px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #333;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #ff4444, #ff6b6b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Video Grid */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .video-card {
            background: linear-gradient(145deg, #1a1a1a, #2a2a2a);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(255, 68, 68, 0.2);
        }

        .video-thumbnail {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius: 15px 15px 0 0;
        }

        .video-iframe {
            width: 100%;
            height: 100%;
            border: none;
            transition: transform 0.3s ease;
        }

        .video-card:hover .video-iframe {
            transform: scale(1.05);
        }

        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 68, 68, 0.9);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            opacity: 0;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .video-card:hover .play-overlay {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .video-info {
            padding: 20px;
        }

        .video-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #fff;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .video-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #333;
        }

        .video-stats {
            display: flex;
            gap: 15px;
            color: #999;
            font-size: 14px;
        }

        .video-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            padding: 8px 12px;
            border: 1px solid #444;
            border-radius: 15px;
            background: transparent;
            color: #999;
            text-decoration: none;
            font-size: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .action-btn:hover {
            background: #ff4444;
            color: #fff;
            border-color: #ff4444;
            transform: translateY(-2px);
        }

        .action-btn.edit {
            border-color: #ffa500;
            color: #ffa500;
        }

        .action-btn.edit:hover {
            background: #ffa500;
            color: #fff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                padding: 0 15px;
            }

            .search-container {
                display: none;
            }

            .video-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .page-header {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }

            .nav-actions {
                gap: 10px;
            }

            .nav-btn {
                padding: 8px 15px;
                font-size: 14px;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #444;
            border-radius: 50%;
            border-top-color: #ff4444;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: #ff4444;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ff6b6b;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fab fa-youtube"></i>
                VideoTube
            </a>
            
            <div class="search-container">
                <input type="text" class="search-box" placeholder="Search videos...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <div class="nav-actions">
                <a href="#" class="nav-btn primary">
                    <i class="fas fa-plus"></i>
                    Add Video
                </a>
                <a href="#" class="nav-btn">
                    <i class="fas fa-user"></i>
                    Login
                </a>
                <div class="user-menu">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title">Trending Videos</h1>
            <div class="header-actions">
                <a href="#" class="nav-btn primary">
                    <i class="fas fa-upload"></i>
                    Upload Video
                </a>
            </div>
        </div>

        <!-- Video Grid -->
        <div class="video-grid">
            <!-- Sample Video Card 1 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        class="video-iframe"
                        src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                        allowfullscreen>
                    </iframe>
                    <div class="play-overlay">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="video-info">
                    <h3 class="video-title">Amazing Video Tutorial - Learn Something New Today</h3>
                    <div class="video-meta">
                        <div class="video-stats">
                            <span><i class="fas fa-eye"></i> 1.2M views</span>
                            <span><i class="fas fa-calendar"></i> 2 days ago</span>
                        </div>
                        <div class="video-actions">
                            <a href="#" class="action-btn edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sample Video Card 2 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        class="video-iframe"
                        src="https://www.youtube.com/embed/jNQXAC9IVRw" 
                        allowfullscreen>
                    </iframe>
                    <div class="play-overlay">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="video-info">
                    <h3 class="video-title">Epic Music Video - Incredible Visuals and Sound</h3>
                    <div class="video-meta">
                        <div class="video-stats">
                            <span><i class="fas fa-eye"></i> 856K views</span>
                            <span><i class="fas fa-calendar"></i> 1 week ago</span>
                        </div>
                        <div class="video-actions">
                            <a href="#" class="action-btn edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sample Video Card 3 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        class="video-iframe"
                        src="https://www.youtube.com/embed/L_jWHffIx5E" 
                        allowfullscreen>
                    </iframe>
                    <div class="play-overlay">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="video-info">
                    <h3 class="video-title">Technology Review - Latest Gadgets and Innovations</h3>
                    <div class="video-meta">
                        <div class="video-stats">
                            <span><i class="fas fa-eye"></i> 2.1M views</span>
                            <span><i class="fas fa-calendar"></i> 3 days ago</span>
                        </div>
                        <div class="video-actions">
                            <a href="#" class="action-btn edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sample Video Card 4 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        class="video-iframe"
                        src="https://www.youtube.com/embed/9bZkp7q19f0" 
                        allowfullscreen>
                    </iframe>
                    <div class="play-overlay">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="video-info">
                    <h3 class="video-title">Cooking Masterclass - Professional Techniques Made Simple</h3>
                    <div class="video-meta">
                        <div class="video-stats">
                            <span><i class="fas fa-eye"></i> 645K views</span>
                            <span><i class="fas fa-calendar"></i> 5 days ago</span>
                        </div>
                        <div class="video-actions">
                            <a href="#" class="action-btn edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Add interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchBox = document.querySelector('.search-box');
            const searchBtn = document.querySelector('.search-btn');
            
            searchBtn.addEventListener('click', function() {
                if (searchBox.value.trim()) {
                    console.log('Searching for:', searchBox.value);
                    // Add your search logic here
                }
            });

            searchBox.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchBtn.click();
                }
            });

            // Add smooth hover effects
            const videoCards = document.querySelectorAll('.video-card');
            videoCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add click handlers for action buttons
            const actionBtns = document.querySelectorAll('.action-btn');
            actionBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const action = this.textContent.trim();
                    console.log(`${action} clicked for video`);
                    // Add your action logic here
                });
            });
        });
    </script>
</body>
</html>