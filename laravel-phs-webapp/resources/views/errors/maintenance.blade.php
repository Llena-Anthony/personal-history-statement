<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Maintenance - PHS Online System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }
        
        .maintenance-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        
        .maintenance-icon {
            width: 80px;
            height: 80px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2rem;
            color: #6c757d;
        }
        
        h1 {
            color: #495057;
            margin-bottom: 1rem;
            font-size: 2rem;
            font-weight: 600;
        }
        
        .message {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        
        .status-code {
            background: #e9ecef;
            color: #495057;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            display: inline-block;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .back-button {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
        }
        
        .back-button:hover {
            background: #5a6fd8;
        }
        
        @media (max-width: 480px) {
            .maintenance-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            .message {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <div class="maintenance-icon">
            🔧
        </div>
        
        <h1>System Maintenance</h1>
        
        <div class="message">
            We're currently performing scheduled maintenance to improve our services. 
            Please check back in a few minutes.
        </div>
        
        <div class="status-code">
            Status: 503 Service Unavailable
        </div>
        
        <a href="{{ url('/') }}" class="back-button">
            Try Again
        </a>
    </div>
</body>
</html> 