<div>
    @session('SUCCESS')
    <input type="text" hidden id="message" value="{{ $value }}">
    <script type="module">
        messageDialogue('success', $('#message').val(), 'ok')
    </script>
    @endsession
    @session('ERROR')
    <input type="text" hidden id="message" value="{{ $value }}">
    <script type="module">
        messageDialogue('error', $('#message').val(), 'ok')
    </script>
    @endsession
    @session('INFO')
    <input type="text" hidden id="message" value="{{ $value }}">
    <script type="module">
        messageDialogue('info', $('#message').val(), 'ok')
    </script>
    @endsession
</div>