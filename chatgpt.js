function askChatGPT(categories, country, { minDuration, maxDuration }) {
    const promptText = `Gib mir eine Filmempfehlung aus ${country}, die zu den Genres ${categories.join(', ')} passt. Ich suche einen Film mit einer Laufzeit zwischen ${minDuration} und ${maxDuration} Minuten. Falls kein exakter Treffer gefunden wird, nenne einen Film aus ${country}, der mindestens zwei dieser Genres enthält. Die Laufzeit darf in diesem Fall abweichen. Gib nur den Titel des Films zurück – keine Beschreibungen, keine Erklärungen.`;

    fetch('https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'x-goog-api-key': 'AIzaSyA3-yu43kouAliDx-4MMCA0aNClnOYn-4Q'
        },
        body: JSON.stringify({
            contents: [
                {
                    role: "user",
                    parts: [
                        {
                            text: promptText
                        }
                    ]
                }
            ]
        })
    })
    .then(response => response.json())
    .then(data => {
        const textOutput =
            data.candidates?.[0]?.content?.parts?.[0]?.text ?? "Keine gültige Antwort erhalten.";
        document.getElementById('chatgpt-result').textContent = textOutput;
        localStorage.setItem('film', textOutput);
    })
    .catch(error => {
        document.getElementById('chatgpt-result').textContent = "Fehler: " + error.message;
        console.error('Fehler:', error);
    });

    console.log('An Gemini gesendeter Prompt: ', promptText)
}