<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ完了 - FashionablyLate</title>
    <style>
        /* リセット・ベーススタイル */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, 'Hiragino Kaku Gothic ProN', 'Hiragino Sans', Meiryo, sans-serif;
            background-color: #ffffff;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }



        /* メインコンテンツ */
        .contact-complete-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background-color: #ffffff;
            position: relative;
        }

        /* 背景の Thank you */
        .background-text {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 200px;
            font-weight: 100;
            color: #f0f0f0;
            z-index: 0;
            pointer-events: none;
            letter-spacing: 20px;
            white-space: nowrap;
            font-family: 'Times New Roman', serif;
        }

        .complete-message {
            text-align: center;
            max-width: 600px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .complete-message h1 {
            font-size: 24px;
            font-weight: 400;
            color: #8B7969;
            margin-bottom: 40px;
            line-height: 1.5;
            letter-spacing: 0.5px;
        }

        .home-button-wrapper {
            display: flex;
            justify-content: center;
        }

        .home-button {
            display: inline-block;
            background-color: #82756A;
            color: white;
            text-decoration: none;
            padding: 12px 40px;
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 1px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .home-button:hover {
            background-color: #7a6349;
            text-decoration: none;
            color: white;
        }

        .home-button:focus {
            outline: 2px solid #8b7355;
            outline-offset: 2px;
        }

        /* レスポンシブ対応 */
        @media (max-width: 768px) {
            .background-text {
                font-size: 120px;
                letter-spacing: 10px;
            }
            
            .complete-message h1 {
                font-size: 20px;
                margin-bottom: 30px;
            }
            
            .home-button {
                padding: 10px 30px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .background-text {
                font-size: 80px;
                letter-spacing: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="contact-complete-container">
        <div class="background-text">Thank you</div>
        <div class="complete-message">
            <h1>お問い合わせありがとうございました</h1>
            <div class="home-button-wrapper">
                <a href="/" class="home-button">HOME</a>
            </div>
        </div>
    </div>
</body>
</html>