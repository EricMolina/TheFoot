<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
    <style>
        .stars-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            height: 50px;
            padding: 0;
            margin: 0;
        }

        .stars-container img {
            width: auto;
            height: 50px;
            cursor: pointer;
            filter: sepia(100%) hue-rotate(340deg) saturate(99999%) grayscale(100%);
            padding: 0;
            margin: 0;
        }

        .stars-container img:nth-child(2n) {
            transform: rotateY(180deg);
        }

        .stars-container img:hover~img {
            filter: sepia(100%) hue-rotate(340deg) saturate(99999%) grayscale(100%) !important;
        }
    </style>
</head>

<body>
    <form id="valorationsForm">
        <label for="score">Puntuación:</label><br>
        <input type="hidden" name="score" id="score" value="">
        <div class="stars-container">
            <img id="star-1" src="{{ asset('img/half_star.png') }}" alt="star">
            <img id="star-2" src="{{ asset('img/half_star.png') }}" alt="star">
            <img id="star-3" src="{{ asset('img/half_star.png') }}" alt="star">
            <img id="star-4" src="{{ asset('img/half_star.png') }}" alt="star">
            <img id="star-5" src="{{ asset('img/half_star.png') }}" alt="star">
            <img id="star-6" src="{{ asset('img/half_star.png') }}" alt="star">
            <img id="star-7" src="{{ asset('img/half_star.png') }}" alt="star">
            <img id="star-8" src="{{ asset('img/half_star.png') }}" alt="star">
            <img id="star-9" src="{{ asset('img/half_star.png') }}" alt="star">
            <img id="star-10" src="{{ asset('img/half_star.png') }}" alt="star">
        </div>
        <label for="comment">Comentario:</label><br>
        <textarea id="comment" name="comment"></textarea><br>
        <input type="hidden" id="restaurant_id" name="restaurant_id" value="{{ $restaurant->id }}">
        <input type="submit" value="Enviar">
    </form>
    <script>
        // Agregar el evento de clic a cada estrella
        let starsPainted = [];
        let stars = document.querySelectorAll('.stars-container img');
        stars.forEach(star => {
            star.addEventListener('click', function() {
                changeScoreValue(this.id);
                changeSiblingStyle(this);
            });
            star.addEventListener('mouseover', function() {
                star.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%) grayscale(50%)';
                let sibling = this.previousElementSibling;
                while (sibling) {
                    sibling.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%) grayscale(50%)';
                    sibling = sibling.previousElementSibling;
                }
            });

            star.addEventListener('mouseout', function() {
                if (starsPainted.includes(star)) {
                    star.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
                } else {
                    star.style.filter = '';
                }
                let sibling = this.previousElementSibling;
                while (sibling) {
                    if (starsPainted.includes(sibling)) {
                        sibling.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
                    } else {
                        sibling.style.filter = '';
                    }
                    sibling = sibling.previousElementSibling;
                }
                sibling = this.nextElementSibling;
                while (sibling) {
                    if (starsPainted.includes(sibling)) {
                        sibling.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
                    } else {
                        sibling.style.filter = '';
                    }
                    sibling = sibling.nextElementSibling;
                }
            });
        });

        // Función para cambiar el valor del input "score" al hacer clic en una estrella
        function changeScoreValue(starId) {
            let scoreInput = document.getElementById('score');
            scoreInput.value = starId.split('-')[1];
        }

        // Función para cambiar el estilo de los elementos hermanos de la estrella seleccionada
        function changeSiblingStyle(star) {
            starsPainted = [];
            starsPainted.push(star);
            star.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
            let sibling = star.previousElementSibling;
            while (sibling) {
                starsPainted.push(sibling);
                sibling.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
                sibling = sibling.previousElementSibling;
            }
        }


        document.getElementById('valorationsForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let score = document.getElementById('score').value;
            let comment = document.getElementById('comment').value;
            let restaurant_id = document.getElementById('restaurant_id').value;

            fetch('{{ route('api.valorations.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        score: score,
                        comment: comment,
                        restaurant_id: restaurant_id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'ok') {
                        console.log('ok');
                    } else {
                        console.log('bad');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error.message);
                });
        });
    </script>
</body>

</html>
