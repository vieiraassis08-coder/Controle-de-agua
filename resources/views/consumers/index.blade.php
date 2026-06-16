@extends('layouts.app')

@section('topbar-title', 'Consumidores')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
        <h1 style="margin: 0;">👥 Consumidores</h1>
        <a href="{{ route('consumidores.create') }}" class="btn btn-primary">+ Novo consumidor</a>
    </div>

    @if($consumidores->isEmpty())
        <p class="muted" style="text-align:center; padding:24px 0;">Nenhum consumidor cadastrado ainda.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Medidor</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consumidores as $consumidor)
                <tr>
                    <td>{{ $consumidor->nome }}</td>
                    <td>{{ $consumidor->endereco }}</td>
                    <td><code>{{ $consumidor->numero_medidor }}</code></td>
                    <td>{{ $consumidor->telefone }}</td>
                    <td>
                        <div class="inline-actions">
                            <a href="{{ route('consumidores.edit', $consumidor) }}" class="btn btn-warning">✏️ Editar</a>
                            <form method="POST" action="{{ route('consumidores.destroy', $consumidor) }}" onsubmit="return confirm('Deseja realmente excluir este consumidor?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑️ Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 16px;">
            {{ $consumidores->links() }}
        </div>
    @endif
</div>
@endsection
