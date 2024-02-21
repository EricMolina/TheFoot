<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            font-family: "Roboto", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        td, tr {
            border: 1px solid black;
            padding: 5px 12px;
        }

        .modal-height {
            height: 750px;
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

        .restaurant-form form 
        input[type="text"], 
        input[type="number"] 
        {
            border: none;
            border-bottom: 2px solid rgb(0, 0, 0);
            background-color: rgba(255, 255, 255, 0);
            color: rgb(0, 0, 0);
            display: block;
            font-size: 17px;
            outline: none;
        }

        .restaurant-form form label {
            font-size: 17px;
        }

        .restaurant-form .input-group {
            display: flex;
            justify-content: end;
            align-items: center;
            gap: 15px;
            width: 100%;
        }

        .restaurant-form .input-group input {
            width: 65%;
            padding: 5px 0px;
        }

        .restaurant-form .input-group select {
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
        .restaurant-form .input-group select:hover{
            border-color: #006399;
            background-color: #f6f6f6;
            color: #006399;
        }
        .restaurant-form .input-group select:focus{
            border-color: #006399;
            background-color: #f6f6f6;
            color: #006399;
            -webkit-box-shadow: inset 0px 0px 1px 1px rgba(0,99,153,1);
            -moz-box-shadow: inset 0px 0px 1px 1px rgba(0,99,153,1);
            box-shadow: inset 0px 0px 1px 1px rgba(0,99,153,1);
        }
        .restaurant-form .input-group select>option{
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

        .restaurant-form .foodtypes-selector > div {
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

        .restaurant-form .foodtypes-selector input:checked ~ label {
            background-color: rgb(108, 108, 108);
            color: white;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
    <button onclick="displayRestaurantForm()" >Create</button><br><br>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th>Precio medio</th>
                <th>Gerente</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="restaurant-table">
            
        </tbody>
    </table>

</body>
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
                    <button onclick="displayDeleteRestaurant(${restaurant.id})" >Eliminar</button>
                    <button onclick="displayRestaurantForm(${restaurant.id})" >Editar</button>    
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
                        
                        <label>Foodtypes</label>
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
            customClass: 'modal-height',
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

                if (!validateRestaurantForm()) {
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


    function validateRestaurantForm() {
        const name = document.getElementById('restaurant-name').value;
        const description = document.getElementById('restaurant-description').value;
        const location = document.getElementById('restaurant-location').value;
        const average_price = document.getElementById('restaurant-average_price').value;
        const manager_id = document.getElementById('restaurant-manager_id').value;
        const status = document.getElementById('restaurant-status').value;
        const thumbnail = document.getElementById('thumbnail-input').files[0];

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
                    <input id="foodtypes-${foodtype.id}" type="checkbox" name="foodtypes[]" value="${foodtype.id}">
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
</html>