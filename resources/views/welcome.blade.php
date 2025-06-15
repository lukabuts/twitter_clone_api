<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Clone API</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --twitter-blue: #1DA1F2;
            --twitter-dark: #15202B;
            --twitter-light: #192734;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--twitter-dark);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
            position: relative;
        }

        .bird {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 4rem;
            animation: float 3s ease-in-out infinite;
        }

        h1 {
            font-size: 2.5rem;
            color: var(--twitter-blue);
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .tagline {
            font-size: 1.4rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .features {
            background: var(--twitter-light);
            border-radius: 16px;
            padding: 1.5rem;
            margin: 2rem 0;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .feature-icon {
            margin-right: 1rem;
            color: var(--twitter-blue);
            font-size: 1.2rem;
        }

        .links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .link-button {
            padding: 0.8rem 1.5rem;
            background: var(--twitter-blue);
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .link-button:hover {
            background: #0d8de1;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(29, 161, 242, 0.3);
        }

        .version {
            margin-top: 2rem;
            color: #8899A6;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>        
    <div class="container">
        <div class="bird">🐦</div>
        <h1>Twitter Clone API</h1>
        <p class="tagline">The powerful backend engine for your Twitter-like application</p>
        
        <div class="features">
            <div class="feature-item">
                <span class="feature-icon">🔐</span>
                <span>Secure API Authentication (Laravel Sanctum)
                </span>
            </div>
            <div class="feature-item">
                <span class="feature-icon">💬</span>
                <span>Tweet creation, feeds, and interactions</span>
            </div>
            <div class="feature-item">
                <span class="feature-icon">👥</span>
                <span>Follow/Unfollow system with notifications</span>
            </div>
            <div class="feature-item">
                <span class="feature-icon">⚡</span>
                <span>Optimized for high performance</span>
            </div>
        </div>

        <div class="links">
            <a href="{{ env('BACKEND_REPO_URL') }}" class="link-button" target="_blank">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 5px;">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                </svg>
                API Source Code
            </a>
            <a href="{{ env('FRONTEND_REPO_URL') }}" class="link-button" target="_blank">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 5px;">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                </svg>
                Frontend Project
            </a>
        </div>

        <div class="version">
            Powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP {{ phpversion() }})
        </div>
    </div>
</body>
</html>