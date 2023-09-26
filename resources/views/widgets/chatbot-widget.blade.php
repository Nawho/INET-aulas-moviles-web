{{-- 
    To create your custom wigget go here -> https://github.com/jalexmelendez/botman-studio-9-web-widget
    This is the default widget, to modify basic aspect and functions go here -> https://botman.io/2.0/web-widget
    --}}

<link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
<script>
    var botmanWidget = {
        title: 'Botinet',
        chatServer: '/api/botman',
        placeholderText: 'Chatea con Botinet',
        aboutText: 'Habla con Botinet',
        introMessage: "¡Hola! ✋ Soy Botinet, estoy aquí para asistirte con cualquier duda que puedas tener sobre las aulas virtuales.",
        bubbleAvatarUrl: 'imgs/bot_icon.webp',
        bubbleBackground: '#AAAAAA',
        mainColor: '#0E68AF'
    };
</script>

<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
