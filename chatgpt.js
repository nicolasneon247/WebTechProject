function askChatGPT(promptText) {
    fetch('https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'x-goog-api-key': 'AIzaSyA3-yu43kouAliDx-4MMCA0aNClnOYn-4Q'
        },
        body: JSON.stringify({
            contents: [{
                parts: [{
                    text: promptText
                }]
            }]
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.candidates && data.candidates.length > 0 &&
            data.candidates[0].content &&
            data.candidates[0].content.parts &&
            data.candidates[0].content.parts.length > 0) {
            document.getElementById('chatgpt-result').textContent =
                data.candidates[0].content.parts[0].text;
        } else {
            document.getElementById('chatgpt-result').textContent =
                "Invalid response from API: " + JSON.stringify(data);
        }
    })
    .catch(error => {
        document.getElementById('chatgpt-result').textContent = "Error: " + error.message;
        console.error('Error:', error);
    });
}
