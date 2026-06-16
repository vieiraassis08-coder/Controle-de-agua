@extends('layouts.app')

@section('topbar-title', 'Novo consumidor')

@section('content')
<div class="card" style="max-width: 560px;">
    <h1 style="margin-bottom: 18px;">➕ Novo Consumidor</h1>

    <form method="POST" action="{{ route('consumidores.store') }}">
        @csrf

        <label for="nome">Nome completo</label>
        <input id="nome" type="text" name="nome" value="{{ old('nome') }}" class="@error('nome') is-invalid @enderror" required placeholder="Ex: João Silva">
        @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror

        <label for="endereco">Endereço</label>
        <input id="endereco" type="text" name="endereco" value="{{ old('endereco') }}" class="@error('endereco') is-invalid @enderror" required placeholder="Ex: Rua das Flores, 42">
        @error('endereco')<div class="invalid-feedback">{{ $message }}</div>@enderror

        <label for="numero_medidor">Número do medidor</label>
        <input id="numero_medidor" type="text" name="numero_medidor" value="{{ old('numero_medidor') }}" class="@error('numero_medidor') is-invalid @enderror" required placeholder="Ex: MED-00123">
        @error('numero_medidor')<div class="invalid-feedback">{{ $message }}</div>@enderror

        <label for="telefone">Telefone</label>
        <input id="telefone" type="text" name="telefone" value="{{ old('telefone') }}" class="@error('telefone') is-invalid @enderror" required placeholder="Ex: 85 99999-9999">
        @error('telefone')<div class="invalid-feedback">{{ $message }}</div>@enderror

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-primary">💾 Cadastrar</button>
            <a href="{{ route('consumidores.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>
@endsection
