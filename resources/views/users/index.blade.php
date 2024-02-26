@extends('layouts.layout_login')
@section('titulo', 'Usuarios')
@section('regSection')
    <a href="{{ Route('logout') }}" id="regBtn" class="roboto-medium">CERRAR SESIÓN</a>
    <a href="{{ Route('home') }}" id="regBtn" class="roboto-medium">PÁGINA PRINCIPAL</a>
    @if (Auth::User()->role == 'Manager')
        <a href="{{ Route('myrestaurants') }}" id="regBtn" class="roboto-medium">MIS RESTAURANTES</a>
    @else
        @if (Auth::User()->role == 'Administrator')
            <a href="{{ Route('crud.restaurants') }}" id="regBtn" class="roboto-medium">GESTIONAR RESTAURANTES</a>
            <a href="{{ Route('crud.users') }}" id="regBtn" class="roboto-medium">GESTIONAR USUARIOS</a>
        @endif
    @endif
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

        label {
            color: initial
        }

        /* table {
                        width: 100%;
                        border-collapse: collapse;
                    } */
        /* th, td {
                        padding: 8px;
                        text-align: left;
                        border-bottom: 1px solid #ddd;
                    }

                    th {
                        background-color: #f2f2f2;
                    }

                    tr:hover {
                        background-color: #f5f5f5;
                    }

                    td img {
                        widows: 100px;
                        height: 100px;
                    } */
    </style>
