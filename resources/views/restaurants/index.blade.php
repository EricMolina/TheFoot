@extends('layouts.layout_login')
@section('titulo','The Foot - Registrarse')
@section('regSection')
    <a href="{{ Route('logout')}}" id="regBtn" class="roboto-medium">CERRAR SESIÓN</a>
    <br>
@endsection
@section('slider')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            font-family: "Roboto", sans-serif;
            font-weight: 300;
            font-style: normal;
        }
        label{
            color: initial
        }
    </style>
@endsection
@section('content')

    <button class="crudCreateBtn" onclick="displayRestaurantForm()" >Crear</button><br><br>

    <table>
        <thead>
            <tr class="tableHeader">
                <th class="roboto-bold">Nombre</th>
                <th class="roboto-bold">Descripción</th>
                <th class="roboto-bold">Ubicación</th>
                <th class="roboto-bold">Precio medio</th>
                <th class="roboto-bold">Gerente</th>
                <th class="roboto-bold">Estado</th>
                <th class="roboto-bold">Acciones</th>
            </tr>
        </thead>
        <tbody id="restaurant-table">
            
        </tbody>
    </table>

<script>

    function displayRestaurants(restaurants) {
        let restaurantTable = document.getElementById('restaurant-table');
        restaurantTable.innerHTML = '';
        
        restaurants.forEach(restaurant => {
            let restaurantStatus = restaurant.status == 0 ? 'Pendiente' :
                                    restaurant.status == 1 ? 'Aprobado' : 'Rechazado';

            restaurantTable.innerHTML += `<tr>
                <td>${restaurant.name}</td>
                <td>${restaurant.description}</td>
                <td>${restaurant.location}</td>
                <td>${restaurant.average_price}</td>
                <td>${restaurant.manager.name}</td>
                <td>${restaurantStatus}</td>
                <td>
                    <button class="crudDeleteBtn" onclick="displayDeleteRestaurant(${restaurant.id})" >Eliminar</button>
                    <button class="crudEditBtn" onclick="displayRestaurantForm(${restaurant.id})" >Editar</button>    
                </td>
            </tr>`;
        });
    }
    function displayRestaurantForm(id=null) {
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
                            <label>Gerente</label>
                            <input id="restaurant-manager_id" type="number" name="manager_id" placeholder="manager_id">
                        </div>

                        <div class="input-group">
                            <label>Estado</label>
                            <select id="restaurant-status" name="status">
                                <option disabled selected value="">Estado</option>
                                <option id="restaurant-status-0" value="0">Pendiente</option>
                                <option id="restaurant-status-1" value="1">Aprobado</option>
                                <option id="restaurant-status-2" value="2">Rechazado</option>
                            </select>
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


    function validateRestaurantForm(is_edit=false) {
        const name = document.getElementById('restaurant-name').value;
        const description = document.getElementById('restaurant-description').value;
        const location = document.getElementById('restaurant-location').value;
        const average_price = document.getElementById('restaurant-average_price').value;
        const manager_id = document.getElementById('restaurant-manager_id').value;
        const status = document.getElementById('restaurant-status').value;
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
        if (!manager_id.trim() || manager_id == "0") {
            Swal.showValidationMessage("Introduce un gerente al restaurante");
            return false;
        }
        if (!status.trim()) {
            Swal.showValidationMessage("Introduce un estado al restaurante");
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
        document.getElementById(`restaurant-status-${restaurant.status}`).selected = true;
        document.getElementById('restaurant-manager_id').value = restaurant.manager_id;

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
        fetch("{{ route('api.admin.restaurants.list') }}")
        .then((res) => res.text())
        .then((responseText) => {
            let restaurants = JSON.parse(responseText);
            displayRestaurants(restaurants);
        })
    }


    function getRestaurant(id) {
        fetch("{{ route('api.admin.restaurants.show') }}" + "?id=" + id)
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

        return fetch("{{ route('api.admin.restaurants.store') }}", {
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

        return fetch("{{ route('api.admin.restaurants.update') }}", {
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
        fetch("{{ route('api.admin.restaurants.destroy') }}", {
            method: 'DELETE',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({id: id})
        })
        .then(() => {
            getRestaurants();
        })
    }


    function deleteRestaurantImage(id) {
        fetch("{{ route('api.admin.restaurants.images.destroy_image') }}", {
            method: 'DELETE',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({id: id})
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

        fetch("{{ route('api.admin.restaurants.images.attach_image') }}", {
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


    getRestaurants();

</script>
@endsection