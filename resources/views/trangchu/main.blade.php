<!DOCTYPE html>
<html lang="vi">

<head>
    @include('trangchu.head')
</head>
<style>
    /* thanh cuộn lên */
    #scrollTopBtn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
        display: none;
        width: 45px;
        height: 45px;
        font-size: 18px;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    #scrollTopBtn i {
        margin: auto;
    }
</style>

<body>
    @include('trangchu.header')

    @yield('content')
    {{-- AI Chat Box - Start --}}
        <!-- Chat AI Button -->
        <style>
            #chat-toggle {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 9999;
                border-radius: 50%;
                width: 60px;
                height: 60px;
            }

            #chatbox {
                overflow: hidden;
                resize: none;
                position: fixed;
                bottom: 90px;
                right: 20px;
                width: 360px;
                max-height: 500px;
                z-index: 9998;
                border-radius: 16px;
                border-end-end-radius: 0;
                display: none;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            }

            #chatbox .chat-messages {
                height: 300px;
                overflow-y: auto;
            }

            #chatbox .form-control {
                border-radius: 0;
            }

            .ai-reply-text {
                font-family: inherit;
                font-size: inherit;
                display: inline-block;
                vertical-align: top;
                white-space: normal;
            }
        </style>

        <!-- Chat Toggle Button -->
        <button id="chat-toggle" class="btn btn-primary shadow">
            <i class="bi bi-chat-dots-fill fs-2"></i>
        </button>

        <!-- Chat Box -->
        <div id="chatbox" class="bg-white border">
            <div class="p-3 border-bottom d-flex align-items-center bg-primary text-white">
                <i class="align-middle me-2" data-feather="codepen"></i>
                <strong class="fs-4">
                    Trợ lý tư vấn đặt lịch khám
                </strong>
                <button class="btn btn-light rounded text-primary ms-auto" onclick="toggleChat()">
                    <strong><i class="align-middle" data-feather="x"></i></strong>
                </button>
            </div>
            <div class="p-3 chat-messages" id="chat-messages">
                <div class="text-muted mb-2">Xin chào, bạn cần tư vấn gì?</div>
            </div>
            <div class="input-group">
                <input type="text" id="chat-input" class="form-control form-control-lg"
                    placeholder="Nhập tin nhắn ..." style="border-bottom-left-radius: 16px">
                <button class="btn btn-primary btn-lg" onclick="sendMessage()">Gửi</button>
            </div>
        </div>

        <script>
            const toggleChat = () => {
                const box = document.getElementById('chatbox');
                const isHidden = window.getComputedStyle(box).display === 'none';
                box.style.display = isHidden ? 'block' : 'none';
            }

            document.getElementById('chat-toggle').addEventListener('click', toggleChat);

            function sendMessage() {
                const input = document.getElementById('chat-input');
                const message = input.value.trim();
                if (!message) return;

                const messages = document.getElementById('chat-messages');

                // Thêm tin nhắn của người dùng vào cuối chat
                messages.innerHTML += `<div class="mb-2"><strong>Bạn:</strong> ${message}</div>`;

                // Tạo phần loading của AI
                const loadingEl = document.createElement('div');
                loadingEl.classList.add('mb-2');
                loadingEl.innerHTML = `<strong>AI:</strong> <span class="dots">.</span>`;
                messages.appendChild(loadingEl);
                messages.scrollTop = messages.scrollHeight;

                const dots = loadingEl.querySelector('.dots');
                let dotCount = 1;
                const loadingInterval = setInterval(() => {
                    dotCount = (dotCount % 3) + 1;
                    dots.textContent = '.'.repeat(dotCount);
                }, 500);

                const chatAIUrl = "{{ route('home.chatbox') }}";
                fetch(chatAIUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            message
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        clearInterval(loadingInterval);
                        const reply = data.reply || 'Xin lỗi, tôi chưa hiểu câu hỏi của bạn.';

                        // Dùng thẻ <pre> để giữ format và hiệu ứng gõ từng chữ
                        loadingEl.innerHTML =
                            `<strong>AI:</strong> <pre class="mb-0 ai-reply-text" style="white-space: pre-wrap; display: inline-block;"></pre>`;
                        const typingText = loadingEl.querySelector('pre');

                        let i = 0;
                        const typeInterval = setInterval(() => {
                            typingText.textContent += reply.charAt(i);
                            i++;
                            if (i >= reply.length) {
                                clearInterval(typeInterval);
                                messages.scrollTop = messages.scrollHeight;
                            }
                        }, 10);
                    })
                    .catch(() => {
                        clearInterval(loadingInterval);
                        loadingEl.innerHTML =
                            `<strong>AI:</strong> <span class="text-danger">Lỗi khi kết nối. Vui lòng thử lại.</span>`;
                    });

                input.value = '';
            }

            document.getElementById('chat-input').addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        </script>
        {{-- AI Chat Box - End --}}


    <!-- Nút đi lên đầu trang -->
    <button id="scrollTopBtn" class="btn btn-primary rounded-circle shadow" title="Lên đầu trang"
        style="position: fixed; bottom: 90px; right: 30px; z-index: 9999; display: none; width: 45px; height: 45px;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        const scrollTopBtn = document.getElementById("scrollTopBtn");

        window.onscroll = function() {
            // Hiện nút nếu cuộn xuống hơn 100px
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollTopBtn.style.display = "flex";
            } else {
                scrollTopBtn.style.display = "none";
            }
        };

        scrollTopBtn.onclick = function() {
            // Cuộn lên đầu trang
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    </script>
    @include('trangchu.footer')
</body>

</html>