@endsection
@section('content')
    <h1 class="crudTitle">Usuarios</h1>
    <button class="crudCreateBtn" href="#" onclick="createUser()">Crear</button>
    <br>
    <style>
        input {
            height: 25px !important;
        }

        .users-form {
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 0 !important;
            padding: 0 !important;
        }

        .users-form-info {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            float: left;
        }

        #createUserForm,
        #editUserForm {
            width: 90%;
            height: 100%;
        }

        .users-form:not(.two-columns) {
            gap: 0;
        }

        .users-form:not(.two-columns) .users-form-info {
            display: flex;
            justify-content: center;
        }

        .users-form form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .users-form form input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="password"] {
            border: none;
            border-bottom: 2px solid rgb(0, 0, 0);
            background-color: rgba(255, 255, 255, 0);
            color: rgb(0, 0, 0);
            display: block;
            font-size: 17px;
            outline: none;
        }

        .users-form form label {
            font-size: 16px;
        }

        .users-form .input-group {
            display: flex;
            justify-content: end;
            align-items: center;
            gap: 15px;
            width: 100%;
        }

        .users-form .input-group input {
            height: 12px;
            width: 65%;
            padding: 5px 0px;
        }

        .users-form .input-group select {
            font-size: 15px;
            width: 65%;
            padding: 5px 0px;
        }

        .users-form:not(.two-columns) .input-group input {
            width: 70%;
        }

        .users-form:not(.two-columns) .input-group select {
            width: 70%;
        }

        .users-form .input-group select {
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

        .users-form .input-group select:hover {
            border-color: #006399;
            background-color: #f6f6f6;
            color: #006399;
        }

        .users-form .input-group select:focus {
            border-color: #006399;
            background-color: #f6f6f6;
            color: #006399;
            -webkit-box-shadow: inset 0px 0px 1px 1px rgba(0, 99, 153, 1);
            -moz-box-shadow: inset 0px 0px 1px 1px rgba(0, 99, 153, 1);
            box-shadow: inset 0px 0px 1px 1px rgba(0, 99, 153, 1);
        }

        .users-form .input-group select>option {
            color: black;
        }

        .users-form .fake-file-input {
            width: 65%;
        }

        .users-form:not(.two-columns) .fake-file-input {
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

        .users-form .foodtypes-selector {
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

        .users-form .foodtypes-selector>div {
            margin-bottom: 10px;
        }

        .users-form .foodtypes-selector input {
            display: none;
        }

        .users-form .foodtypes-selector label {
            border: 1px solid rgb(108, 108, 108);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 17px;
            cursor: pointer;
        }

        .users-form .foodtypes-selector input:checked~label {
            background-color: rgb(108, 108, 108);
            color: white;
        }
    </style>
    </head>

    <body>
        <br>
        <table>
            <thead>
                <tr class="tableHeader">
                    <th class="roboto-bold">Name</th>
                    <th class="roboto-bold">Email</th>
                    <th class="roboto-bold">Role</th>
                    <th class="roboto-bold">Profile Image</th>
                    <th class="roboto-bold">Acciones</th>
                    {{-- <th class="roboto-bold">Eliminar</th> --}}
                </tr>
            </thead>
            <tbody id="userList">
                <!-- BEGIN: userList -->
                <!-- END: userList -->
            </tbody>
        </table>

        <br>
        <script>
            function loadUsers() {
                fetch("{{ route('api.admin.users.list') }}")
                    .then(response => response.json())
                    .then(data => {
                        let userList = document.getElementById('userList');
                        userList.innerHTML = '';

                        data.forEach(user => {
                            userList.innerHTML += `
                                                <tr>
                                                    <td>${user.name}</td>
                                                    <td>${user.email}</td>
                                                    <td>${user.role}</td>
                                                    <td><img src="{{ asset('images/profiles') }}/${user.profile_image}" alt="Profile Image" class="profilePicCrud"></td>
                                                    <td><button class="UserCrudDeleteBtn" onclick="deleteUser(${user.id})">Eliminar</button></br><button class="UserCrudEditBtn" onclick="editUser(${user.id})">Editar</button></td>
                                                </tr>
                                            `;
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
            loadUsers();

            function createUser() {
                Swal.fire({
                    title: 'Crear usuario',
                    html: `
                <div class="users-form">
                    <div class="users-form-info">
                        <form id="createUserForm" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <label>Nombre</label>
                                <input type="text" id="name" name="name">
                            </div>
                            <div class="input-group">
                                <label>Email</label>
                                <input type="email" id="email" name="email">
                            </div>
                            <div class="input-group">
                                <label>Contraseña</label>
                                <input type="password" id="password" name="password">
                            </div>
                            <div class="input-group">
                                <label>Imagen de perfil</label>
                                <div class="fake-file-input">
                                    <input id="profile_image" onchange="changeInputLabel('profile_image')" type="file" name="profile_image">
                                    <label id="profile_image-label" for="profile_image">Selecciona la imagen...</label>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Rol</label>
                                <select id="role" name="role">
                                    <option value="Client">Client</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                `,
                    showCancelButton: true,
                    confirmButtonText: 'Crear',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#006657',
                    preConfirm: () => {
                        let form = document.getElementById('createUserForm');
                        let formData = new FormData(form);

                        // Perform form validation
                        if (!validateForm(true)) {
                            return false;
                        }

                        return fetch("{{ route('api.admin.users.store') }}", {
                                method: 'POST',
                                headers: {
                                    "X-Requested-With": "XMLHttpRequest",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(response => {
                                console.log(response);
                                loadUsers(); // Reload the user list after creating a new user
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    }
                });
            }

            function deleteUser(id) {
                Swal.fire({
                    title: 'Eliminar usuario',
                    text: '¿Estás seguro de que quieres eliminar este usuario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#006657',
                    preConfirm: () => {
                        fetch("{{ route('api.admin.users.destroy') }}", {
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
                            .then(response => {
                                console.log(response);
                                loadUsers(); // Reload the user list after deleting a user
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    }
                });
            }

            function editUser(id) {
                fetch("{{ route('api.admin.users.show') }}", {
                        method: 'POST',
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
                    .then(response => response.json())
                    .then(user => {
                        Swal.fire({
                            title: 'Editar usuario',
                            html: `
                        <div class="users-form">
                            <div class="users-form-info">
                                <form id="editUserForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <label>Nombre</label>
                                        <input type="text" id="name" name="name" value="${user.name}">
                                    </div>
                                    <div class="input-group">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" value="${user.email}">
                                    </div>
                                    <div class="input-group">
                                        <label>Contraseña</label>
                                        <input type="password" id="password" name="password">
                                    </div>
                                    <div class="input-group">
                                        <label>Imagen de perfil</label>
                                        <div class="fake-file-input">
                                            <input id="profile_image" onchange="changeInputLabel('profile_image')" type="file" name="profile_image">
                                            <label id="profile_image-label" for="profile_image">Selecciona la imagen...</label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label>Rol</label>
                                        <select id="role" name="role">
                                            <option value="Client" ${user.role === 'Client' ? 'selected' : ''}>Client</option>
                                            <option value="Manager" ${user.role === 'Manager' ? 'selected' : ''}>Manager</option>
                                            <option value="Administrator" ${user.role === 'Administrator' ? 'selected' : ''}>Administrator</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label>Foto de perfil actual</label>
                                        <img src="{{ asset('images/profiles/${user.profile_image}') }}" alt="Foto de perfil actual" width="100">
                                </form>
                            </div>
                        </div>
                        `,
                            showCancelButton: true,
                            confirmButtonText: 'Guardar',
                            cancelButtonText: 'Cancelar',
                            confirmButtonColor: '#006657',
                            preConfirm: () => {
                                let form = document.getElementById('editUserForm');
                                let formData = new FormData(form);
                                formData.append('id', id);
                                formData.append("_method", "PUT");

                                // Perform form validation
                                if (!validateForm()) {
                                    return false;
                                }

                                return fetch("{{ route('api.admin.users.update') }}", {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: formData
                                    })
                                    .then(response => {
                                        console.log(response);
                                        loadUsers(); // Reload the user list after editing a user
                                    })
                                    .catch(error => {
                                        console.log(error);
                                    });
                            }
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }

            function validateForm(withPassword = false) {
                let name = document.getElementById('name').value;
                let email = document.getElementById('email').value;
                let role = document.getElementById('role').value;
                let password = null;
                if (withPassword) {
                    password = document.getElementById('password').value;
                }

                if (name.trim() === '') {
                    Swal.showValidationMessage('Por favor, introduce un nombre válido');
                    return false;
                }

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email.trim() === '' || !emailRegex.test(email)) {
                    Swal.showValidationMessage('Por favor, introduce un email válido');
                    return false;
                }

                if (role.trim() === '') {
                    Swal.showValidationMessage('Por favor, selecciona un rol');
                    return false;
                } else if (role.trim() !== 'Client' && role.trim() !== 'Manager' && role.trim() !== 'Administrator') {
                    Swal.showValidationMessage('Por favor, selecciona un rol válido');
                    return false;
                }

                if (withPassword && password.trim() === '') {
                    Swal.showValidationMessage('Por favor, introduce una contraseña válida');
                    return false;
                }

                return true;
            }

            function changeInputLabel(input) {
                let inputValue = document.getElementById(`${input}`).value;
                let inputValueSplit = inputValue.split('\\');
                let imageName = inputValueSplit[inputValueSplit.length - 1]
                document.getElementById(`${input}-label`).innerText = imageName;
            }
        </script>
    </body>
@endsection

</html>
