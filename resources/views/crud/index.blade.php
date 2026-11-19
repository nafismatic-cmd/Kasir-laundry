
@extends('layouts.app')

@section('title', $config['title'] . ' | LaundryOS')

@section('content')

<div class="page-heading">
    <div>
        <h1>{{ $config['title'] }}</h1>
        <p>Kelola dan pantau data {{ strtolower($config['title']) }}.</p>
    </div>

    <a href="{{ route('data.create', $module) }}" class="btn btn-primary">
        + Tambah Data
    </a>
</div>


<div class="content-card">

    <div class="card-heading">
        <div>
            <h3>Daftar {{ $config['title'] }}</h3>
            <p>Total {{ $rows->total() }} data tersimpan.</p>
        </div>

        <form action="{{ route('data.index', $module) }}" method="GET" class="search-form">
            <input
                type="text"
                name="search"
                placeholder="Cari data..."
                value="{{ request('search') }}"
            >

            <button type="submit" class="btn btn-outline">
                Cari
            </button>
        </form>
    </div>


    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    @foreach($config['columns'] as $label)
                        <th>{{ $label }}</th>
                    @endforeach

                    <th>Aksi</th>
                </tr>
            </thead>


            <tbody>

                @forelse($rows as $row)

                <tr>

                    @foreach($config['columns'] as $field => $label)

                        <td>
                            @if($field === 'Tarif' || $field === 'Diskon' || $field === 'Jumlah_Pembayaran')
                                Rp {{ number_format($row->$field, 0, ',', '.') }}
                            @else
                                {{ $row->$field ?? '-' }}
                            @endif
                        </td>

                    @endforeach


                    <td>
                        <div class="action-group">

                            <a
                                href="{{ route('data.edit', [$module, $row->{$config['pk']}]) }}"
                                class="btn btn-edit"
                            >
                                Edit
                            </a>


                            <form
                                action="{{ route('data.destroy', [$module, $row->{$config['pk']}]) }}"
                                method="POST"
                                onsubmit="return confirmDelete()"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-delete">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="{{ count($config['columns']) + 1 }}" class="empty-data">
                        Data tidak ditemukan.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <div class="pagination-wrapper">
        {{ $rows->links() }}
    </div>

</div>

@endsection
