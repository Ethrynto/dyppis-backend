@extends('layouts.template')
@section('title', 'Создание платформы - Админ-панель')
@section('body')
    <div class="container">
        <h1 class="mt-5">Создание платформы</h1>
        <p>Добро пожаловать в админ-панель цифрового маркетплейса!</p>
        <form id="createPlatformForm" action="{{ route('platforms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="slug" class="form-label">Слаг</label>
                <input class="form-control" type="text" placeholder="Пример: activision-blizzard" aria-label="Пример: activision-blizzard" name="slug" id="slug" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input class="form-control" type="text" placeholder="Пример: Activision Blizzard" aria-label="Пример: Activision Blizzard" name="title" id="title" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Категория платформы</label>
                <select class="form-select" name="category_id" id="category_id" required>
                    @foreach($platformCategories as $key => $value)
                        <option value="{{ $value }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="parent_id" class="form-label">Родительская платформа (по умолчанию без)</label>
                <select class="form-select" name="parent_id" id="parent_id">
                    <option value="" selected>Без родительской платформы</option>
                    @foreach($platforms as $key => $value)
                        <option value="{{ $value }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Логотип</label>
                <input class="form-control" type="file" id="logo" name="logo" accept="image/png,image/jpeg,image/svg" required>
            </div>
            <div class="mb-3">
                <label for="banner" class="form-label">Баннер (необязательно)</label>
                <input class="form-control" type="file" id="banner" name="banner" accept="image/png,image/jpeg,image/svg">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary form-control">Создать</button>
            </div>
            <div id="formFeedback" class="mt-3"></div>
        </form>
    </div>

    <script>
        document.getElementById('createPlatformForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            if (formData.get('parent_id') === '') {
                formData.delete('parent_id');
            }

            if (!formData.get('banner').name) {
                formData.delete('banner');
            }

            try {
                const token = localStorage.getItem('auth_token');
                if (!token) {
                    throw new Error('Требуется авторизация. Пожалуйста, войдите.');
                }

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Authorization': `Bearer ${token}`
                    }
                });

                const feedback = document.getElementById('formFeedback');
                if (response.ok) {
                    const result = await response.json();
                    feedback.innerHTML = `<div class="alert alert-success">Платформа успешно создана!</div>`;
                    form.reset();
                } else {
                    const error = await response.json();
                    if (response.status === 401) {
                        feedback.innerHTML = `<div class="alert alert-danger">Ошибка: Неавторизован. Пожалуйста, войдите снова.</div>`;
                        setTimeout(() => {
                            window.location.href = '/admin/login';
                        }, 1000);
                    } else if (response.status === 403) {
                        feedback.innerHTML = `<div class="alert alert-danger">Ошибка: Недостаточно прав. Требуется роль администратора или модератора. ${error.message}</div>`;
                    } else {
                        feedback.innerHTML = `<div class="alert alert-danger">Ошибка: ${error.message || 'Не удалось создать платформу'}</div>`;
                    }
                }
            } catch (error) {
                document.getElementById('formFeedback').innerHTML = `<div class="alert alert-danger">Ошибка: ${error.message}</div>`;
            }
        });

        document.getElementById('logoutButton').addEventListener('click', async function() {
            try {
                const token = localStorage.getItem('auth_token');
                if (!token) {
                    window.location.href = '/admin/login';
                    return;
                }

                const response = await fetch('/api/v1/logout', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Authorization': `Bearer ${token}`
                    }
                });

                const feedback = document.getElementById('formFeedback');
                if (response.ok) {
                    localStorage.removeItem('auth_token');
                    feedback.innerHTML = `<div class="alert alert-success">Вы успешно вышли!</div>`;
                    setTimeout(() => {
                        window.location.href = '/admin/login';
                    }, 1000);
                } else {
                    feedback.innerHTML = `<div class="alert alert-danger">Ошибка при выходе.</div>`;
                }
            } catch (error) {
                document.getElementById('formFeedback').innerHTML = `<div class="alert alert-danger">Ошибка: ${error.message}</div>`;
            }
        });
    </script>
@endsection

