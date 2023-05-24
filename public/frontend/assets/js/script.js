
const siteUr = "http://127.0.0.1:8000/";

$('body').on('keyup','#search',function(){
   let text = $('#search').val();

   if (text.length > 0){
       $.ajax({
           url: siteUr + "ajax-product-search",
           method: "POST",
           data: {
               search: text
           },
           beforeSend: function (request) {
               request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
           },
           success: function (data) {
               $('#search-item').html(data);
           },
           error: function (err) {
               console.log(err);
           }
       })
   }
    if (text.length < 1) $("#search-item").html("");

});

function handleVoiceSearch() {
    var recognition = new webkitSpeechRecognition(); // Create a new instance of the speech recognition API
    recognition.start(); // Start the speech recognition
    recognition.lang = 'en-US'; // Set the language for recognition

    recognition.onresult = func

    tion(event) {
        let transcript = event.results[0][0].transcript; // Get the recognized transcript
        document.getElementById('search').value = transcript; // Update the search input field with the transcript

        if (transcript == 'clear'){
            document.getElementById('search').value = ''; // Update the search input field with the transcript
            transcript = '';
        }

        if (transcript.length > 0){
            $.ajax({
                url: siteUr + "ajax-product-search",
                method: "POST",
                data: {
                    search: transcript
                },
                beforeSend: function (request) {
                    request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                },
                success: function (data) {
                    $('#search-item').html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            })
        }
        if (transcript.length < 1) $("#search-item").html("");
    };

}
