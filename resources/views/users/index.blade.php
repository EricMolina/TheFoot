<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
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
        }
    </style>
</head>
<body>
    <h1>Crud usuarios</h1>
    <a href="#" onclick="createUser()">Crear nuevo usuario</a>
    <br>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Profile Image</th>
                <th>Editar</th>
                <th>Eliminar</th>
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
                                                    <td><img src="{{ asset('images/profiles') }}/${user.profile_image}" alt="Profile Image"></td>
                                                    <td><button onclick="editUser(${user.id})">Editar</button></td>
                                                    <td><button onclick="deleteUser(${user.id})">Eliminar</button></td>
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
                                        <form id="createUserForm" enctype="multipart/form-data">
                                            @csrf
                                            <label for="name">Nombre:</label>
                                            <input type="text" id="name" name="name" class="swal2-input">
                                            <br>
                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email" class="swal2-input">
                                            <br>
                                            <label for="password">Contraseña:</label>
                                            <input type="password" id="password" name="password" class="swal2-input">
                                            <br>
                                            <label for="profile_image">Imagen de perfil:</label>
                                            <input type="file" id="profile_image" name="profile_image" class="swal2-input">
                                            <br>
                                            <label for="role">Rol:</label>
                                            <select id="role" name="role" class="swal2-input">
                                                <option value="Client">Client</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Administrator">Administrator</option>
                                            </select>
                                            <br>
                                        </form>
                                    `,
                                    showCancelButton: true,
                                    confirmButtonText: 'Crear',
                                    cancelButtonText: 'Cancelar',
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
                                    preConfirm: () => {
                                        fetch("{{ route('api.admin.users.destroy') }}", {
                                            method: 'DELETE',
                                            headers: {
                                                "Content-Type": "application/json",
                                                "Accept": "application/json",
                                                "X-Requested-With": "XMLHttpRequest",
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({ id: id })
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
                                    body: JSON.stringify({ id: id })
                                })
                                .then(response => response.json())
                                .then(user => {
                                    Swal.fire({
                                        title: 'Editar usuario',
                                        html: `
                                            <form id="editUserForm" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <label for="name">Nombre:</label>
                                                <input type="text" id="name" name="name" value="${user.name}" class="swal2-input">
                                                <br>
                                                <label for="email">Email:</label>
                                                <input type="email" id="email" name="email" value="${user.email}" class="swal2-input">
                                                <br>
                                                <label for="password">Contraseña:</label>
                                                <input type="password" id="password" name="password" class="swal2-input">
                                                <br>
                                                <label for="profile_image">Imagen de perfil:</label>
                                                <input type="file" id="profile_image" name="profile_image" class="swal2-input">
                                                <br>
                                                <label for="role">Rol:</label>
                                                <select id="role" name="role" class="swal2-input">
                                                    <option value="Client" ${user.role === 'Client' ? 'selected' : ''}>Client</option>
                                                    <option value="Manager" ${user.role === 'Manager' ? 'selected' : ''}>Manager</option>
                                                    <option value="Administrator" ${user.role === 'Administrator' ? 'selected' : ''}>Administrator</option>
                                                </select>
                                                <br>
                                                <label for="current_profile_image">Foto de perfil actual:</label>
                                                <img src="{{ asset('images/profiles/${user.profile_image}') }}" alt="Foto de perfil actual" width="100">
                                            </form>
                                        `,
                                        showCancelButton: true,
                                        confirmButtonText: 'Guardar',
                                        cancelButtonText: 'Cancelar',
                                        preConfirm: () => {
                                            let form = document.getElementById('editUserForm');
                                            let formData = new FormData(form);
                                            formData.append('id', id);
                                            formData.append("_method", "PUT");
                                            //agregar los restaurantes
                                            formData.append('updatedRestaurant', JSON.stringify(updatedRestaurant));
                                            formData.append('oldRestaurant', JSON.stringify(oldRestaurant));

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
                        </script>
                    </body>
                    </html>
