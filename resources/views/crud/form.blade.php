
@extends('layouts.app')

@section('title', $config['title'] . ' | LaundryOS')

@section('content')

<div class="page-heading">
    <div>
        <h1>{{ $action === 'create' ? 'Tambah Data' : 'Edit Data' }}</h1>
        <p>{{ $config['title'] }}</p>
    </div>

    <a href="{{ route('data.index', $module) }}" class="btn btn-outline">
        Kembali
    </a>
</div>


<div class="content-card form-card">

    <form
        action="{{ $action === 'create'
            ? route('data.store', $module)
            : route('data.update', [$module, $item->{$config['pk']}]) }}"
        method="POST"
    >

        @csrf

        @if($action === 'edit')
            @method('PUT')
        @endif


        <div class="form-grid">

            @foreach($config['fields'] as $field)

                <div class="form-group">

                    <label for="{{ $field['name'] }}">
                        {{ $field['label'] }}
                    </label>


                    @if($field['type'] === 'select')

                        <select
                            name="{{ $field['name'] }}"
                            id="{{ $field['name'] }}"
                        >

                            <option value="">Pilih {{ $field['label'] }}</option>

                            @foreach($options[$field['name']] as $option)

                                <option
                                    value="{{ $option->{$field['options']['value']} }}"
                                    @selected(
                                        old(
                                            $field['name'],
                                            $item->{$field['name']} ?? ''
                                        ) == $option->{$field['options']['value']}
                                    )
                                >
                                    {{ $option->{$field['options']['label']} }}
                                </option>

                            @endforeach

                        </select>

                    @else

                        <input
                            type="{{ $field['type'] }}"
                            name="{{ $field['name'] }}"
                            id="{{ $field['name'] }}"
                            value="{{ old($field['name'], $item->{$field['name']} ?? '') }}"
                            @if($action === 'edit' && $field['name'] === $config['pk'])
                                readonly
                            @endif
                        >

                    @endif


                    @error($field['name'])
                        <small class="error-text">{{ $message }}</small>
                    @enderror

                </div>

            @endforeach

        </div>


        <div class="form-actions">

            <a href="{{ route('data.index', $module) }}" class="btn btn-outline">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                {{ $action === 'create' ? 'Simpan Data' : 'Perbarui Data' }}
            </button>

        </div>

    </form>

</div>

@endsection
