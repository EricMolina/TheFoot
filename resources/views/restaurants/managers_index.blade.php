@extends('layouts.layout_search')

@section('titulo', 'The Foot - Mis restaurantes')
@section('regSection')
    <span id="regBtn" class="roboto-medium">Bienviendo, {{ Auth::User()->name }}</span>
    <a href="{{ Route('logout') }}" id="regBtn" class="roboto-medium">CERRAR SESIÓN</a>
    @if (Auth::User()->role == 'Manager')
        <a href="{{ Route('myrestaurants') }}" id="regBtn" class="roboto-medium">MIS RESTAURANTES</a>
    @else
        @if (Auth::User()->role == 'Administrator')
            <a href="{{ Route('crud.restaurants') }}" id="regBtn" class="roboto-medium">GESTIONAR RESTAURANTES</a>
            <a href="{{ Route('crud.users') }}" id="regBtn" class="roboto-medium">GESTIONAR USUARIOS</a>
        @endif
    @endif
    <a href="{{ Route('home') }}" id="regBtn" class="roboto-medium">PÁGINA PRINCIPAL</a>
    <br>
@endsection
@section('content')

@endsection
@section('searchContainer')
    <br>
    <button class="btn-primary" style="margin-left: 40px;" onclick="displayRestaurantForm()">Crear nuevo
        restaurante</button>
    <br><br><br>
    <div id="restaurant-table">

    </div>


@endsection

