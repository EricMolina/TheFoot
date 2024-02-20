<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        td, tr {
            border: 1px solid black;
            padding: 5px 12px;
        }

        #images-container {
            width: 90%;
            height: 400px;
            border: 1px solid black;
            display: flex;
            gap: 10px;
            padding: 10px;
        }

        #images-container div {
            position: relative;
            width: 100px;
            height: 100px;
            background-size: cover;
            background-position: center;
        }

        #images-container a {
            position: absolute;
            top: 0;
            right: 0;
            background-color: white;
            padding: 5px; 
        }

        .restaurant-form {
            width: 100%;
        }
        
        .restaurant-form .restaurant-form-info {
            width: 50%;
            float: left;
        }

        .restaurant-form form {
            display: flex;
            flex-direction: column;
            width: 90%;
            gap: 15px;
        }

        .restaurant-form .input-group {
            display: flex;
            width: 100%;
        }

        .restaurant-form .input-group input {
            margin-left: auto;
            width: 65%;
        }

        .restaurant-form .input-group select {
            margin-left: auto;
            width: 40%;
        }

        .restaurant-form .foodtypes-selector {
            border: 1px solid black;
            padding: 10px;
            display: flex;
            gap: 7px;
        }

        .restaurant-form .foodtypes-selector input {
            display: none;
        }

        .restaurant-form .foodtypes-selector label {
            border: 1px solid grey;
            padding: 3px 5px;
            border-radius: 5px;
            font-size: 17px;
            cursor: pointer;
        }

        .restaurant-form .foodtypes-selector input:checked ~ label {
            background-color: rgb(212, 212, 212); 
        }

        .restaurant-form-images {
            width: 50%;
            float: left;
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
                    <button onclick="deleteRestaurant(${restaurant.id})" >Eliminar</button>
                    <button onclick="displayRestaurantForm(${restaurant.id})" >Editar</button>    
                </td>
            </tr>`;
        });
    }


    function displayRestaurantForm(id=null) {
        Swal.fire({
            title: id ? 'Editar restaurante' : 'Crear restaurante',
            html: `
            <div class="restaurant-form">
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
                                <option disabled selected>Estado</option>
                                <option id="restaurant-status-0" value="0">Pendiente</option>
                                <option id="restaurant-status-1" value="1">Aprobado</option>
                                <option id="restaurant-status-2" value="2">Rechazado</option>
                            </select>
                        </div>
    
                        <div class="foodtypes-selector" id="foodtypes-container"></div>
    
                        <input type="file" name="thumbnail" placeholder="thumbnail">
    
                        ${!id ? `<input type="file" name="images[]" placeholder="images" multiple>` : ``}
                        
                    </form>
                </div>

                <div class="restaurant-form-images">
                    ${id ? `<div id="images-container"></div> <br> <input type="file" id="restaurant-images" /> <a href="#" onclick="attachRestaurantImage(${id})" >Upload</a>` : ''}    
                </div>

            </div>`,
            width: '1000px',
            showCancelButton: true,
            confirmButtonText: id ? 'Editar' : 'Crear',
            cancelButtonText: 'Cancelar',
            didRender: () => {
                if (id) {
                    getRestaurant(id);
                } else {
                    getFoodtypes();
                }
            },
            preConfirm: () => {
                if (!id) {
                    createRestaurant();
                } else {
                    updateRestaurant(id);
                }
            }
        });
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
            imagesContainer.innerHTML += `<div style='background-image: url("{{ asset('images/restaurants') }}/${image.image_url}")'>
                    <a onclick="deleteRestaurantImage(${image.id})">x</a>
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
        let image = document.getElementById('restaurant-images').files[0];

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
            document.getElementById('restaurant-images').value = '';
        })
    }


    getRestaurants();

</script>
</html>