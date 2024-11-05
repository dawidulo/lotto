document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);
        fetch('process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Zmieniono na .json()
        })
        .then(data => {
            const resultElement = document.getElementById('result');
            if (data.error) {
                resultElement.innerHTML = `<div class="error">${data.error}</div>`;
            } else {
                resultElement.innerHTML = `<div class="result">
                    <p>Twoje liczby: ${data.userNumbers}</p>
                    <p>Wylosowane liczby: ${data.randomNumbers}</p>
                    <p>Liczba trafień: ${data.matches}</p>
                    <p>Wygrana: ${data.prize}</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Błąd:', error);
            const resultElement = document.getElementById('result');
            resultElement.innerHTML = '<div class="error">Wystąpił błąd podczas przetwarzania formularza. Spróbuj ponownie.</div>';
        });
    });
});