<style>
    td,
    tr {
        border: 1px solid black;
        padding: 5px 12px;
    }

    .modal-height {
        height: 675px;
    }

    .images-container {
        width: 90%;
        height: 400px;
        border: 1px solid black;
        padding: 20px;
        overflow-y: auto;
        border-radius: 0.25em;
        box-shadow: rgb(217, 217, 217) 3.2px 3.2px 8px 0px inset, rgb(255, 255, 255) -3.2px -3.2px 8px 0px inset;
    }

    .images-container .images-container-flex {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .images-container::-webkit-scrollbar {
        width: 10px;
    }

    .images-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .images-container::-webkit-scrollbar-thumb {
        background: #006657;
        border-radius: 0.25em;
    }

    .images-container .restaurant-image {
        position: relative;
        width: 205px;
        height: 125px;
        background-size: cover;
        background-position: center;
        border: 1px solid rgb(108, 108, 108);
        border-radius: 0.25em;
    }

    .images-container a {
        position: absolute;
        top: 7px;
        right: 7px;
        background-color: white;
        color: black;
        padding: 3px 6px;
        cursor: pointer;
        border-radius: 100%;
        font-size: 15px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .images-upload-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .images-upload-container .fake-file-input {
        width: 50%;
    }

    .restaurant-form-images .images-btn {
        background-color: #006657;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 0.25em;
        text-decoration: none;
        color: white;
        font-size: 17px;
    }

    .restaurant-form-images .images-btn:hover {
        background-color: hsl(174, 100%, 15%);
    }

    .images-container a:hover {
        background-color: rgb(226, 226, 226);
    }

    .restaurant-form {
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 40px;
    }

    .restaurant-form.two-columns .restaurant-form-info {
        width: 50%;
        float: left;
    }

    .restaurant-form-images {
        width: 50%;
        float: left;
    }

    .restaurant-form:not(.two-columns) {
        gap: 0;
    }

    .restaurant-form:not(.two-columns) .restaurant-form-info {
        display: flex;
        justify-content: center;
    }

    .restaurant-form:not(.two-columns) .restaurant-form-images {
        width: 0%;
    }

    .restaurant-form form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .restaurant-form form input[type="text"],
    input[type="number"] {
        border: none;
        border-bottom: 2px solid rgb(0, 0, 0);
        background-color: rgba(255, 255, 255, 0);
        color: rgb(0, 0, 0);
        display: block;
        font-size: 17px;
        outline: none;
    }

    .restaurant-form form label {
        font-size: 16px;
    }

    .restaurant-form .input-group {
        display: flex;
        justify-content: end;
        align-items: center;
        gap: 15px;
        width: 100%;
    }

    .restaurant-form .input-group input {
        height: 12px;
        width: 65%;
        padding: 5px 0px;
    }

    .restaurant-form .input-group select {
        font-size: 15px;
        width: 65%;
        padding: 5px 0px;
    }

    .restaurant-form:not(.two-columns) .input-group input {
        width: 70%;
    }

    .restaurant-form:not(.two-columns) .input-group select {
        width: 70%;
    }

    .restaurant-form .input-group select {
        float: left;
        margin-top: 1%;
        margin-left: 1%;
        padding: 5px 0px;
        font-size: 17px;
        border-style: solid;
        border-width: 2px;
        border-radius: 10px;
        border-color: #d5d8dc;
        background-color: white;
    }

    .restaurant-form .input-group select:hover {
        border-color: #006399;
        background-color: #f6f6f6;
        color: #006399;
    }

    .restaurant-form .input-group select:focus {
        border-color: #006399;
        background-color: #f6f6f6;
        color: #006399;
        -webkit-box-shadow: inset 0px 0px 1px 1px rgba(0, 99, 153, 1);
        -moz-box-shadow: inset 0px 0px 1px 1px rgba(0, 99, 153, 1);
        box-shadow: inset 0px 0px 1px 1px rgba(0, 99, 153, 1);
    }

    .restaurant-form .input-group select>option {
        color: black;
    }

    .restaurant-form .fake-file-input {
        width: 65%;
    }

    .restaurant-form:not(.two-columns) .fake-file-input {
        width: 70%;
    }

    .fake-file-input input {
        display: none;
    }

    .fake-file-input label {
        display: block;
        width: 90%;
        background-color: #006657;
        padding: 7px 15px;
        cursor: pointer;
        border-radius: 0.25em;
        color: white;
        font-size: 17px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .fake-file-input label:hover {
        background-color: hsl(174, 100%, 15%);
    }

    .restaurant-form .foodtypes-selector {
        border: 1px solid black;
        border-radius: 0.25em;
        box-shadow: rgb(217, 217, 217) 3.2px 3.2px 8px 0px inset, rgb(255, 255, 255) -3.2px -3.2px 8px 0px inset;
        padding: 20px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    .restaurant-form .foodtypes-selector>div {
        margin-bottom: 10px;
    }

    .restaurant-form .foodtypes-selector input {
        display: none;
    }

    .restaurant-form .foodtypes-selector label {
        border: 1px solid rgb(108, 108, 108);
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 17px;
        cursor: pointer;
    }

    .restaurant-form .foodtypes-selector input:checked~label {
        background-color: rgb(108, 108, 108);
        color: white;
    }

    label {
        color: black !important;
    }

    input:checked ~ label {
        color: white !important;
    }

    input {
        height: 30px !important;
    }

    .fake-file-input label {
        color: white !important;
    }

    .resIcon_ {
        margin-top: 0%;
        margin-bottom: 0%;
        width: 5%;
        margin-left: 2%;
    }

    .btn-primary {
        background-color: #006657;
        padding: 10px 20px;
        height: fit-content;
        font-size: 18px;
        cursor: pointer;
        color: white;
        border: none;
        border-radius: 4px;
    }

    .btn-primary:hover {
        background-color: #004d41;
    }

    .resContainer {
        padding: 20px;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function displayRestaurants(restaurants) {
        let restaurantTable = document.getElementById('restaurant-table');
        restaurantTable.innerHTML = '';

        restaurants.forEach(restaurant => {
            let restaurantStatus = restaurant.status == 0 ? 'Pendiente' :
                restaurant.status == 1 ? 'Aprobado' : 'Rechazado';

            let restaurantHTML = `
            <div class="resContainer row">
                <div class="col-res1"><img src="{{ asset('images/thumbnails/') }}/${restaurant.thumbnail}" alt="" srcset="" class="thumbnail"></div>
                <div class="col-res2">
                    <h2 class="roboto-bold titleRes">Nombre: ${restaurant.name}</h2>
                    <p class="roboto-light-italic">Estado: <span>${restaurantStatus}</span></p>
                    <p class="roboto-light-italic">Dirección: ${restaurant.location}</p>
                    <p class="roboto-light-italic">Precio medio: <span>${restaurant.average_price}</span></p>
                    <p class="roboto-light-italic">Descripción: ${restaurant.description}</p>
                    <span class="roboto-bold">Tipos de comida: </span>`;
            restaurant.foodtypes.forEach(foodtype => {
                restaurantHTML += `
                <img src="{{ asset('img/icons/food/') }}/${foodtype.icon}" class="resIcon_">`;
            });
            restaurantHTML += `
                </div>
                <div class="col-res3">
                    <br>
                    <button class="btn-primary" onclick="displayRestaurantForm(${restaurant.id})">Editar</button>
                    <br><br>
                    <button class="btn-primary" onclick="displayDeleteRestaurant(${restaurant.id})">Eliminar</button>
                </div>
            </div>
            <hr class="hrRes">`;
            restaurantTable.innerHTML += restaurantHTML;
        });
    }


    function displayRestaurantForm(id = null) {
        Swal.fire({
            title: id ? 'Editar restaurante' : 'Crear restaurante',
            html: `
            <div class="restaurant-form ${id ? 'two-columns' : ''}">
                <div class="restaurant-form-info">
                    <form id="create-restaurant-form" enctype="multipart/form-data">
                        <div class="input-group">
                            <label>Nombre</label>
                            <input id="restaurant-name" type="text" name="name">
                        </div>
                        <div class="input-group">
                            <label>Descripción</label>
                            <input id="restaurant-description" type="text" name="description">
                        </div>
                        <div class="input-group">
                            <label>Ubicación</label>
                            <input id="restaurant-location" type="text" name="location">
                        </div>
                        <div class="input-group">
                            <label>Precio medio</label>
                            <input id="restaurant-average_price" type="number" name="average_price">
                        </div>

                        <div class="input-group">
                            <label>Miniatura</label>
                            <div class="fake-file-input">
                                <input onchange="changeInputLabel('thumbnail')" id="thumbnail-input" type="file" name="thumbnail">
                                <label id="thumbnail-label" for="thumbnail-input">Choose a file...</label>
                            </div>
                        </div>

                        ${!id ? `                        
                            <div class="input-group">
                                <label>Imágenes</label>
                                <div class="fake-file-input">
                                    <input onchange="changeMultipleInputLabel('restaurant-images')"  id="restaurant-images-input" type="file" name="images[]" multiple>
                                    <label id="restaurant-images-label" for="restaurant-images-input">Choose files...</label>
                                </div>
                            </div>
                            ` : ``}
                        
                        <div class="foodtypes-selector" id="foodtypes-container"></div>
    
                    </form>
                </div>

                <div class="restaurant-form-images">
                    ${id ? `
                        <div class="images-container">
                            <div class="images-container-flex" id="images-container"></div>
                        </div><br>
                        <div class="images-upload-container">
                            <div class="fake-file-input">
                                <input onchange="changeInputLabel('restaurant-images')" id="restaurant-images-input" type="file" name="restaurant-images">
                                <label id="restaurant-images-label" for="restaurant-images-input">Choose a file...</label>
                            </div>
                            <a class="images-btn" href="#" class="" onclick="attachRestaurantImage(${id})" >Upload</a>
                        </div>
                        ` : ''}    
                </div>

            </div>`,
            width: id ? '1100px' : '540px',
            showCancelButton: true,
            confirmButtonText: id ? 'Editar' : 'Crear',
            confirmButtonColor: '#006657',
            cancelButtonText: 'Cancelar',
            didRender: () => {
                if (id) {
                    getRestaurant(id);
                } else {
                    getFoodtypes();
                }
            },
            preConfirm: () => {

                if (!validateRestaurantForm(id ? true : false)) {
                    return "";
                }

                if (!id) {
                    createRestaurant();
                } else {
                    updateRestaurant(id);
                }
            }
        });
    }


    function validateRestaurantForm(is_edit = false) {
        const name = document.getElementById('restaurant-name').value;
        const description = document.getElementById('restaurant-description').value;
        const location = document.getElementById('restaurant-location').value;
        const average_price = document.getElementById('restaurant-average_price').value;
        const foodtypes = document.querySelectorAll('.foodtype-item:checked')

        if (!name.trim()) {
            Swal.showValidationMessage("Introduce un nombre al restaurante");
            return false;
        }
        if (!description.trim()) {
            Swal.showValidationMessage("Introduce una descripción al restaurante");
            return false;
        }
        if (!location.trim()) {
            Swal.showValidationMessage("Introduce una ubicación al restaurante");
            return false;
        }
        if (!average_price.trim() || average_price == "0") {
            Swal.showValidationMessage("Introduce un precio medio al restaurante");
            return false;
        }

        if (!is_edit) {
            const images = document.getElementById('restaurant-images-input').files;
            const thumbnail = document.getElementById('thumbnail-input').files[0];

            if (!thumbnail) {
                Swal.showValidationMessage("Introduce una miniatura al restaurante");
                return false;
            }
            if (images.length <= 0) {
                Swal.showValidationMessage("Introduce alguna imagen al restaurante");
                return false;
            }
        }

        if (foodtypes.length <= 0) {
            Swal.showValidationMessage("Selecciona mínimo un tipo de comida");
            return false;
        }

        return true;
    }


    function displayRestaurant(restaurant) {
        document.getElementById('restaurant-name').value = restaurant.name;
        document.getElementById('restaurant-description').value = restaurant.description;
        document.getElementById('restaurant-location').value = restaurant.location;
        document.getElementById('restaurant-average_price').value = restaurant.average_price;

        fetch("{{ route('api.foodtypes.list') }}")
            .then((res) => res.text())
            .then((responseText) => {
                let foodtypes = JSON.parse(responseText);
                displayFoodtypes(foodtypes);

                restaurant.foodtypes.forEach(foodtype => {
                    document.getElementById(`foodtypes-${foodtype.id}`).checked = true;
                });
            })

        displayRestaurantImages(restaurant.images);
    }


    function displayFoodtypes(foodtypes) {
        let foodtypesContainer = document.getElementById('foodtypes-container');

        foodtypes.forEach(foodtype => {
            foodtypesContainer.innerHTML += `<div>
                    <input class="foodtype-item" id="foodtypes-${foodtype.id}" type="checkbox" name="foodtypes[]" value="${foodtype.id}">
                    <label for="foodtypes-${foodtype.id}">${foodtype.name}</label>
                </div>`;
        });
    }


    function displayRestaurantImages(images) {
        let imagesContainer = document.getElementById('images-container');
        imagesContainer.innerHTML = '';

        images.forEach(image => {
            imagesContainer.innerHTML += `<div class="restaurant-image" style='background-image: url("{{ asset('images/restaurants') }}/${image.image_url}")'>
                    <a onclick="deleteRestaurantImage(${image.id})">✖</a>
                </div>`;
        });
    }


    function getRestaurants() {
        fetch("{{ route('api.manager.restaurants.list') }}")
            .then((res) => res.text())
            .then((responseText) => {
                let restaurants = JSON.parse(responseText);
                displayRestaurants(restaurants);
            })
    }


    function getRestaurant(id) {
        fetch("{{ route('api.manager.restaurants.show') }}" + "?id=" + id)
            .then((res) => res.text())
            .then((responseText) => {
                let restaurant = JSON.parse(responseText);
                displayRestaurant(restaurant);
            })
    }


    function getFoodtypes() {
        fetch("{{ route('api.foodtypes.list') }}")
            .then((res) => res.text())
            .then((responseText) => {
                let foodtypes = JSON.parse(responseText);
                displayFoodtypes(foodtypes);
            })
    }


    function createRestaurant() {
        let form = document.getElementById('create-restaurant-form');
        let formData = new FormData(form);

        return fetch("{{ route('api.manager.restaurants.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => {
                getRestaurants();
            })
            .catch(error => {
                console.log(error);
            });
    }


    function updateRestaurant(id) {
        let form = document.getElementById('create-restaurant-form');
        let formData = new FormData(form);
        formData.append('id', id);
        formData.append('_method', 'PUT');

        return fetch("{{ route('api.manager.restaurants.update') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => {
                getRestaurants();
            })
            .catch(error => {
                console.log(error);
            });
    }


    function displayDeleteRestaurant(id) {
        Swal.fire({
            title: 'Eliminar restaurante',
            text: '¿Estás seguro de que quieres eliminar este restaurante?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#006657',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                deleteRestaurant(id);
            }
        });
    }


    function deleteRestaurant(id) {
        fetch("{{ route('api.manager.restaurants.destroy') }}", {
                method: 'DELETE',
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then(() => {
                getRestaurants();
            })
    }


    function deleteRestaurantImage(id) {
        fetch("{{ route('api.manager.restaurants.images.destroy_image') }}", {
                method: 'DELETE',
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then((res) => res.text())
            .then((responseText) => {
                let images = JSON.parse(responseText);
                displayRestaurantImages(images);
            })
    }


    function attachRestaurantImage(id) {
        let image = document.getElementById('restaurant-images-input').files[0];

        let formData = new FormData();
        formData.append('restaurant_id', id);
        formData.append('image', image);

        fetch("{{ route('api.manager.restaurants.images.attach_image') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then((res) => res.text())
            .then((responseText) => {
                let images = JSON.parse(responseText);
                displayRestaurantImages(images);
                document.getElementById('restaurant-images-input').value = '';
                document.getElementById('restaurant-images-label').innerText = 'Choose a file...';
            })
    }


    function changeInputLabel(input) {
        let inputValue = document.getElementById(`${input}-input`).value;
        let inputValueSplit = inputValue.split('\\');
        let imageName = inputValueSplit[inputValueSplit.length - 1]
        document.getElementById(`${input}-label`).innerText = imageName;
    }


    function changeMultipleInputLabel(input) {
        let inputCount = document.getElementById(`${input}-input`).files.length;
        document.getElementById(`${input}-label`).innerText = `${inputCount} files selected`;
    }

    window.onload = function() {
        getRestaurants();
    }
</script>

</html>
