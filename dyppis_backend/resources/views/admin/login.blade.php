@extends('layouts.template')
@section('title', 'Вход в админ-панель')
@section('body')
    <div class="container">
        <h1 class="mt-5">Вход в админ-панель</h1>
        <p>Войдите, чтобы управлять платформами цифрового маркетплейса.</p>
        <form id="adminLoginForm" action="{{ route('authorization') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Электронная почта</label>
                <input class="form-control" type="email" placeholder="Введите email" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input class="form-control" type="password" placeholder="Введите пароль" name="password" id="password" required>
            </div>
            <div class="mb-3">
                <label for="device_name" class="form-label">Имя устройства (необязательно)</label>
                <input class="form-control" type="text" placeholder="Пример: Admin Browser" name="device_name" id="device_name">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary form-control">Войти</button>
            </div>
            <div id="formFeedback" class="mt-3"></div>
        </form>
    </div>

    <script>
        document.getElementById('adminLoginForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const url = document.getElementById('adminLoginForm').getAttribute('action');
            const form = event.target;
            const formData = new FormData(form);

            if (!formData.get('device_name')) {
                formData.delete('device_name');
            }

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                const feedback = document.getElementById('formFeedback');
                if (response.ok) {
                    const result = await response.json();
                    localStorage.setItem('auth_token', result.data.token);
                    feedback.innerHTML = `<div class="alert alert-success">Успешный вход! Перенаправление...</div>`;
                    setTimeout(() => {
                        window.location.href = '/admin/dashboard';
                    }, 1000);
                } else {
                    const error = await response.json();
                    feedback.innerHTML = `<div class="alert alert-danger">Ошибка: ${error.message || 'Неверные учетные данные'}</div>`;
                }
            } catch (error) {
                document.getElementById('formFeedback').innerHTML = `<div class="alert alert-danger">Ошибка: ${error.message}</div>`;
            }
        });
    </script>
@endsection
