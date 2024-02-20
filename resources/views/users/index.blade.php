<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <h1>Crud usuarios</h1>
    <a href="#" onclick="createUser()">Crear nuevo usuario</a>
    <br>
    <table>
        <thead>
            <tr>
                <th>Name</th>
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
                        <input type="text" id="name" name="name">
                        <br>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                        <br>
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password">
                        <br>
                        <label for="profile_image">Imagen de perfil:</label>
                        <input type="file" id="profile_image" name="profile_image">
                        <br>
                        <label for="role">Rol:</label>
                        <input type="text" id="role" name="role">
                        <br>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Crear',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    let form = document.getElementById('createUserForm');
                    let formData = new FormData(form);

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
                            <input type="text" id="name" name="name" value="${user.name}">
                            <br>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="${user.email}">
                            <br>
                            <label for="password">Contraseña:</label>
                            <input type="password" id="password" name="password">
                            <br>
                            <label for="profile_image">Imagen de perfil:</label>
                            <input type="file" id="profile_image" name="profile_image">
                            <br>
                            <label for="role">Rol:</label>
                            <input type="text" id="role" name="role" value="${user.role}">
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

                        return fetch("{{ route('api.admin.users.update') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(response => {
                            console.log(response);
                            // Aquí puedes hacer algo con los datos del usuario, como mostrarlos en la interfaz
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
    </script>
</body>
</html>